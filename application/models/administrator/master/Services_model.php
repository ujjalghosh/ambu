<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 */
class Services_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	



        function getAllusers() { 
        
        $this->db->select('user_id,first_name,middle_name,last_name,user_email');  
        $this->db->where(array('userstatus'=>'Active','oauth_provider'=>'Register'));        
        $query = $this->db->get('user_master'); 
        return $query->result_array();  

   }

   function fetch_network_user($where)  
      {  
           $this->db->where($where);  
           $query=$this->db->get('user_network');  
           return $query->result_array();  
      }

  function fetch_network_user_email( $network_id)  {

      $this->db->select('UM.*,UN.network_user');
  $this->db->from('user_network  UN');
  $this->db->join('user_master UM','UM.user_id=UN.user_id','left');
  $where=array('UN.isAdmin'=>'1','UN.network_id'=>$network_id,'UN.approval_status'=>1,'UN.isActive'=>1); 
    $this->db->where($where);  
           $query=$this->db->get();  
           if($query->num_rows() > 0){
           return $query->result_array();
         }else{
          return false;
         }
  }
  
  function edit_network_user($data,$id){ 
    if($this->db->update('user_network', $data, $id)) {
      return true;
    } else {
      return false;
    }
  }

  function add_service($data){
    
     $this->db->trans_start();       
          $this->db->insert('services', $data);
      //$insert_id = $this->db->insert_id();
          $this->db->trans_complete();
  
          if($this->db->trans_status() === FALSE) {
        return 0;
      } else {
        return 1;
      }
  }
  
  function data_single_service($service_id){

          $this->db->where("service_id", $service_id);  
           $query=$this->db->get('services');  
           return $query->result();  
  }
	
function edit_service($service_id, $data){
//print_r($data); echo $service_id; die();
  
    if($this->db->update('services', $data, array('service_id'=>$service_id))) {
      return true;
    } else {
      return false;
    }

}

}
