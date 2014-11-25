<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class Test extends MY_User_Controller {

	function __construct()
	{
		parent::__construct();

        $this->lang->load('test');
        $this->load->model('test_model');

	}

    function create_manual() {

        $this->form_validation->set_rules('test_name', lang('l_test_name'), 'required'); /* Unique? */
        $this->form_validation->set_rules('test_type', lang("l_test_type"), 'required}');

        if(  $this->form_validation->run() ) {

            $input = array(
                'test_name' => $this->input->post('test_name'),
                'test_type' => $this->input->post('test_type'),
                'test_user_id' => $this->ion_auth->get_user_id()
            );

            if( $testID = $this->test_model->create( $input ) ) {
                $this->session->set_flashdata('message_success', lang('create_success') );

                switch( $input['test_type'] ) {
                    case Test_model::TEST_TYPE_POLL:
                        redirect('test/edit_poll/?id='.$testID, 'refresh');
                        break;
                    case Test_model::TEST_TYPE_SURVEY:
                        redirect('test/edit_survey/?id='.$testID, 'refresh');
                        break;
                    case Test_model::TEST_TYPE_EXAM:
                        redirect('test/edit_exam/?id='.$testID, 'refresh');
                        break;
                    default:
                        redirect('test/edit_poll/?id='.$testID, 'refresh');
                        break;
                }

            } else {
                log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                $this->session->set_flashdata('message_failure', lang('create_failure') );
                redirect('test/create_manual', 'refresh');
            }
        }

        /* Test Info */
        $this->data['test_types'] = $this->test_model->getTypes();
        $this->_render_page($this,'/test/create_manual');
    }

    function edit() {
        $testID = $this->input->get('id');
        $this->test_model->setID($testID);
        $type = $this->test_model->getTypeFromTestID();

        switch( $type ) {
            case Test_model::TEST_TYPE_POLL:
                redirect('test/edit_poll/?id='.$testID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_SURVEY:
                redirect('test/edit_survey/?id='.$testID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_EXAM:
                redirect('test/edit_exam/?id='.$testID,'refresh' );
                break;
        }

    }

    function delete() {
        $testID = $this->input->get('id');
        if( $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {
            $this->test_model->setID($testID);
            $this->question_model->delete_test_questions($testID);
            $this->test_model->delete();
            $this->session->set_flashdata('message_success', lang('delete_success') );
            redirect('user/user_tests', 'refresh');
        } else {
            $this->session->set_flashdata('message_failure', lang('auth_failure') );
            redirect('user/user_tests', 'refresh');
        }

    }

    function edit_poll() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_POLL) && $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {

            $this->form_validation->set_rules('test_name', lang('l_test_name'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {

                $input = array(
                    'idtest' => $testID,
                    'test_name' => $this->input->post('test_name'),
                    'test_user_id' => $this->ion_auth->get_user_id(),
                    'test_status' => $this->input->post('test_status')
                );

                if( $testID = $this->test_model->create( $input ) ) {
                    $this->session->set_flashdata('message_success', lang('update_success') );
                    redirect('test/edit_poll/?id='.$testID,'location');
                } else {
                    log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                    $this->session->set_flashdata('message_failure', lang('update_failure') );
                    redirect('test/edit_poll/?id='.$testID,'location');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['test_info'] = $this->test_model->getFull( array('idtest','test_name','test_type','test_status') );
            $this->data['test_types'] = $this->test_model->getTypes();
            $this->data['question_info']['headers'] = array_merge( $this->question_model->getPublicTableHeaders(),$this->question_model->getPublicAdditionalHeaders() );
            $this->data['question_info']['count'] = $this->question_model->countQuestions( $testID );
            $this->_render_page( $this,'/test/edit_poll' );
        } else {
            redirect('test/show_tests', 'refresh');
        }

    }

    function show_test_questions_ajax() {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $testID = $this->input->get('id');
            $this->data_filter->setColumns( $this->question_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->question_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();
            $filter['where'] .= " AND question_test_id = '".$testID."' ";
            $selected = $this->question_model->getQuestions( $filter, $this->data_filter->columns );

            $this->question_model->setAdditionalColumns( $selected );

            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->question_model->countQuestions( $testID   ) ;

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    function edit_survey() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_SURVEY) && $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {

            $this->form_validation->set_rules('test_name', lang('l_test_name'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {

                $input = array(
                    'idtest' => $testID,
                    'test_name' => $this->input->post('test_name'),
                    'test_user_id' => $this->ion_auth->get_user_id(),
                    'test_status' => $this->input->post('test_status')
                );

                if( $testID = $this->test_model->create( $input ) ) {
                    $this->session->set_flashdata('message_success', lang('update_success') );
                    redirect('test/edit_survey/?id='.$testID,'location');
                } else {
                    log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                    $this->session->set_flashdata('message_failure', lang('update_failure') );
                    redirect('test/edit_survey/?id='.$testID,'location');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['test_info'] = $this->test_model->getFull( array('idtest','test_name','test_type','test_status') );
            $this->data['test_types'] = $this->test_model->getTypes();
            $this->data['question_info']['headers'] = array_merge( $this->question_model->getPublicTableHeaders(),$this->question_model->getPublicAdditionalHeaders() );

            $this->_render_page( $this,'/test/edit_survey' );
        } else {
            redirect('user/show_tests', 'refresh');
        }

    }

    function edit_exam() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_EXAM) && $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {

            $this->form_validation->set_rules('test_name', lang('l_test_name'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {

                $input = array(
                    'idtest' => $testID,
                    'test_name' => $this->input->post('test_name'),
                    'test_user_id' => $this->ion_auth->get_user_id(),
                    'test_status' => $this->input->post('test_status'),
                    'test_question_pass_count' => $this->input->post('test_question_pass_count'),
                );

                if( $updateID = $this->test_model->create( $input ) ) {
                    $this->session->set_flashdata('message_success', lang('update_success') );
                    redirect('test/edit_exam/?id='.$updateID,'location');
                } else {
                    log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                    $this->session->set_flashdata('message_failure', lang('update_failure') );
                    redirect('test/edit_exam/?id='.$testID,'location');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['test_info'] = $this->test_model->getFull( array('idtest','test_name','test_type','test_question_pass_count','test_status') );
            $this->data['test_types'] = $this->test_model->getTypes();
            $this->data['question_info']['headers'] = array_merge( $this->question_model->getPublicTableHeaders(),$this->question_model->getPublicAdditionalHeaders() );
            $this->data['question_info']['count']  = $this->question_model->countQuestions( $testID ) ;

            $this->_render_page( $this,'/test/edit_exam' );
        } else {
            redirect('test/show_tests', 'refresh');
        }

    }

    function show_tests() {
        $adminHeaders = $this->test_model->getPublicTableHeaders();
        $this->data['headers'] = array_merge( array_keys($adminHeaders) );

        $this->_render_page($this,'/test/show_tests' );
    }

    function show_taken_tests() {
        $adminHeaders = $this->test_model->getPublicTableHeaders();
        $this->data['headers'] = array_merge( array_keys($adminHeaders) );

        $this->_render_page($this,'/test/show_tests' );
    }

    function show_tests_ajax() {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $selected = $this->test_model->getTests( $filter, $this->data_filter->columns );
            $totalDisplayRecords = count( $selected );

            $totalRecords = $this->test_model->count();

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    function show_exams() {
        $adminHeaders = $this->test_model->getPublicTableHeaders();
        $this->data['headers'] = array_merge( array_keys($adminHeaders) );

        $this->_render_page($this,'/test/show_exams' );
    }

    function show_exams_ajax() {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $selected = $this->test_model->getExams( $filter, $this->data_filter->columns );
            $totalDisplayRecords = count( $selected );
            $where = array( 'test_type' => Test_model::TEST_TYPE_EXAM );
            $totalRecords = $this->test_model->count($where);

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }
        exit;
    }

    function show_polls() {
        $adminHeaders = $this->test_model->getPublicTableHeaders();
        $this->data['headers'] = array_merge( array_keys($adminHeaders) );

        $this->_render_page($this,'/test/show_polls' );
    }

    function show_polls_ajax() {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $selected = $this->test_model->getPolls( $filter, $this->data_filter->columns );
            $totalDisplayRecords = count( $selected );
            $where = array( 'test_type' => Test_model::TEST_TYPE_POLL );
            $totalRecords = $this->test_model->count($where);

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }
        exit;
    }

    function show_surveys() {
        $adminHeaders = $this->test_model->getPublicTableHeaders();
        $this->data['headers'] = array_merge( array_keys($adminHeaders) );

        $this->_render_page($this,'/test/show_surveys' );
    }

    function show_surveys_ajax() {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $selected = $this->test_model->getSurveys( $filter, $this->data_filter->columns );
            $totalDisplayRecords = count( $selected );
            $where = array( 'test_type' => Test_model::TEST_TYPE_SURVEY );
            $totalRecords = $this->test_model->count($where);

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }
        exit;
    }

    function take() {
        $testID = $this->input->get('id');
        $this->test_model->setID($testID);
        $type = $this->test_model->getTypeFromTestID();

        switch( $type ) {
            case Test_model::TEST_TYPE_POLL:
                redirect('test/take_poll/?id='.$testID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_SURVEY:
                redirect('test/take_survey/?id='.$testID,'refresh' );;
                break;
            case Test_model::TEST_TYPE_EXAM:
                redirect('test/take_exam/?id='.$testID,'refresh' );
                break;
        }
    }

    function take_poll() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_POLL) ) {

            $this->form_validation->set_rules('sub', lang('sub'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {
                $this->test_model->setID( $testID );
                $testInfo = $this->test_model->getTakeTestInfo();
                $choise = $this->input->post('choise');

                if( $this->test_taken_model->parseUserAnswers($testInfo,$choise) ) {

                    $input_test_taken = array(
                        'user_test_test_id' => $testID,
                        'user_test_user_id' => $this->ion_auth->get_user_id(),
                    );

                    if( $testTakenID = $this->test_taken_model->create( $input_test_taken ) ) {

                        $input_test_taken_answers = array(
                            'test_tanken_id' => $testTakenID,
                            'choise' => $choise
                        );
                        $this->test_taken_model->createTestTakenAnswers( $input_test_taken_answers );

                        $this->session->set_flashdata('message_success', lang('test_success') );
                        redirect('user/show_tests_taken_all','refresh');
                    } else {
                        log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                        $this->session->set_flashdata('message_failure', lang('test_failure') );
                        redirect('user/show_tests_taken_all','refresh');
                    }
                } else {
                    $this->session->set_flashdata('message_success', lang('test_failure') );
                    redirect('test/take_poll/?id='.$testID,'refresh');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo( );

            $this->_render_page( $this,'/test/take_poll' );
        } else {
            redirect('user/show_tests', 'refresh');
        }
    }

    function take_survey() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_SURVEY) ) {
            $this->form_validation->set_rules('sub', lang('sub'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {
                $this->test_model->setID( $testID );
                $testInfo = $this->test_model->getTakeTestInfo();
                $choise = $this->input->post('choise');

                if( $this->test_taken_model->parseUserAnswers($testInfo,$choise) ) {

                    $input_test_taken = array(
                        'user_test_test_id' => $testID,
                        'user_test_user_id' => $this->ion_auth->get_user_id(),
                    );

                    if( $testTakenID = $this->test_taken_model->create( $input_test_taken ) ) {

                        $input_test_taken_answers = array(
                            'test_tanken_id' => $testTakenID,
                            'choise' => $choise
                        );
                        $this->test_taken_model->createTestTakenAnswers( $input_test_taken_answers );

                        $this->session->set_flashdata('message_success', lang('test_success') );
                        redirect('user/show_tests_taken_all','refresh');
                    } else {
                        log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                        $this->session->set_flashdata('message_failure', lang('test_failure') );
                        redirect('user/show_tests_taken_all','refresh');
                    }
                } else {
                    $this->session->set_flashdata('message_success', lang('test_failure') );
                    redirect('test/take_survey/?id='.$testID,'refresh');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo( );

            $this->_render_page( $this,'/test/take_survey' );
        } else {
            redirect('user/show_tests', 'refresh');
        }
    }

    function take_exam() {
        $testID = $this->input->get('id');

        if( $this->test_model->checkType($testID,Test_model::TEST_TYPE_EXAM) ) {
            $this->form_validation->set_rules('sub', lang('sub'), 'required'); /* Unique? */

            if(  $this->form_validation->run() ) {
                $this->test_model->setID( $testID );
                $testInfo = $this->test_model->getTakeTestInfo();
                $choise = $this->input->post('choise');

                if( $this->test_taken_model->parseUserAnswers($testInfo,$choise) ) {

                    $input_test_taken = array(
                        'user_test_test_id' => $testID,
                        'user_test_user_id' => $this->ion_auth->get_user_id(),
                    );

                    if( $testTakenID = $this->test_taken_model->create( $input_test_taken ) ) {

                        $input_test_taken_answers = array(
                            'test_tanken_id' => $testTakenID,
                            'choise' => $choise
                        );
                        $this->test_taken_model->createTestTakenAnswers( $input_test_taken_answers );


                        $this->session->set_flashdata('message_success', lang('test_success') );
                        redirect('user/show_tests_taken_all','refresh');
                    } else {
                        log_message( 'error', ERROR_DEPOSIT_CREATION_FAIL ." ". $this->db->last_query() );
                        $this->session->set_flashdata('message_failure', lang('test_failure') );
                        redirect('user/show_tests_taken_all','refresh');
                    }
                } else {
                    $this->session->set_flashdata('message_success', lang('test_failure') );
                    redirect('test/take_exam/?id='.$testID,'refresh');
                }
            }

            /* Test Info */
            $this->test_model->setID( $testID );
            $this->data['take_test_info'] = $this->test_model->getTakeTestInfo( );


            $this->_render_page( $this,'/test/take_exam' );
        } else {
            redirect('user/show_tests', 'refresh');
        }
    }

}
