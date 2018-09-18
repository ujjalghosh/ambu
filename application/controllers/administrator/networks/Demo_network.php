<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_network extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
		$this->load->model('administrator/network/Demo_network_model');
        $this->load->model('administrator/email_template_model');
		$this->load->helper('cookie');
		
		$data['page_title']='Demo Network Request';
		$data['meta_keywords']='This is admin dashboard ';
		$data['meta_description']='This is description';
		$this->seoData=$data;
	}
	 function index(){
		
		$data=$this->seoData;
		$this->load->view('administrator/networks/demo_request', $data);
	}
	

    function fetch_single_demo_network()  
      {  
           $output = array();  
             
           $data = $this->Demo_network_model->fetch_single_network($_POST["demo_id"]);  
           foreach($data as $row)  
           {  
                $output['demo_id']              =   $row->demo_id;                      
                $output['demo_name']            =   $row->demo_name;
                $output['demo_institute_name']  =   $row->demo_institute_name; 
                $output['demo_city_name']       =   $row->demo_city_name;     
                $output['demo_official_mail']   =   $row->demo_official_mail;   
                $output['demo_remarks']         =   $row->demo_remarks;   
                $output['demo_phone']           =   $row->demo_phone; 
                $output['request_date']         =   $row->request_date;   
                $output['request_status']       =   $row->request_status;   
           }  
           echo json_encode($output);  
      }  
     function demo_network_action(){  
        $action= $this->input->post('action');
        $return_data = array(); 
           if($action == "Add")  
           {  
 
           }  
           if($action== "Edit")  
           {  
        $request_status=$this->input->post('request_status');

                $updated_data = array(  
                     'request_status'          =>     $this->input->post('request_status')
                );  
              
               $insert_id= $this->Demo_network_model->demo_network_edit($this->input->post("demo_id"), $updated_data);  
                if($insert_id){
/*            $email_msg  = $this->email_template_model->Email_template_details(6);
            $admin_info=getAdminUsername(1);       
            $subject =$email_msg->title; 
            $message=str_replace('###USERDETAILS###',$user_info,(str_replace('###APROVALLINK###',$aproval_link,$email_msg->template_content)));          
             SendEmailTo($user['user_email'],$subject,$message); */

                $return_data["status"]=TRUE;
                 $return_data["msg"]="Network is ".$request_status.".";
                }else{
                $return_data["status"]=FALSE;
                 $return_data["msg"]="Sorry, Nothing is updated";
                }
           }  
           $return_data["action"]=$action;
           echo json_encode($return_data);
      } 


    public function getTable()
    {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
$aColumns = array('demo_id', 'demo_name', 'demo_institute_name', 'demo_city_name','demo_official_mail','demo_phone','request_date','request_status');
        
        // DB table to use
        $sTable = 'request_demo';
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
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }

}