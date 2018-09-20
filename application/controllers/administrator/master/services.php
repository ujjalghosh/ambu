<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class services extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
        $this->load->library('form_validation'); 
		$this->load->model('administrator/master/Services_model');
		$this->load->helper('cookie');
		
		$data['page_title']='Available Networks';
		$data['meta_keywords']='This is admin dashboard ';
		$data['meta_description']='This is description';
		$this->seoData=$data;
	}
	 function index(){
		
		$data=$this->seoData;
		$this->load->view('administrator/master/services', $data);
	}
	

    public function getTable()
    {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
$aColumns = array('service_id', 'service_name', 'service_status');
        
        // DB table to use
        $sTable = 'services';
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


        function check() { 
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
   // $network_id=$this->input->post('network_id');
        
 
   }

    public function edit_unique($value, $params){ 
         $this->form_validation->set_message('edit_unique', 'Your provided %s is already taken.'); 
        
        
         list($table, $field, $id) = explode(".", $params, 3); 
          
         if($id=='0'){ 
               $query = $this->db->select($field)->from($table)->where($field, $value)->limit(1)->get(); 
          }else{ 
               $query = $this->db->select($field)->from($table)->where($field, $value)->where('service_id !=', $id)->limit(1)->get();      
          } 
          
         if ($query->row()) { 
             return false; 
         } else { 
              $value = str_replace(" ", '', $value); 
               if($id=='0'){ 
                    $query = $this->db->query("SELECT {$field} FROM {$table} WHERE REPLACE({$field}, ' ', '') = '{$this->db->escape_str($value)}'"); 
               }else{ 
                    $query = $this->db->query("SELECT {$field} FROM {$table} WHERE service_id!={$id} and REPLACE({$field}, ' ', '') = '{$this->db->escape_str($value)}'");      
               } 
                
                if ($query->row()) { 
                       return false; 
                } else { 
                    return true; 
                } 
         } 
     }

   function service_add_edit(){


        $action= $this->input->post('action');
        $service_id= $this->input->post('service_id', TRUE);
        $data['service_name']=$this->input->post('service_name', true); 
        $data['service_status']=$this->input->post('service_status', true);
    $this->form_validation->set_rules('service_id', 'service_id', 'required|integer');
    $this->form_validation->set_rules('service_status', 'service status', 'required'); 
    $this->form_validation->set_rules('service_name','services Name','required|trim|xss_clean|callback_edit_unique[{PRE}services.service_name.'.$service_id.']');
        $return_data = array(); 

        if($this->form_validation->run() == FALSE){
        $errors = array();
        // Loop through $_POST and get the keys
        foreach ($this->input->post() as $key => $value)
        {
            // Add the error message for this field
            $errors[$key] = form_error($key);
        }
        $return_data['errors'] = array_filter($errors);

        $return_data['msg'] = strip_tags(validation_errors());
        $return_data['status'] = FALSE; 
            
        }else{  


           if($action == "Add")  
           {  
         $insert_id= $this->Services_model->add_service( $data);  
                if($insert_id){

                $return_data["status"]=TRUE;
                 $return_data["msg"]="Service Added Successfully.";
                }else{
                $return_data["status"]=FALSE;
                 $return_data["msg"]="Sorry, Nothing is added";
                }
 
           }  
           if($action== "Edit")  
           {  
 
              
               $updated= $this->Services_model->edit_service($service_id, $data);  
                if($updated){

                $return_data["status"]=TRUE;
                 $return_data["msg"]="Service updated Successfully.";
                }else{
                $return_data["status"]=FALSE;
                 $return_data["msg"]="Sorry, Nothing is updated";
                }
           }  
       }
            
           echo json_encode($return_data);


   }


function fetch_single_service(){

               $output = array();  
             $service_id= $this->input->post('service_id', TRUE);
             $this->form_validation->set_rules('service_id', 'service_id', 'required|integer');
             if($this->form_validation->run() == FALSE){ 
        $return_data['msg'] = strip_tags(validation_errors());
        $return_data['status'] = FALSE;             
        }else{  
           $data = $this->Services_model->data_single_service($service_id);  
           foreach($data as $row)  
           {  
                $output['service_id']        =   $row->service_id;
                $output['service_name']      =   $row->service_name;
                $output['service_status']    =   $row->service_status;                 
           }  
       }
           echo json_encode($output);  

}

function change_status(){

              
             $service_id= $this->input->post('id', TRUE);
             $this->form_validation->set_rules('id', 'service_id', 'required|integer');
             if($this->form_validation->run() == FALSE){ 
        $return_data['msg'] = strip_tags(validation_errors());
        $return_data['status'] = FALSE;             
        }else{  
           $data = $this->Services_model->data_single_service($service_id);  
           foreach($data as $row)  
           {  
                $service_id        =   $row->service_id;                
                $service_status    =   $row->service_status;                 
           }  

           $service_status= $service_status== 'Inactive' ? 'Active' : 'Inactive';


               $updated= $this->Services_model->edit_service($service_id, array('service_status'=>$service_status));  
                if($updated){

                $return_data["status"]=TRUE;
                 $return_data["msg"]="Service status updated Successfully.";
                }else{
                $return_data["status"]=FALSE;
                 $return_data["msg"]="Sorry, Nothing is updated";
                }


       }
           echo json_encode($return_data);  

}

}