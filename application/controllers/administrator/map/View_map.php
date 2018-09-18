<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_map extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
		
		$this->load->helper('cookie');
		
	}
	 function index(){

            $this->db->distinct();
            $this->db->select('device_id'); 
           $query=$this->db->get('location_tracking');  
           $data['device']= $query->result();
		
		
		$this->load->view('administrator/map/view_map', $data);
	}
	

    function get_device_location()  
      {  
        $return_data["location"] = array();

        $device_id=$this->input->post('device_id',TRUE);

           $output = array();  
           $this->db->where('device_id', $device_id);
           $query=$this->db->get('location_tracking');  
           $data= $query->result();
             
            
           foreach($data as $row)  
           {  
                $output['device_id']         =   $row->device_id;                      
                $output['lat']   =   $row->device_latitude;
                $output['lng']  =   $row->device_longitude; 
                $output['title']     =   $row->recorded_time; 
                array_push($return_data["location"], $output);  
           }  
           echo json_encode($return_data);  
      }  
      


}