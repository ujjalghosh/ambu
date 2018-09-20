<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class services extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct(); 
		$this->load->model('api/Services_model');
		 


	}
	 function index(){

$data = $this->Services_model->getAllservices(); 
if( count($data) < 1 ){


     $return_data['msg'] = strip_tags("No data found");
    $return_data['status'] = FALSE; 
}else{
    $return_data["service_list"] = array();
foreach ($data as $row){ 
    $services = array();
        $services["service_id"]             =   $row['service_id'];
        $services["service_name"]                  =   $row['service_name'];
        array_push($return_data["service_list"], $services);

}

  $return_data['msg'] = strip_tags("Services list");
    $return_data['status'] = true; 
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