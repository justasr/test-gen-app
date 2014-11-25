<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export_manager
{

    public $file_input_name;
    public $userID;
    public $testID;


    public $import_file_info = array();
    public $test_info = array();
    public $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('url');
        $this->CI->load->model('test_model');
        $this->CI->load->model('question_model');

    }


    public function initExport( $userID,$testID ) {
        $this->userID = $userID;
        $this->testID = $testID;
    }

    public function printJSON() {
        $this->CI->test_model->setID( $this->testID );
        $allData = $this->CI->test_model->getTakeTestInfo();

        $this->test_info = $this->prepareForJSON($allData);

        header('Content-disposition: attachment; filename='.$allData['test_info']['test_name'].'.json');
        header ("Content-Type:application/json");
        echo json_encode($this->test_info);

    }
    public function printXML() {
        $this->CI->test_model->setID( $this->testID );
        $this->test_info = $this->CI->test_model->getTakeTestInfo();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><document></document>');

        $xml->addAttribute('version', '1.0');
        $xml_test = $xml->addChild('test');
        $xml_test->addChild('title',$this->test_info['test_info']['test_name'] );
        $xml_test->addChild('type',$this->test_info['test_info']['test_type'] );

        $xml_questions = $xml_test->addChild('questions');
        foreach($this->test_info['questions_with_answers'] as $question ) {
            $xml_question = $xml_questions->addChild('question');
            $xml_question->addChild('title',$question['question_name']);
            $xml_question->addChild('type',$question['question_type']);

            $xml_answers = $xml_question->addChild('answers');

            foreach( $question['answers'] as $answer ) {
                $xml_answer = $xml_answers->addChild('answer');
                $xml_answer->addAttribute('correct',$answer['answer_corrent']);
                $xml_answer->addChild('title',$answer['answer_name']);
            }

        }

        header('Content-disposition: attachment; filename='.$this->test_info['test_info']['test_name'].'.xml');
        header ("Content-Type:text/xml");
        echo $xml->asXML();
    }
    public function prepareForJSON( $inputData ) {
        $_output = array();
        $_output['test_name'] = $inputData['test_info']['test_name'];
        $_output['test_type'] = $inputData['test_info']['test_type'];

        $_output['questions'] = array();
        foreach( $inputData['questions_with_answers'] as $question ) {
            $json_question = array();
            $json_question['question_name'] = $question['question_name'];
            $json_question['question_type'] = $question['question_type'];
            $json_question['answers'] = array();
            $json_question['answers']['options'] = array();
            $json_question['answers']['correct'] = array();

            $answerNumber = 0;
            foreach ($question['answers']  as $answer) {
                $json_question['answers']['options'][$answerNumber] = (string) $answer['answer_name'];
                if( $answer['answer_corrent'] != 0 )
                    $json_question['answers']['correct'][] = (string) $answerNumber;
                $answerNumber++;
            }
            $_output['questions'][] = $json_question;

        }

        return array( $_output );
    }

}