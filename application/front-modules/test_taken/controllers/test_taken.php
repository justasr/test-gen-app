<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class Test_taken extends MY_User_Controller {

	function __construct()
	{
		parent::__construct();

        $this->lang->load('test');
        $this->load->model('test_model');
        $this->load->model('test_taken_model');
        $this->load->model('analitics_model');
	}
    function analize() {
        $testID = $this->input->get('test_id');
        $testTakenID = $this->input->get('test_taken_id');
        $this->test_model->setID($testID);
        $type = $this->test_model->getTypeFromTestID();

        switch( $type ) {
            case Test_model::TEST_TYPE_POLL:
                redirect('test_taken/analize_poll/?test_id='.$testID.'&test_taken_id='.$testTakenID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_SURVEY:
                redirect('test_taken/analize_survey/?test_id='.$testID.'&test_taken_id='.$testTakenID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_EXAM:
                redirect('test_taken/analize_exam/?test_id='.$testID.'&test_taken_id='.$testTakenID,'refresh' );
                break;
        }

        redirect('user/show_tests_taken_all', 'refresh');
    }

    function analize_survey() {
        $testID = $this->input->get('test_id');
        $testTakenID = $this->input->get('test_taken_id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_SURVEY) ) {
            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo();

            /* Taken Test Info */
            $this->test_taken_model->setID( $testTakenID );
            $this->data['taken_test_info'] = $this->test_taken_model->getTakenTestInfo();

            /* Prepare for output */
            $this->data['taken_test_prepared'] =  $this->test_taken_model->getPreparedTestTakenInfo( $this->data['take_test_info'],$this->data['taken_test_info'] );

            $this->analitics_model->setTestID($testID);
            $this->data['take_test_analitics'] = $this->analitics_model->getTestAnalitics();

            $this->_render_page( $this,'/test_taken/analize_survey' );
        } else {
            redirect('user/show_tests_taken_all', 'refresh');
        }
    }

    function analize_poll() {
        $testID = $this->input->get('test_id');
        $testTakenID = $this->input->get('test_taken_id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_POLL) ) {
            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo();

            /* Taken Test Info */
            $this->test_taken_model->setID( $testTakenID );
            $this->data['taken_test_info'] = $this->test_taken_model->getTakenTestInfo();

            /* Prepare for output */
            $this->data['taken_test_prepared'] =  $this->test_taken_model->getPreparedTestTakenInfo( $this->data['take_test_info'],$this->data['taken_test_info'] );

            $this->analitics_model->setTestID($testID);
            $this->data['take_test_analitics'] = $this->analitics_model->getTestAnalitics();



            $this->_render_page( $this,'/test_taken/analize_poll' );
        } else {
            redirect('user/show_tests_taken_all', 'refresh');
        }
    }

    function analize_exam() {
        $testID = $this->input->get('test_id');
        $testTakenID = $this->input->get('test_taken_id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_EXAM) ) {
            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo();
            /* Taken Test Info */
            $this->test_taken_model->setID( $testTakenID );
            $this->data['taken_test_info'] = $this->test_taken_model->getTakenTestInfo();

            /* Prepare for output */
            $this->data['taken_test_prepared'] =  $this->test_taken_model->getPreparedTestTakenInfo( $this->data['take_test_info'],$this->data['taken_test_info'] );
            $this->_render_page( $this,'/test_taken/analize_exam' );
        } else {
            redirect('user/show_tests_taken_all', 'refresh');
        }
    }

}
