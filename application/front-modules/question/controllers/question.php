<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class Question extends MY_User_Controller {

	function __construct()
	{
		parent::__construct();

        $this->lang->load('test');
        $this->lang->load('question');
        $this->load->model('test_model');
        $this->load->model('question_model');

	}


    function create() {
        $testID = $this->input->get('test_id');
        if( $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {
            $test_type = $this->test_model->getTypeFromTestID($testID);
            $question_types = $this->question_model->getTypes();
            $this->question_model->prepareForTestType($test_type,$question_types);

            $this->form_validation->set_rules('question_name', lang('l_question_name'), 'required');
            $this->form_validation->set_rules('question_type', lang('l_question_type'), 'required');

            $input = array(
                'question_test_id' => $testID,
                'question_name' => $this->input->post('question_name'),
                'question_type' => $this->input->post('question_type'),
            );
            $input_answers = array(
                'corrent' => $this->input->post('qa_'.$input['question_type'].'_corrent'),
                'answers' => $this->input->post('qa_'.$input['question_type']),
            );


            if(  $this->form_validation->run() && !empty($input_answers['corrent']) && !empty($input_answers['answers']) ) {
                // Vykdomas insert'as
               if( $questionID = $this->question_model->create($input) ) {

                   $this->question_model->setID($questionID);
                   $this->question_model->answers_create( $input_answers );

                   $this->session->set_flashdata('message_success', lang('create_success') );
                   redirect('test/edit/?id='.$testID, 'refresh');

               } else {
                   $this->session->set_flashdata('message_failure', lang('create_failure') );
                   redirect('user/show_tests', 'refresh');
               }
            }

            $this->data['test_info']['idtest'] = $testID;
            $this->data['question_types'] = $question_types;
            $this->_render_page( $this,'/question/create' );
        }
        else
            redirect('user/show_tests', 'refresh');
    }

    function edit() {
        $testID = $this->input->get('test_id');
        $questionID = $this->input->get('question_id');
        if( $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) && intval($questionID) != 0 ) {
            $this->question_model->setID($questionID);
            $test_type = $this->test_model->getTypeFromTestID($testID);
            $question_types = $this->question_model->getTypes();
            $this->question_model->prepareForTestType($test_type,$question_types);

            $this->form_validation->set_rules('question_name', lang('l_question_name'), 'required');
            $this->form_validation->set_rules('question_type', lang('l_question_type'), 'required');

            $input = array(
                'idquestion' => $questionID,
                'question_test_id' => $testID,
                'question_name' => $this->input->post('question_name'),
                'question_type' => $this->input->post('question_type'),
            );
            $input_answers = array(
                'corrent' => $this->input->post('qa_'.$input['question_type'].'_corrent'),
                'answers' => $this->input->post('qa_'.$input['question_type']),
            );


            if(  $this->form_validation->run() && !empty($input_answers['corrent']) && !empty($input_answers['answers']) ) {
                // Vykdomas insert'as
                if( $this->question_model->create($input) ) {
                    $this->question_model->answers_create( $input_answers );

                    $this->session->set_flashdata('message_success', lang('edit_success') );
                    redirect('test/edit/?id='.$testID, 'location');

                } else {
                    $this->session->set_flashdata('message_failure', lang('edit_failure') );
                    redirect('test/edit/?id='.$testID, 'location');
                }
            }
            $this->data['question_info'] = $this->question_model->getFull();
            $this->data['answers_info'] = $this->question_model->getFullAnswers();

            $this->data['test_info']['idtest'] = $testID;
            $this->data['question_types'] = $question_types;
            $this->_render_page( $this,'/question/edit' );
        }
        else
            redirect('test/edit/?id='.$testID, 'location');
    }

    function delete() {
        $testID = $this->input->get('test_id');
        $questionID = $this->input->get('question_id');
        if( $this->test_model->checkOwnership($testID,$this->ion_auth->get_user_id()) ) {
            $this->question_model->setID($questionID);

            if( $this->question_model->delete() ) {
                $this->question_model->deleteAnswers();

                $this->session->set_flashdata('message_success', lang('delete_success') );
                redirect('test/edit/?id='.$testID, 'location');
            } else {
                $this->session->set_flashdata('message_failure', lang('delete_success') );
                redirect('test/edit/?id='.$testID, 'location');
            }

        }
    }


}
