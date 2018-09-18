<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Email_template Model
 */
class Email_template_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	
	/*========= Total finance count ===========*/
	
	function getTotalEmail_templateCount($searchData=''){
		
		if(is_array($searchData)){
			
			if($searchData['title']!=NULL){
				$this->db->like('C.title', $searchData['title']);
				
			}
		}
		
		$this->db->select('C.*');
	  	$this->db->from('email_templates as C');
		$status = array(0, 1);
		$this->db->where_in('C.status', $status);
		$query=$this->db->get();
		
	  	return $query->num_rows();
	}
	
	/*========= Retrive all the finance data ========*/
	
	function get_AllEmail_template($limit=0, $start=0, $field, $order,$searchData=''){
		
		if(is_array($searchData)){
			
			
			if($searchData['title']!=NULL){
				$this->db->like('C.title', $searchData['title']);
				
			}
		}
		
		$this->db->limit($limit, $start);	
		$this->db->order_by($field, $order);
		$this->db->select('C.*');
	  	$this->db->from('email_templates as C');	
		$status = array(0, 1);
		$this->db->where_in('C.status', $status);
		$query=$this->db->get();		
	  	return $query->result();
	}

	function Email_template_details($id){

		$this->db->select('C.*');
	  	$this->db->from('email_templates as C');		
		$status = array(0, 1);
		$this->db->where_in('C.id', $id);
		$query=$this->db->get();
		return $query->row();
	  	//return $query->result();

	}
	
	/*========== insert to database =======*/
	
	function add($data){
		
		 $this->db->trans_start();       
	        $this->db->insert('email_templates', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();
	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}



	
	/*========== edit database data =======*/
	
	function edit($data,$id){	
		if($this->db->update('email_templates', $data, array('id' =>$id))) {
			return true;
		} else {
			return false;
		}
	}
	
	/*========== delete database data =======*/
	
	function delete($id){
		$data = array();
		$data['status'] = 2;
		$data['archived_at'] = date('Y-m-d H:i:s');
		   if($this->db->delete('email_templates',array('id'=>$id))) {
				return true;
			} else{
			  return false;
		   }
	}
	
	/*========== bulk delete database data =======*/
	
	function bulk_delete($ids){
	   $this->db->trans_start();
		$data = array();

		foreach($ids as $id){
			$data['status'] = 2;
			$data['archived_at'] = date('Y-m-d H:i:s');
			$this->db->delete('email_templates',array('id'=>$id));
		}
	  $this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}
function change_status($id,$status){
		
		$data = array();
		$data['status'] = $status;
		$data['updated_at'] = date('Y-m-d H:i:s');
		if($this->db->update('email_templates',$data,array('id'=>$id))) {
			return true;
		} else {
			return false;
		}
	}

	 function bulk_change_status($ids,$status){
		$this->db->trans_start();
		foreach($ids as $id){
 			$data['status'] = $status;
			$data['updated_at'] = date('Y-m-d H:i:s');
			$this->db->update('email_templates', $data, array('id' =>$id));
		}
		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}
	
	
	
}
