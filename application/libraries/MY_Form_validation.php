<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Form_validation extends CI_Form_validation {

    function __construct()
    {
        parent::__construct();
    }

    function exist($str, $value){

        list($table, $column) = explode('.', $value, 2);
        $query = $this->CI->db->query("SELECT COUNT(*) AS count FROM $table WHERE $column = $str");
        $row = $query->row();

        if( $row->count > 0 ) {
            return true;
        } else {
            $this->set_message(__FUNCTION__,'Bad %s format!');
            return false;
        }

    }

    function check_bankroll($str, $value){

        list($userBankroll, $curentPendingSum) = explode('.', $value, 2);

        if( intval( $userBankroll ) > intval( $str ) ) {
            $this->set_message(__FUNCTION__,' Bankroll is too small! ');
            return false;
        }  else if( intval( $curentPendingSum ) > intval( $str ) ) {
            $this->set_message(__FUNCTION__,' Pending deposits sum is too big! ');
            return false;
        }

        return true;


    }
}


