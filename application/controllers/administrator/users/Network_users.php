<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Network_users extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
		$this->load->model('administrator/users/Registered_users_model');
		$this->load->helper('cookie');
		
		$data['page_title']='Available Networks';
		$data['meta_keywords']='This is admin dashboard ';
		$data['meta_description']='This is description';
		$this->seoData=$data;
	}
	 function index(){
		
		$data=$this->seoData;
		$this->load->view('administrator/users/alumni_users', $data);
	}
	

    public function getALl_user_Table()
    {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
$aColumns = array('user_id', 'first_name', 'middle_name','last_name','user_email','oauth_provider','password','dob','gender','country','pincode','city','phone');
        
        // DB table to use
        $sTable = 'user_master';
        //
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }
        
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                if($col=='dob'){
             $row[] =date('d-M-Y', strtotime($aRow[$col]));
                }elseif ($col=='password') {
                    if(!empty($aRow[$col])){
                    $salt=$this->config->item('encryption_key');
                    $db_pass = $this->encrypt->decode($aRow[$col],$salt);
                    $row[] = $db_pass;
                    }else{$row[] = '';}
                    
                } else {
                $row[] = $aRow[$col];
             }
            }
    
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }



}