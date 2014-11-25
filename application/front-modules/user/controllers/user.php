<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APP_PATH."core/MY_User_Controller.php";

class User extends MY_User_Controller {

    public function __construct() {
        parent::__construct();

        $this->lang->load('user');
        $this->lang->load('test');

        $this->load->model('user_model');
        $this->load->model('test_model');
        $this->load->model('test_taken_model');
    }

	public function index()
	{
        //redirect('user/auth/login', 'refresh');
        exit;

        $this->_render_page($this,'/user/index');
	}

    public function statistics()
    {
        //redirect("user/statistics", 'refresh');
        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/index');
    }

    public function show_tests()
    {
        $this->data['headers'] = array_merge(
            $this->test_model->getPublicTableHeaders(),
            $this->test_model->getPublicAdditionalHeaders()
        ) ;

        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/show_tests');
    }

    public function user_tests()
    {
        $this->data['headers'] = array_merge(
            $this->test_model->getPublicTableHeaders(),
            $this->test_model->getPublicAdditionalHeaders()
        ) ;

        $this->data['user_info']['id'] = $this->ion_auth->get_user_id();

        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/user_tests');
    }

    public function show_tests_taken_all()
    {
        $this->data['headers'] = array_merge(
            $this->test_taken_model->getPublicTableHeaders(),
            $this->test_taken_model->getPublicAdditionalHeaders()
        ) ;

        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/show_tests_taken');
    }

    public function show_tests_taken_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_taken_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_taken_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $userID = $this->ion_auth->get_user_id();

            if( $userID != null )
                $filter['where'] .= " AND user_test_user_id = '$userID' ";

            $selected = $this->test_taken_model->getTestTaken(  $filter, $this->data_filter->columns );
            $this->test_taken_model->setAdditionalColumns( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_taken_model->count( array( 'user_test_user_id' => $userID ) );

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    public function show_tests_taken_polls()
    {
        $this->data['headers'] = array_merge(
            $this->test_taken_model->getPublicTableHeaders(),
            $this->test_taken_model->getPublicAdditionalHeaders()
        ) ;

        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/show_tests_taken_polls');
    }

    public function show_tests_taken_polls_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_taken_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_taken_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $userID = $this->ion_auth->get_user_id();
            if( $userID != null )
                $filter['where'] .= " AND user_test_user_id = '$userID' ";
            $filter['where'] .= " AND test_type = '".Test_model::TEST_TYPE_POLL."' ";


            $selected = $this->test_taken_model->getTestTaken(  $filter, $this->data_filter->columns );
            $this->test_taken_model->setAdditionalColumns( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_taken_model->count( array( 'user_test_user_id' => $userID ) );

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    public function show_tests_taken_surveys()
{
    $this->data['headers'] = array_merge(
        $this->test_taken_model->getPublicTableHeaders(),
        $this->test_taken_model->getPublicAdditionalHeaders()
    ) ;

    /* Išplėstas indeksas */
    $this->_render_page($this,'/user/show_tests_taken_surveys');
}

    public function show_tests_taken_surveys_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_taken_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_taken_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $userID = $this->ion_auth->get_user_id();
            if( $userID != null )
                $filter['where'] .= " AND user_test_user_id = '$userID' ";
            $filter['where'] .= " AND test_type = '".Test_model::TEST_TYPE_SURVEY."' ";


            $selected = $this->test_taken_model->getTestTaken(  $filter, $this->data_filter->columns );
            $this->test_taken_model->setAdditionalColumns( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_taken_model->count( array( 'user_test_user_id' => $userID ) );

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    public function show_tests_taken_exams()
    {
        $this->data['headers'] = array_merge(
            $this->test_taken_model->getPublicTableHeaders(),
            $this->test_taken_model->getPublicAdditionalHeaders()
        ) ;

        /* Išplėstas indeksas */
        $this->_render_page($this,'/user/show_tests_taken_exams');
    }

    public function show_tests_taken_exams_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_taken_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_taken_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $userID = $this->ion_auth->get_user_id();
            if( $userID != null )
                $filter['where'] .= " AND user_test_user_id = '$userID' ";
            $filter['where'] .= " AND test_type = '".Test_model::TEST_TYPE_EXAM."' ";


            $selected = $this->test_taken_model->getTestTaken(  $filter, $this->data_filter->columns );
            $this->test_taken_model->setAdditionalColumns( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_taken_model->count( array( 'user_test_user_id' => $userID ) );

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    public function show_tests_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $this->input->get("user_id",true);

            if( $userID != null )
                $filter['where'] = " AND test_user_id = '$userID' ";

            $filter['where'] = " AND test_status = '".Test_model::TEST_STATUS_PUBLIC."' ";

            $selected = $this->test_model->getTests(  $filter, $this->data_filter->columns );
            $this->test_model->setAdditionalForEveryOne( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_model->count();

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }

    function show_user_tests_ajax()
    {
        if( intval($this->input->get("ajax_call",true)) == 1) {
            $this->data_filter->setColumns( $this->test_model->getPublicTableColumns() );
            $this->data_filter->setIndexColumn( $this->test_model->index_name );
            $this->data_filter->setData( $this->input->get() );

            $this->data_filter->init();
            $filter = $this->data_filter->get_filter();

            $userID = $this->input->get("user_id",true);

            if( $userID != null )
                $filter['where'] = " AND test_user_id = '$userID' ";


            $selected = $this->test_model->getTests(  $filter, $this->data_filter->columns );
            $this->test_model->setAdditionalColumnsForOwner( $selected );
            $totalDisplayRecords = count( $selected );
            $totalRecords = $this->test_model->count();

            echo $this->data_filter->buildOutput( $selected,$totalRecords,$totalRecords );
        }

        exit;
    }




}
