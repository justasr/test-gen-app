<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import_manager
{

    public $file_input_name;
    public $userID;
    public $import_file_info = array();
    public $import_data = array();
    public $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->model('test_model');
        $this->CI->load->model('question_model');

    }


    public function initImport( $userID,$file_input_name ) {
        $this->file_input_name = $file_input_name;
        $this->userID = $userID;
    }

    public function uploadXMLFile() {
        $uploadConfigs = array();
        $uploadConfigs['upload_path'] = $this->CI->config->item('xml_upload_path');
        $uploadConfigs['allowed_types'] = 'xml';
        $uploadConfigs['file_type'] = "text/xml";
        $uploadConfigs['max_size']	= '1000';
        $uploadConfigs['overwrite']	= 'TRUE';

        $this->CI->load->library('upload', $uploadConfigs);

        if ( !$this->CI->upload->do_upload($this->file_input_name))
        {
            $error =  $this->CI->upload->display_errors();
            $this->CI->session->set_flashdata('message_failure', $error );
            return false;
        }
        else
        {
            $this->import_file_info = $this->CI->upload->data();
            return true;
        }


    }

    public function parseXML() {
        $this->import_data = array(); // Resetas padaromas
        $xmlData = simplexml_load_file($this->import_file_info['full_path']);

        foreach ($xmlData->test as $xmlTest) {
            $newTest =  array();
            $newTest['test_name'] = (string) $xmlTest->title;
            $newTest['test_type'] = (string) $xmlTest->type;
            foreach ($xmlTest->questions->question  as $xmlQuestion) {
                $question = array();
                $question['question_name'] = (string) $xmlQuestion->title;
                $question['question_type'] = (string) $xmlQuestion->type;

                $answerNumber = 0;
                foreach ($xmlQuestion->answers->answer  as $xmlAnswer) {

                    $question['answers']['options'][$answerNumber] = (string) $xmlAnswer->title;
                    if( $xmlAnswer['correct'] != 0 )
                        $question['answers']['correct'][] = (string) $answerNumber;

                    $answerNumber++;
                }
                $newTest['questions'][] = $question;
            }
            $this->import_data[] = $newTest;
        }


        return true;
    }

    public function save() {
        foreach( $this->import_data as $test ) {
            $inputTest = array(
                'test_name' =>  $test['test_name'],
                'test_type' =>  $test['test_type'],
                'test_user_id' => $this->userID
            );
             $testID = $this->CI->test_model->create( $inputTest );

            foreach( $test['questions'] as $question ) {
                $inputQuestion = array(
                    'question_test_id' => $testID,
                    'question_name' => $question['question_name'],
                    'question_type' => $question['question_type'],
                );
                $inputAnswers = array(
                    'corrent' => $question['answers']['correct'],
                    'answers' => $question['answers']['options'],
                );

               $questionID = $this->CI->question_model->create($inputQuestion);

                $this->CI->question_model->setID($questionID);
                $this->CI->question_model->answers_create($inputAnswers);
            }
        }

        return true;

    }

    public function deleteFile() {
        if( file_exists( $this->import_file_info['full_path'] ) ) {
            unlink( $this->import_file_info['full_path'] );
        }
    }

    public function uploadJSONFile() {
        $uploadConfigs = array();
        $uploadConfigs['upload_path'] = $this->CI->config->item('xml_upload_path');
        $uploadConfigs['allowed_types'] = 'json';
        $uploadConfigs['file_type'] = "application/json";
        $uploadConfigs['max_size']	= '1000';
        $uploadConfigs['overwrite']	= 'TRUE';

        $this->CI->load->library('upload', $uploadConfigs);

        if ( !$this->CI->upload->do_upload($this->file_input_name))
        {
            $error =  $this->CI->upload->display_errors();
            $this->CI->session->set_flashdata('message_failure', $error );
            return false;
        }
        else
        {
            $this->import_file_info = $this->CI->upload->data();
            return true;
        }
    }

    public function parseJSON() {
        $fileContnet = file_get_contents(  $this->import_file_info['full_path'] );
        $this->import_data =  json_decode($fileContnet,true);
        return true;
    }
}