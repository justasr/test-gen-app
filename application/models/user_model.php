<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User_model extends MY_Model
{
    const TYPE_USER_ACTIVE = 1;
    const TYPE_USER_INACTIVE = 2;
    const TYPE_USER_ACTIVE_INVESTER = 3;
    const TYPE_USER_INACTIVE_INVESTER = 4;

    function __construct() {
        parent::__construct();

        $this->table_name = "tbl_users";
        $this->index_name = "id";
        $this->rel_tables["groups"] = "tbl_groups";
        $this->rel_tables["users_groups"] = "tbl_users_groups";
        $this->load->database();
        $this->load->config('ion_auth', TRUE);
        $this->load->helper('cookie');
        $this->load->helper('date');
        $this->lang->load('ion_auth');
        $this->load->library('data_filter');

    }

    /* START  setters / getters */

    public function setType( $type ) {
        $this->db->update( $this->tables['users'], array( 'type' => $type ) , array('id' => $this->ID ) );
    }

    public function getType() {
        $query = $this->db->select('type')
            ->where('id', $this->ID)
            ->limit(1)
            ->get( $this->tables['users'] );

        foreach ($query->result() as $row)
            return $row;
    }

    /* END  setters / getters */

    public function getAllMembers( $filter = null ) {

        if( $filter != null ) {

        } else {
            $this->db->from( $this->table_name );
            $this->db->join( $this->rel_tables["users_groups"],$this->table_name.".id" ." = ". $this->rel_tables["users_groups"].".user_id" );
            $this->db->where( 'group_id',Ion_auth::GROUP_ID_MEMBER );
            $query = $this->db->select( "$this->table_name.id, username,email,created_on,last_login,active,first_name,last_name,type" )->get( );

            foreach ($query->result_array() as $row)
                $data[] = $row;

            return $data;
        }

    }

    public function getAllMembersIDs( $filter = null ) {

        if( $filter != null ) {

        } else {
            $this->db->from( $this->table_name );
            $this->db->join( $this->rel_tables["users_groups"],$this->table_name.".id" ." = ". $this->rel_tables["users_groups"].".user_id" );
            $this->db->where( 'group_id',Ion_auth::GROUP_ID_MEMBER );
            $query = $this->db->select( "$this->table_name.id" )->get( );

            foreach ($query->result_array() as $row)
                $data[] = $row;

            return $data;
        }

    }

    /*
     * Pridėti current sum ir panašiai
     */
    public function prepareUserInfoForTable( $users_info ) {
        //id 	ip_address 	username 	password 	salt 	email 	activation_code 	forgotten_password_code 	forgotten_password_time 	remember_code 	created_on 	last_login 	active 	first_name 	last_name 	type 	last_login_ip 	deposits_sum 	withdrawals_sum 	current_sum
        $_output = array();
        $_output[] = $this->getTableHeaders();

        foreach( $users_info as $user_info )
            $_output[] = $user_info;

        return $_output;

    }

    public function getTableColumnsWithHeaders() {
        return array(  'Username' => 'username', 'Firstname' => 'first_name', 'Lastname' => 'last_name', 'Email'=>'email', 'Last login' => 'last_login', 'Active' => 'active' );
    }

    public function getTableColumns() {
        $columnsWithHeaders = $this->getTableColumnsWithHeaders();
        return array_values($columnsWithHeaders);
    }

    public function getTableHeaders() {
        $columnsWithHeaders = $this->getTableColumnsWithHeaders();
        return array_keys($columnsWithHeaders);
    }

    /*
     * Ištraukia MEMBERIUS pagal padauota filtrą
     */
    public function getMembers( $filter,$columns ) {

        $query  = "SELECT
            SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $columns))."`
		    FROM   $this->table_name ".
            $filter['where']." ".
            $filter['order']." ".
            $filter['limit'];

        $result = $this->db->query( $query );
        $data = array();
        foreach ($result->result_array() as $row)
            $data[] = $row;



        return $data;
    }

}
