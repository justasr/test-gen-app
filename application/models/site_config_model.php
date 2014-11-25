<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Site_config_model extends CI_Model
{
    public $table_name;
    public $rel_tables = array();

    function __construct() {
        parent::__construct();
        $this->table_name = "tbl_configs";
        $this->load->database();
    }

    function load_configs() {
        $query = $this->db->query("SELECT name,value FROM $this->table_name ");

        foreach ($query->result() as $key => $value)
            $data[ $value->name ] = $value->value;


        return $data;
    }

}
