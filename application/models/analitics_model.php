<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Analitics_model extends MY_Model
{
    public $test_id;
    function __construct() {
        parent::__construct();

        $this->load->database();

        $this->load->helper('date');
        $this->lang->load( 'test' );
        $this->load->model( 'question_model' );
        $this->load->model( 'test_model' );
        $this->load->model( 'test_taken_model' );
    }

    function setTestID( $id ) {
        $this->test_id = $id;
    }

    function getTestAnalitics() {
        $filter = array();
        $filter['where'] = ' where 1 ';
        $filter['order'] = ' ';
        $filter['limit'] = ' ';
        $filter['where'].= " AND idtest = '$this->test_id' ";
        $this->test_model->setID($this->test_id);
        $test_schema = $this->test_model->getTakeTestInfo();
        $this->prepare($test_schema);

        $tests = $this->test_taken_model->getTestTaken($filter,array( 'user_test_taken_id','user_test_user_id' ));
        $test_schema['tests_total'] = count($tests);
        foreach( $tests as $test ) {
            $this->test_taken_model->setID($test['user_test_taken_id']);
            $testInfo = $this->test_taken_model->getTakenTestInfo();


            foreach($testInfo['test_taken_answers'] as $question_id => $answer_info) {
                $test_schema['questions_with_answers'][$question_id]['total_questions_count'] = count($test_schema['questions_with_answers'][$question_id]['answers']);

                foreach($answer_info['user_answers'] as $answer) {
                    foreach( $test_schema['questions_with_answers'][$question_id]['answers'] as &$schema_answer) {
                        if( $schema_answer['idanswer'] == $answer['test_taken_answer_id'] ){
                            $schema_answer['usersTotalSelected']++;
                            $test_schema['questions_with_answers'][$question_id]['qustionAnswersSelected']++;
                        }
                    }
                }
            }
        }

        $this->setPrecentage($test_schema);
        return $test_schema;

    }

    function prepare(&$test_schema) {
        foreach($test_schema['questions_with_answers'] as &$question ){
            $question['qustionAnswersSelected'] = 0;
            foreach($question['answers'] as &$answer ) {
                $answer['usersTotalSelected'] = 0;
                $answer['usersTotalSelectedProc'] = 0;
            }
        }
    }

    function setPrecentage( &$test_schema ) {
        foreach($test_schema['questions_with_answers'] as &$question_info) {
            foreach($question_info['answers'] as &$answer) {
               if( $answer['usersTotalSelected'] > 0 ) {
                   $answer['usersTotalSelectedProc'] = $answer['usersTotalSelected'] / $question_info['qustionAnswersSelected']  * 100;
               }
            }
        }
    }

}
