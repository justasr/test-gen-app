<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_model extends MY_Model
{
    const QUESTION_TYPE_MULTI_CHOISE = 1;
    const QUESTION_TYPE_MULTI_RESPONSE = 2;
    const QUESTION_TYPE_BLANK = 3;
    const QUESTION_TYPE_MULTI_TRUE_FALSE = 4;

    function __construct() {
        parent::__construct();

        $this->table_name = "tbl_question";
        $this->index_name = "idquestion";
        $this->rel_tables['question_type'] = "tbl_question_type";
        $this->rel_tables['users'] = "tbl_users";
        $this->rel_tables['user_answers'] = "tbl_user_test_taken_answers";
        $this->rel_tables['test'] = "tbl_test";
        $this->rel_tables['answer'] = "tbl_answer";

        $this->load->database();

        $this->load->helper('date');
        $this->lang->load( 'question' );

    }

    function getTypes() {
        $data = array();
        $query = $this->db->get($this->rel_tables['question_type']);
        foreach( $query->result_array() as $row )
            $data[$row['idquestion_type']] = $row;

        return $data;
    }

    public function getPublicTableColumnsWithHeaders() {
        return array(
            'ID' => 'idquestion',
            'Test ID' => 'question_test_id',
            'Title' => 'question_name',
            'Question Type'=> 'question_type',
        );
    }

    public function getAdminTableColumnsWithHeaders() {
        return array(
            'ID' => 'idquestion',
            'Test ID' => 'question_test_id',
            'Title' => 'question_name',
            'Question Type'=> 'question_type',
        );
    }

    public function getPublicAdditionalHeaders() {
        return array(  'Actions' );
    }

    public function setAdditionalColumns( &$rows ) {

        foreach( $rows as &$row ) {
            $_add = "<a href='".base_url()."question/edit/?test_id=".$row['question_test_id']."&question_id=".$row['idquestion']."'> Edit </a>";
            $_add .= "|";
            $_add .= "<a href='".base_url()."question/delete/?test_id=".$row['question_test_id']."&question_id=".$row['idquestion']."'> Delete </a>";

            $row[] = $_add;
        }

    }

    public function getQuestions( $filter, $columns = "*" ) {

        $query  = "SELECT
            SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $columns))."`
		    FROM   $this->table_name ".
            " JOIN ".$this->rel_tables['test'] ." ON ". $this->table_name.".question_test_id=".$this->rel_tables['test'].".idtest ".
            " JOIN ".$this->rel_tables['question_type'] ." ON ". $this->table_name.".question_type=".$this->rel_tables['question_type'].".idquestion_type ".
            $filter['where']." ".
            $filter['order']." ".
            $filter['limit'];

        $result = $this->db->query( $query );
        $data = array();
        foreach ($result->result_array() as $row)
            $data[] = $row;

        return $data;
    }

    public function create( $data ) {

        if( isset($data[ $this->index_name ]) ) {
            if( $this->prerateDataForUpdate( $data ) == FALSE ){
                log_message( 'error', ERROR_BAD_INPUT." ".implode(' ',$data) );
                return false;
            }
            $this->setID($data[ $this->index_name ]);
            unset($data[ $this->index_name ]);

            return $this->db->update( $this->table_name,$data, array( $this->index_name => $this->ID ) );
        } else {
            if( $this->prerateDataForCreation( $data ) == FALSE ){
                log_message( 'error', ERROR_BAD_INPUT." ".implode(' ',$data) );
                return false;
            }

            $this->db->insert( $this->table_name,$data );
            return $this->db->insert_id();
        }
    }

    public function answers_create( $data ) {
        if( $this->prerateDataForAnswerCreation( $data ) == FALSE ){
            log_message( 'error', ERROR_BAD_INPUT." ".implode(' ',$data) );
            return false;
        } else {
            $this->deleteAnswers();

            foreach( $data as $answer )
                $this->db->insert( $this->rel_tables['answer'],$answer );
        }
    }

    public function prepareForTestType($test_type, &$question_types) {
        switch( $test_type ) {
            case Test_model::TEST_TYPE_POLL:
                unset( $question_types[ Question_model::QUESTION_TYPE_BLANK ] );
                unset( $question_types[ Question_model::QUESTION_TYPE_MULTI_RESPONSE ] );
                break;
            case Test_model::TEST_TYPE_SURVEY:
                unset( $question_types[ Question_model::QUESTION_TYPE_BLANK ] );
                unset( $question_types[ Question_model::QUESTION_TYPE_MULTI_RESPONSE ] );
                break;
            case Test_model::TEST_TYPE_EXAM:
                break;
        }
    }

    public function prerateDataForCreation( &$data ) {
        /* Būtini */
        if( isset($data['question_test_id']) && isset( $data['question_name']) && isset( $data['question_type']) ) {
            $data['question_test_id'] =  $data['question_test_id'];
            $data['question_name'] =  $data['question_name'];
            $data['question_type'] =  $data['question_type'];
        }
        else
            return FALSE;

        if( isset($data['question_create_date']) )
            $data['question_create_date	'] = $data['question_create_date	'];
        else
            $data['question_create_date	'] = date( 'Y-m-d H:i:s', time());

        return true;

    }

    public function prerateDataForAnswerCreation( &$data ) {
        $_data = array();
        foreach( $data['answers'] as $key => $value ) {
            $_answer  = array();
            $_answer['answer_name'] = $value;

            $in_array = in_array($key,$data['corrent']);
            if( $in_array != null && $in_array  )
                $_answer['answer_corrent'] = 1;

            $_answer['answer_question_id'] = $this->ID;

            if( isset($data['answer_create_date']) )
                $_answer['answer_create_date'] = $data['answer_create_date'];
            else
                $_answer['answer_create_date'] = date( 'Y-m-d H:i:s', time());

            $_data[] = $_answer;
        }

        if( empty( $_data )  )
            return false;
         return  $data = $_data;
    }

    public function prerateDataForUpdate(&$data) {

        if( isset($data['question_update_date']) )
            $data['question_update_date'] = $data['question_update_date'];
        else
            $data['question_update_date'] = date( 'Y-m-d H:i:s', time());

        return true;
    }

    public function getFull( $columns = null ) {
        $what = "*";

        if( is_array($columns) )
            $what = implode( ',',$columns );
        else if ( $columns != null )
            $what = $columns;


        $this->db->select( $what );
        $this->db->from( $this->table_name );
        $this->db->join( $this->rel_tables['test'], $this->rel_tables['test'].'.idtest = '.$this->table_name.'.question_test_id' );
        $this->db->join( $this->rel_tables['question_type'], $this->rel_tables['question_type'].'.idquestion_type = '.$this->table_name.'.question_type ' );
        $this->db->where( $this->index_name, $this->ID );

        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data = $row;


        return $data;
    }

    public function  getFullAnswers( $columns = null ) {
        $what = "*";

        if( is_array($columns) )
            $what = implode( ',',$columns );
        else if ( $columns != null )
            $what = $columns;

        $this->db->select( $what );
        $this->db->from( $this->rel_tables['answer'] );
        $this->db->where( 'answer_question_id', $this->ID );
        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data[] = $row;

        return $data;
    }

    public function getTestTakenAnswers($test_taken_id) {
        $what = "*";

        $this->db->select( $what );
        $this->db->from( $this->rel_tables['user_answers'] );
        $this->db->where( 'test_taken_question_id', $this->ID );
        $this->db->where( 'test_tanken_id', $test_taken_id );
        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data[] = $row;

        return $data;
    }

    public function delete() {
        $this->db->where($this->index_name, $this->ID);
        return $this->db->delete($this->table_name);
    }

    public function delete_test_questions($testID) {
        $filter['where'] = " WHERE 1 ";
        $filter['order'] = "";
        $filter['limit'] = "";

        $filter['where'] .= " AND question_test_id ='$testID' ";
        $test_questions = $this->getQuestions( $filter,array('idquestion') );

        foreach($test_questions as $question)
        {
            $this->setID($question['idquestion']);
            $this->delete();
            $this->deleteAnswers();
        }

    }

    public function deleteAnswers() {
        $this->db->where('answer_question_id', $this->ID);
        return $this->db->delete($this->rel_tables['answer']);
    }

    public function countQuestions( $testID ) {
        $this->db->from($this->table_name);
        $this->db->where('question_test_id',$testID);
        return $this->db->count_all_results();
    }

    public function getQuestionsWithAnswers( $testID ) {
        $filter['where'] = ' WHERE 1 ';
        $filter['order'] = '';
        $filter['limit'] = '';
        $filter['where'] .= " AND question_test_id ='$testID'";

        $questionsInfo = $this->getQuestions($filter,array('idquestion','question_name','question_type'));

        foreach($questionsInfo as  &$questionInfo) {
            $this->setID($questionInfo['idquestion']);
            $questionInfo['answers'] = $this->getFullAnswers();
        }

        return $questionsInfo;
    }

    public function getType($questionID) {
        $data = null;
        $this->db->select( 'question_type' );
        $this->db->where( $this->index_name,$questionID );
        $query = $this->db->get($this->table_name);

        foreach( $query->result_array() as $row )
           $data = $row;

        if($data == null)
            return false;

        return $data['question_type'];
    }

    public function getTestTakenQuestions($testID,$test_taken_id) {
        $filter['where'] = ' WHERE 1 ';
        $filter['order'] = '';
        $filter['limit'] = '';
        $filter['where'] .= " AND question_test_id ='$testID'";

        $questionsInfo = $this->getQuestions($filter,array('idquestion','question_name','question_type'));


        foreach($questionsInfo as  &$questionInfo) {
            $this->setID($questionInfo['idquestion']);
            $questionInfo['user_answers'] = $this->getTestTakenAnswers($test_taken_id);
        }

        return $questionsInfo;
    }
}
