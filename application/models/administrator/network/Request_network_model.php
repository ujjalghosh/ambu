<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 */
class Request_network_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	



function fetch_single_network($request_id)  
      {  
           $this->db->where("request_id", $request_id);  
           $query=$this->db->get('request_network');  
           return $query->result();  
      }
	
		function request_network_edit($request_id,$data){	
		if($this->db->update('request_network', $data, array('request_id' =>$request_id))) {

			$data = $this->fetch_single_network($request_id);
		$output = array();
		  foreach($data as $row)  
           {   
                $output['requestor']              =   $row->request_id;                      
                $output['network_name']            =   $row->request_institute;
                $output['institution_name']  =   $row->request_institute; 
                $output['city']       =   $row->request_user_city;     
                $output['email']   =   $row->request_user_mail;     
                $output['phone']           =   $row->request_user_phone; 
                 $output['location']           =   $row->request_location; 
                $output['network_type']         =   'Request';   
                $output['network_status']       =   $row->request_status;   
                $where = array('network_name' => $row->request_institute, 'requestor' => $row->request_id, 'network_type' => 'Request');
                $update_where = array('requestor' => $row->request_id, 'network_type' => 'Request');
           } 

           
 		   $this->db->where($where);  
           $query=$this->db->get('new_network');  
           $check_available = $query->num_rows();
 			if ($check_available>0) {
      $data= $query->row_array();  

			$network_status=$this->input->post('request_status');

 			$this->db->update('new_network', array('network_status'=>$network_status), $update_where);
       $network_id = $data['new_network_id'];       
 			}else{
           $this->db->insert('new_network', $output);
           $network_id = $this->db->insert_id();
       		}	
if($network_id>0){
$this->db->where("network_id", $network_id);          
     $query=$this->db->get('network_master');  
           $check_available = $query->num_rows();
      if ($check_available>0) { 
        $this->db->update('network_master',  array('network_id'=>$network_id,'name'=>$output['network_name']),array('network_id'=>$network_id));
           }else{
            $this->db->insert('network_master', array('network_id'=>$network_id,'name'=>$output['network_name']));
           }
}


			return true;
		} else {
			return false;
		}
	}
	
}
