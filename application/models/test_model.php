<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends MY_Model
{
    const TEST_STATUS_PRIVATE = 1;
    const TEST_STATUS_PUBLIC = 2;

    const TEST_TYPE_POLL = 1;
    const TEST_TYPE_SURVEY = 2;
    const TEST_TYPE_EXAM = 3;

    function __construct() {
        parent::__construct();

        $this->table_name = "tbl_test";
        $this->index_name = "idtest";
        $this->rel_tables['test_type'] = "tbl_test_type";
        $this->rel_tables['tests_taken'] = "tbl_user_test_taken";
        $this->rel_tables['test_taken_answers'] = "tbl_user_test_taken_answers";
        $this->rel_tables['users'] = "tbl_users";
        $this->rel_tables['question'] = "tbl_question";

        $this->load->database();

        $this->load->helper('date');
        $this->lang->load( 'test' );
        $this->load->model( 'question_model' );
        $this->load->model( 'test_taken_model' );
    }

    public function getFull( $columns = null ) {

        $what = "*";

        if( is_array($columns) )
            $what = implode( ',',$columns );
        else if ( $columns != null )
            $what = $columns;


        $this->db->select( $what );
        $this->db->from( $this->table_name );
        $this->db->join( $this->rel_tables['test_type'], $this->rel_tables['test_type'].'.idtest_type = '.$this->table_name.'.test_type' );
        $this->db->join( $this->rel_tables['users'], $this->rel_tables['users'].'.id = '.$this->table_name.'.test_user_id ' );
        $this->db->where( $this->index_name, $this->ID );

        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data = $row;

        return $data;

    }

    public function getStatus( $stateID ) {

        if( !in_array( $stateID, array(self::TEST_STATUS_PRIVATE,self::TEST_STATUS_PUBLIC) ) ) {
            return self::TEST_STATUS_PRIVATE;
        }
        else {
            return $stateID;
        }
    }

    public function getType( $typeID ) {

        if( !in_array( $typeID, array(self::TEST_TYPE_POLL,self::TEST_TYPE_SURVEY,self::TEST_TYPE_EXAM) ) ) {
            return self::TEST_TYPE_POLL;
        }
        else {
            return $typeID;
        }
    }

    public function getTypes( ) {
        $data = array();
        $query = $this->db->get($this->rel_tables['test_type']);
        foreach( $query->result_array() as $row )
            $data[] = $row;

        return $data;
    }

    public function getTypeFromTestID( $id = null ) {
        if( $id != null )
            $this->setID($id);

        $data = array();
        $this->db->select( 'test_type' );
        $this->db->where( 'idtest',$this->ID );
        $query = $this->db->get($this->table_name);
        foreach( $query->result_array() as $row )
            $data = $row;

        return $data['test_type'];
    }

    public function create( $data ) {

        if( isset($data[ $this->index_name ]) ) {
            if( $this->prerateDataForUpdate( $data ) == FALSE ){
                log_message( 'error', ERROR_BAD_INPUT." ".implode(' ',$data) );
                return false;
            }
            $this->setID($data[ $this->index_name ]);
            unset($data[ $this->index_name ]);
            $this->db->update( $this->table_name,$data, array( $this->index_name => $this->ID ) );

            return $this->ID;
        } else {
            if( $this->prerateDataForCreation( $data ) == FALSE ){
                log_message( 'error', ERROR_BAD_INPUT." ".implode(' ',$data) );
                return false;
            }

            $this->db->insert( $this->table_name,$data );
            return $this->db->insert_id();
        }
    }

    public function prerateDataForCreation( &$data ) {
        /* Būtini */
        if( isset($data['test_name']) && isset( $data['test_type']) && isset( $data['test_user_id']) ) {
            $data['test_name'] =  $data['test_name'];
            $data['test_type'] =  $data['test_type'];
            $data['test_user_id'] =  $data['test_user_id'];
        }
        else
            return FALSE;

        if( isset($data['test_create_time']) )
            $data['test_create_time'] = $data['test_create_time'];
        else
            $data['test_create_time'] = date( 'Y-m-d H:i:s', time());

        if( isset($data['test_status']) )
            $data['test_status'] = $data['test_status'];
        else
            $data['test_status'] = Test_model::TEST_STATUS_PRIVATE;

        return true;

    }

    public function prerateDataForUpdate(&$data) {

        if( isset( $data['test_question_pass_count'] ) )
        {
            if( $data['test_question_pass_count'] > $this->question_model->countQuestions($data[ $this->index_name ]) &&
                intval($data['test_question_pass_count']) > 0 )
            {
                return false;
            }
        }

        if( isset($data['test_update_time']) )
            $data['test_update_time'] = $data['test_update_time'];
        else
            $data['test_update_time'] = date( 'Y-m-d H:i:s', time());

        return true;
    }

    public function getPublicTableColumnsWithHeaders() {
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

    public function checkType($testID,$type) {
        $data = null;
        $this->db->select( $this->index_name );
        $this->db->from( $this->table_name );
        $this->db->where( $this->index_name,$testID );
        $this->db->where( 'test_type',$type );

        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data = $row;

         if( $data != null )
             return true;

        return false;
    }

    public function getTests( $filter, $columns = "*" ) {

        $query  = "SELECT
            SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $columns))."`
		    FROM   $this->table_name ".
            " JOIN ".$this->rel_tables['users'] ." ON ". $this->table_name.".test_user_id=".$this->rel_tables['users'].".id ".
            " JOIN ".$this->rel_tables['test_type'] ." ON ". $this->table_name.".test_type=".$this->rel_tables['test_type'].".idtest_type ".
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

            $_add = "<a href='".base_url()."test/edit/?id=".$row['idtest']."'> Manage </a>";
            $_add .= "|";
            $_add .= "<a href='".base_url()."test/delete/?id=".$row['idtest']."'> Delete </a>";

            $row[] = $_add;
        }
    }

    public function checkOwnership( $testID,$userID ) {
        $data = null;
        $this->db->select( $this->index_name );
        $this->db->from( $this->table_name );
        $this->db->where( $this->index_name,$testID );
        $this->db->where( 'test_user_id',$userID );

        $query = $this->db->get();

        foreach( $query->result_array() as $row )
            $data = $row;

        if( $data != null )
            return true;

        return false;

    }

    public function delete() {
        $this->db->where($this->index_name, $this->ID);
        return $this->db->delete($this->table_name);
    }

    public function setAdditionalForEveryOne(&$rows) {
        foreach( $rows as &$row ) {
            $_add = "<a href='".base_url()."test/take/?id=".$row['idtest']."'> Take </a>";
            $_add.= " | ";
            $_add.=  "<a href='".base_url()."export/xml/?id=".$row['idtest']."'> Export </a>";

            $row[] = $_add;
        }
    }

    public function setAdditionalColumnsForOwner(&$rows) {
        foreach( $rows as &$row ) {

            $_add = "<a href='".base_url()."test/edit/?id=".$row['idtest']."'> Manage </a>";
            $_add .= "|";
            $_add .= "<a href='".base_url()."test/delete/?id=".$row['idtest']."'> Delete </a>";

            $row[] = $_add;
        }
    }

    public function getTakeTestInfo() {
        $_output = array();
        $_output['test_info'] = $this->getFull();
        $_output['questions_with_answers'] = $this->question_model->getQuestionsWithAnswers( $this->ID );
        return $_output;
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

    public function createTestTaken($input_test_taken) {
        if( $this->prerateDataForTestTakenCreation($input_test_taken) ) {
            $this->db->insert( $this->rel_tables['tests_taken'],$input_test_taken );
            return $this->db->insert_id();
        } else
            return false;
    }

    public function prerateDataForTestTakenCreation( &$data ) {
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

    public function createTestTakenAnswers($input_test_taken_answers) {
        if( $this->prerateDataForTestTakenAnswersCreation($input_test_taken_answers) ) {
            foreach( $input_test_taken_answers as $input_test_taken_answer )
                $this->db->insert( $this->rel_tables['test_taken_answers'],$input_test_taken_answer );
        } else
            return false;
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

}
