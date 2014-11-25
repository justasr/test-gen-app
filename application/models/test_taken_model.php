<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_taken_model extends MY_Model
{
    function __construct() {
        parent::__construct();

        $this->table_name = "tbl_user_test_taken";
        $this->index_name = "user_test_taken_id";
        $this->rel_tables['taken_answers'] = "tbl_user_test_taken_answers";
        $this->rel_tables['test'] = "tbl_test";
        $this->rel_tables['test_type'] = "tbl_test_type";
        $this->rel_tables['users'] = "tbl_users";
        $this->rel_tables['question'] = "tbl_question";

        $this->load->database();

        $this->load->helper('date');
        $this->lang->load( 'test_taken' );
        $this->load->model( 'question_model' );
    }

    public function getFull( $columns = null ) {
        $what = "*";

        if( is_array($columns) )
            $what = implode( ',',$columns );
        else if ( $columns != null )
            $what = $columns;


        $this->db->select( $what );
        $this->db->from( $this->table_name );
        $this->db->join( $this->rel_tables['test'], $this->rel_tables['test'].'.idtest = '.$this->table_name.'.user_test_test_id' );
        $this->db->join( $this->rel_tables['test_type'], $this->rel_tables['test_type'].'.idtest_type = '.$this->rel_tables['test'].'.test_type' );
        $this->db->where( $this->index_name, $this->ID );

        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data = $row;

        return $data;

    }

    public function getTakenTestInfo() {
        $_output = array();
        $_output['test_taken_info'] = $this->getFull();
        $testID = $_output['test_taken_info']['idtest'];
        $_output['test_taken_answers'] = $this->question_model->getTestTakenQuestions($testID, $this->ID );
        return $_output;
    }

    public function create($input_test_taken) {

        if( isset($data[ $this->index_name ]) ) {
            if( $this->prerateDataUpdate($input_test_taken) ) {
                $this->setID($data[ $this->index_name ]);
                unset($data[ $this->index_name ]);
                $this->db->update( $this->table_name,$data, array( $this->index_name => $this->ID ) );

                return $this->getID();
            } else
                return false;
        } else {
            if( $this->prerateDataCreation($input_test_taken) ) {
                $this->db->insert( $this->table_name,$input_test_taken );
                return $this->db->insert_id();
            } else
                return false;
        }

    }

    public function createTestTakenAnswers($input_test_taken_answers) {
        if( $this->prerateDataForTestTakenAnswersCreation($input_test_taken_answers) ) {
            foreach( $input_test_taken_answers as $input_test_taken_answer )
                $this->db->insert( $this->rel_tables['taken_answers'],$input_test_taken_answer );
        } else
            return false;
    }

    public function prerateDataUpdate($input_test_taken_answers) {
        return true;
    }

    public function prerateDataForTestTakenAnswersCreation( &$data ) {
        $_output = array();

        /* Būtini */
        if( isset($data['test_tanken_id']) && isset( $data['choise'])  ) {
            foreach( $data['choise'] as $questionID => $anaswers ) {

                foreach( $anaswers as $answerID ) {
                    $new_row = array();
                    $new_row['test_tanken_id'] = $data['test_tanken_id'];
                    $new_row['test_taken_question_id'] = $questionID;

                    if(  Question_model::QUESTION_TYPE_BLANK == $this->question_model->getType($questionID) ) {
                        $new_row['test_taken_answer_input'] = $answerID; // NOT AN ID, BUT A TEXT VALUE
                    } else {
                        $new_row['test_taken_answer_id'] = $answerID;
                    }
                    $_output[] = $new_row;
                }
            }
        }
        else
            return FALSE;

        $data = $_output;
        return true;

    }

    public function prerateDataCreation( &$data ) {
        /* Būtini */
        if( isset($data['user_test_test_id']) && isset( $data['user_test_user_id'])  ) {
            $data['user_test_test_id'] =  $data['user_test_test_id'];
            $data['user_test_user_id'] =  $data['user_test_user_id'];
        }
        else
            return FALSE;

        if( isset($data['user_test_create_time']) )
            $data['user_test_create_time'] = $data['user_test_create_time'];
        else
            $data['user_test_create_time'] = date( 'Y-m-d H:i:s', time());


        return true;

    }

    public function prerateDataForUpdate(&$data) {

        if( isset($data['test_update_time']) )
            $data['test_update_time'] = $data['test_update_time'];
        else
            $data['test_update_time'] = date( 'Y-m-d H:i:s', time());

        return true;
    }

    public function getPublicTableColumnsWithHeaders() {
        return array(
            'ID' => 'user_test_taken_id',
            'Test ID' => 'idtest',
            'Test Title' => 'test_name',
            'Creation time'=> 'user_test_create_time',
        );
    }

    public function getAdminTableColumnsWithHeaders() {
        return array(
            'id' => 'idtest',
            'Test Title' => 'test_name',
            'Test Type' => 'test_type_name',
            'Username'=> 'username',
            'Status' => 'test_status',
            'Created At' => 'test_create_time',
            'Updated At' => 'test_update_time'
        );
    }

    public function getTestTaken( $filter, $columns = "*" ) {

        $query  = "SELECT
            SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $columns))."`
		    FROM   $this->table_name ".
            " JOIN ".$this->rel_tables['test'] ." ON ". $this->table_name.".user_test_test_id=".$this->rel_tables['test'].".idtest ".
            " JOIN ".$this->rel_tables['test_type'] ." ON ". $this->rel_tables['test'].".test_type=".$this->rel_tables['test_type'].".idtest_type ".
            $filter['where']." ".
            $filter['order']." ".
            $filter['limit'];


        $result = $this->db->query( $query );
        $data = array();
        foreach ($result->result_array() as $row)
            $data[] = $row;

        return $data;
    }

    public function getPublicAdditionalHeaders() {
        return array(  'Actions' );
    }

    public function setAdditionalColumns( &$rows ) {
        foreach( $rows as &$row ) {

            $_add = "<a href='".base_url()."test_taken/analize/?test_taken_id=".$row['user_test_taken_id']."&test_id=".$row['idtest']."'> Analize </a>";
            $row[] = $_add;
        }
    }

    public function parseUserAnswers( $testInfo,$user_choises ) {
        if( $this->allQuestionsAnswered($testInfo['questions_with_answers'],$user_choises) )
            return true;
        return
            false;
    }

    public function allQuestionsAnswered($questions, $user_choises) {
        foreach($questions as $question) {
            if( !isset( $user_choises[$question['idquestion']] ) || empty($user_choises[$question['idquestion']]) )
                return false;
        }

        return true;
    }

    public function getPreparedTestTakenInfo( &$testInfo, $testInfoTaken, $save = false ) {

        $_output = array();
        $testInfo['statitics'] = array();
        $testInfo['statitics']['total_questions'] = count($testInfo['questions_with_answers']);
        $testInfo['statitics']['questions_right'] = 0;
        $testInfo['statitics']['questions_right_precent'] = 0;
        $testInfo['statitics']['questions_wrong'] = 0;
        $testInfo['statitics']['questions_wrong_precent'] = 0;
        $testInfo['statitics']['passed'] = 0;

        foreach( $testInfo['questions_with_answers'] as $question_key => &$question ) {
            $correct_answers = array();
            $user_answers = array();
            foreach( $question['answers'] as $answer ) {
                switch(  $question['question_type'] )
                {
                    case Question_model::QUESTION_TYPE_BLANK:
                        if( $answer['answer_corrent'] )
                            $correct_answers[] = $answer['answer_name'];
                        break;
                    default:
                        if( $answer['answer_corrent'] )
                            $correct_answers[] = $answer['idanswer'];
                        break;
                }
            }
            foreach( $testInfoTaken['test_taken_answers'][$question_key]['user_answers'] as $user_answer ) {
                switch(  $question['question_type'] )
                {
                    case Question_model::QUESTION_TYPE_BLANK:
                            $user_answers = $user_answer['test_taken_answer_input'];
                        break;
                    default:
                            $user_answers[] = $user_answer['test_taken_answer_id'];
                        break;
                }
            }

            switch(  $question['question_type'] )
            {
                case Question_model::QUESTION_TYPE_BLANK:
                    if( in_array($user_answers,$correct_answers) ) {
                        $question['won'] = 1;
                        $testInfo['statitics']['questions_right']++;
                    }
                    else {
                        $question['won'] = 0;
                        $testInfo['statitics']['questions_wrong']++;
                    }

                    $question['user_selection'] = $user_answers;
                    break;
                default:
                    if( $correct_answers == $user_answers ) {
                        $question['won'] = 1;
                        $testInfo['statitics']['questions_right']++;
                    }
                    else {
                        $question['won'] = 0;
                        $testInfo['statitics']['questions_wrong']++;
                    }
                    $question['user_selection'] = $user_answers;
                    break;
            }

        }


        $testInfo['statitics']['questions_right_precent'] = (float) $testInfo['statitics']['questions_right'] / $testInfo['statitics']['total_questions'] * 100;
        $testInfo['statitics']['questions_wrong_precent'] = (float) $testInfo['statitics']['questions_wrong'] / $testInfo['statitics']['total_questions'] * 100;

        if( $testInfo['statitics']['questions_right'] >= $testInfo['test_info']['test_question_pass_count']  )
        {
            $testInfo['statitics']['passed'] = 1;
        }

        return $testInfo;

    }


    public function saveStatistics() {
//       $data = $this->test_taken_model->getTakenTestInfo();
//       $updata[ $this->index_name ] = $this->getID();
//       $updata[ 'user_test_taken_score' ] = $data['statistics'][''];
//        $updata[ 'user_test_taken_score' ] = $testScore;
//       $this->create( $updata );

    }

}
