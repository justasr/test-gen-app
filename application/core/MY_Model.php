<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Model extends CI_Model {

    public $table_name;
    public $index_name;
    public $rel_tables = array();
    public $ID;
    public $userID;

    public $additionalData = array();

    /**
     * Constructor
     *
     * @access public
     */
    function __construct()
    {
        parent::__construct();

    }

    /* Setters 'N Getters */

    public function setID( $id ) {
        $this->ID = $id;
    }

    public function getID( ) {
        return $this->ID;
    }

    public function setUser( $id ) {
        $this->userID = $id;
    }

    public function getUser( ) {
        return $this->userID;
    }

    public function get() {
        $this->db->where( $this->index_name, $this->ID );
        $this->get( $this->table );
    }

    /*
     *
     */
    public function count( $where = array() ) {
        foreach( $where as $key => $value )
            $this->db->where($key,$value);

        return $this->db->count_all_results($this->table_name);
    }

    public function getPublicTableColumnsWithHeaders() {
        return array();
    }

    public function getPublicTableColumns() {
        $columnsWithHeaders = $this->getPublicTableColumnsWithHeaders();
        return array_values($columnsWithHeaders);
    }

    public function getPublicTableHeaders() {
        $columnsWithHeaders = $this->getPublicTableColumnsWithHeaders();
        return array_keys($columnsWithHeaders);
    }

    public function getAdminTableColumns() {
        $columnsWithHeaders = $this->getPublicTableColumnsWithHeaders();
        return array_values($columnsWithHeaders);
    }

    public function getAdminTableHeaders() {
        $columnsWithHeaders = $this->getPublicTableColumnsWithHeaders();
        return array_keys($columnsWithHeaders);
    }

    /* END Setters 'N Getters */



}