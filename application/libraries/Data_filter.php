<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Data_filter
{
    public $sLimit = "";
    public $sOrder = "";
    public $sWhere = "";

    public $indexColumn ="";

    public $iFilteredTotal = "";
    public $iTotal = "";
    public $data = array();
    public $columns = array();
    public $output_array = array();


    /* SETTERS N GETTERS */
    public function setColumns( $columns ) {
        $this->columns = $columns;
    }

    public function setIndexColumn( $column ) {
        $this->indexColumn = $column;
    }

    public function setData( $data ) {
        $this->data = $data;
    }

    /* END SETTERS N GETTERS */

    public function formPaging() {

        if ( isset( $this->data['iDisplayStart'] ) && $this->data['iDisplayLength'] != '-1' )
        {
            $this->sLimit = "LIMIT ".intval( $this->data['iDisplayStart'] ).", ".
                intval( $this->data['iDisplayLength'] );
        }

        return $this->sLimit;
    }

    public function formOrdering() {

        if ( isset( $this->data['iSortCol_0'] ) )
        {
            $this->sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $this->data['iSortingCols'] ) ; $i++ )
            {
                if ( $this->data[ 'bSortable_'.intval($this->data['iSortCol_'.$i]) ] == "true" )
                {
                    $this->sOrder .= "`".$this->columns[ intval( $this->data['iSortCol_'.$i] ) ]."` ".
                        ($this->data['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                }
            }

            $this->sOrder = substr_replace( $this->sOrder, "", -2 );
            if ( $this->sOrder == "ORDER BY" )
            {
                $this->sOrder = "";
            }
        }
    }

    public function formFiltering() {

        $this->sWhere = "WHERE 1 "; // Apsauga kad būtų galima pridėti AND

        if ( isset($this->data['sSearch']) && $this->data['sSearch'] != "" )
        {
            $this->sWhere .= " AND (";
            for ( $i=0 ; $i<count($this->columns) ; $i++ )
            {
                if ( isset($this->data['bSearchable_'.$i]) && $this->data['bSearchable_'.$i] == "true" )
                {
                    $this->sWhere .= "`".$this->columns[$i]."` LIKE '%".mysql_real_escape_string( $this->data['sSearch'] )."%' OR ";
                }
            }
            $this->sWhere = substr_replace( $this->sWhere, "", -3 );
            $this->sWhere .= ')';
        }

        /* Individual column filtering */
        for ( $i=0 ; $i<count($this->columns) ; $i++ )
        {
            if ( isset($this->data['bSearchable_'.$i]) && $this->data['bSearchable_'.$i] == "true" && $this->data['sSearch_'.$i] != '' )
            {
                if ( $this->sWhere == "" )
                {
                    $this->sWhere = "WHERE ";
                }
                else
                {
                    $this->sWhere .= " AND ";
                }
                $this->sWhere .= "`". $this->columns[$i]."` LIKE '%".mysql_real_escape_string($this->data['sSearch_'.$i])."%' ";
            }
        }
        /* END Individual column filtering */
    }

    public function init() {
        $this->formPaging();
        $this->formOrdering();
        $this->formFiltering();
    }

    public function dataFilterLengthQuery() {
        return " SELECT FOUND_ROWS() ";
    }

    public function prepareDataForOutput( $data ) {
       $_data = array();
       foreach( $data as $rows ) {
           $_rows = array();

           foreach( $rows as $row )
               $_rows[] = $row;

           $_data[] = $_rows;
       }

        return $_data;

    }

    public function buildOutput( $data, $iTotal, $iFilteredTotal ) {

        $this->output_array = array(
            "sEcho" =>  intval($this->data['sEcho']),
            "iTotalRecords" => (string) $iTotal,
            "iTotalDisplayRecords" => (string) $iFilteredTotal,
            "aaData" => $this->prepareDataForOutput( $data )
        );

        return json_encode( $this->output_array );
    }

    public function get_filter() {
        return array( 'where' => $this->sWhere, 'order' => $this->sOrder, 'limit' =>  $this->sLimit  );
    }


}

// END Template class