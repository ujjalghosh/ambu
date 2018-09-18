<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 */
class Demo_network_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	



function fetch_single_network($demo_id)  
      {  
           $this->db->where("demo_id", $demo_id);  
           $query=$this->db->get('request_demo');  
           return $query->result();  
      }
	
		function demo_network_edit($demo_id,$data){	
		if($this->db->update('request_demo', $data, array('demo_id' =>$demo_id))) {

		$data = $this->fetch_single_network($demo_id);
		$output = array();
		  foreach($data as $row)  
           {  
                $output['requestor']              =   $row->demo_id;                      
                $output['network_name']            =   $row->demo_name;
                $output['institution_name']  =   $row->demo_institute_name; 
                $output['city']       =   $row->demo_city_name;     
                $output['email']   =   $row->demo_official_mail;     
                $output['phone']           =   $row->demo_phone; 
                $output['network_type']         =   'Demo';   
                $output['network_status']       =   $row->request_status;   
                $where = array('network_name' => $row->demo_name, 'requestor' => $row->demo_id, 'network_type' => 'Demo');
                $update_where = array('requestor' => $row->demo_id, 'network_type' => 'Demo');
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
        $this->db->update('network_master', array('network_id'=>$network_id), array('network_id'=>$network_id,'name'=>$output['network_name']));
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
