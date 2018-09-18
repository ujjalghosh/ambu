<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 */
class Registered_users_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	
	/*========= Total finance count ===========*/
	
	function getTotalUserCount($searchData=''){
		
		if(is_array($searchData)){
			
			if($searchData['first_name']!=NULL){
				$this->db->like('C.first_name', $searchData['first_name']);
				
			}
			if($searchData['last_name']!=NULL){
				$this->db->like('C.last_name', $searchData['last_name']);
				
			}
			if($searchData['user_group_id']!=NULL){
				$this->db->where('C.user_group_id', $searchData['user_group_id']);
				
			}
			if($searchData['status']!=NULL){
				$this->db->like('C.status', $searchData['status']);
				
			}
		}
		
		$this->db->select('C.*');
	  	$this->db->from('user_tbl as C');
		$status = array(0, 1);
		$this->db->where_in('C.status', $status);
		$query=$this->db->get();
		
	  	return $query->num_rows();
	}
	
	/*========= Retrive all the finance data ========*/
	
	function get_AllUser($limit=0, $start=0, $field, $order,$searchData=''){
		
		if(is_array($searchData)){
			
			if($searchData['first_name']!=NULL){
				$this->db->like('C.first_name', $searchData['first_name']);
				
			}
			if($searchData['last_name']!=NULL){
				$this->db->like('C.last_name', $searchData['last_name']);
				
			}
			if($searchData['user_group_id']!=NULL){
				$this->db->where('C.user_group_id', $searchData['user_group_id']);
				
			}
			if($searchData['user_category_ids']!=NULL && $searchData['user_ids']!=NULL){

				$this->db->where_in('C.id',  $searchData['user_ids']);
				
			}
			if($searchData['status']!=NULL){
				$this->db->where('C.status', $searchData['status']);
				
			}else{
				$status = array(0, 1);
				$this->db->where_in('C.status', $status);
			}
		}else{
			$status = array(0, 1);
				$this->db->where_in('C.status', $status);

		}
		
		$this->db->limit($limit, $start);	
		$this->db->order_by($field, $order);
		$this->db->select('C.*,G.title as usergroup');
	  	$this->db->from('user_tbl as C');
	  	$this->db->join('user_group_tbl as G','G.id=C.user_group_id','left');	
		
		$query=$this->db->get();		
	  	return $query->result();
	}
		function getTotalNewUserCount($searchData=''){
		
		if(is_array($searchData)){
			
			if($searchData['first_name']!=NULL){
				$this->db->like('C.first_name', $searchData['first_name']);
				
			}
			if($searchData['last_name']!=NULL){
				$this->db->like('C.last_name', $searchData['last_name']);
				
			}
			
			if($searchData['status']!=NULL){
				$this->db->like('C.status', $searchData['status']);
				
			}
		}
		
		$this->db->select('C.*');
	  	$this->db->from('user_tbl as C');
		$status = array(3);
		$this->db->where_in('C.status', $status);
		$query=$this->db->get();
		
	  	return $query->num_rows();
	}

	function get_AllNewUser($limit=0, $start=0, $field, $order,$searchData=''){
		
		if(is_array($searchData)){
			
			if($searchData['first_name']!=NULL){
				$this->db->like('C.first_name', $searchData['first_name']);
				
			}
			if($searchData['last_name']!=NULL){
				$this->db->like('C.last_name', $searchData['last_name']);
				
			}			
			if($searchData['user_category_ids']!=NULL && $searchData['user_ids']!=NULL){

				$this->db->where_in('C.id',  $searchData['user_ids']);
				
			}
			
		}
		
		$this->db->limit($limit, $start);	
		$this->db->order_by($field, $order);
		$this->db->select('C.*');
	  	$this->db->from('user_tbl as C');	
		$status = array(3);
		$this->db->where_in('C.status', $status);
		$query=$this->db->get();		
	  	return $query->result();
	}

	

	function User_details($id){

		$this->db->select('C.*,G.title as usergroup');
	  	$this->db->from('user_tbl as C');
	  	$this->db->join('user_group_tbl as G','G.id=C.user_group_id','left');			
		$status = array(0, 1);
		$this->db->where_in('C.id', $id);
		$query=$this->db->get();
		return $query->row();
	  	//return $query->result();

	}
	function getAllParentCategories() {	
		
	    $this->db->select('t.*');
	  	$this->db->from('user_tbl as t');		
		$query=$this->db->get();		
	  	return $query->result();
   }
	
	/*========== insert to database =======*/
	
	function add($data){
		
		 $this->db->trans_start();       
	        $this->db->insert('user_tbl', $data);
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
		if($this->db->update('user_tbl', $data, array('id' =>$id))) {
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
		   if($this->db->delete('user_tbl',array('id'=>$id))) {
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
			$this->db->delete('user_tbl',array('id'=>$id));
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
		if($this->db->update('user_tbl',$data,array('id'=>$id))) {
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
			$this->db->update('user_tbl', $data, array('id' =>$id));
		}
		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}





	function add_user_category($data){
		
		 $this->db->trans_start();       
	        $this->db->insert('user_category_list_tbl', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();
	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}
   function delete_user_category($user_id){
		$data = array();
		$data['status'] = 2;
		$data['archived_at'] = date('Y-m-d H:i:s');
		   if($this->db->delete('user_category_list_tbl',array('user_id'=>$user_id))) {
				return true;
			} else{
			  return false;
		   }
	}
	function getAllsubgroups($user_id) {	
		
	    $this->db->select('s.*,G.title as category');
	  	$this->db->from('user_category_list_tbl as s');
	  		$this->db->join('user_category_tbl as G','G.id=s.category_id','left');	
	  	$this->db->where('s.user_id', $user_id);		
		$query=$this->db->get();		
	  	return $query->result();
   }

   function getAllUseridsFromSubgroups($subgroup_ids) {	
		
	    $this->db->select('s.user_id');
	  	$this->db->from('user_category_list_tbl as s');
	  	$this->db->where_in('s.category_id', $subgroup_ids);
	  	 $this->db->group_by('user_id'); 		
		$query=$this->db->get();		
	  	return $query->result();
   }

   function getAllUseridsFromUsergroups($usergroup_ids) {	
		
	    $this->db->select('u.id,u.first_name,u.last_name,u.email');
	  	$this->db->from('user_tbl as u');
	  	$this->db->where_in('u.user_group_id', $usergroup_ids);	  		
		$query=$this->db->get();		
	  	return $query->result();
   }



	
	function check_user_email($email){
		
		$this->db->select('*');
		$this->db->from('user_tbl');
		$this->db->where('email',$email);
		$query=$this->db->get();
		 if($query->num_rows()>0){
		 	return $query->row();
		 }else{
		 	return false;
		 }
	}
	
function reset_pass($username,$pwd,$user_email,$email_verified_pin){
		
		$data=array();
		$data['password']=$pwd;
		$encrypted;
		if($this->db->update('user_tbl',$data,array('username' =>$username,'email'=>$user_email,'email_verified_pin'=>$email_verified_pin))){
			return true;
		}else{
			return false;
		}
	}

function check_otp_pass($email,$email_verified_pin){
		
		$this->db->select('*');
		$this->db->from('user_tbl');
		$this->db->where('email',$email);
		$this->db->where('email_verified_pin',$email_verified_pin);
		$query=$this->db->get();
		 if($query->num_rows()>0){
		 	return true;
		 }else{
		 	return false;
		 }
	}

function update_otp($user_id,$num){	
		 
         $data = array();                
         $data['email_verified_pin'] = $num;    
         
		if($this->db->update('user_tbl', $data, array('id' =>$user_id))){
			return true;
		}else{
			return false;
		}
	}
function remove_otp($username,$user_email){
		
		$data = array();                
        $data['email_verified_pin'] = '';    
                
		if($this->db->update('user_tbl', $data, array('username' =>$username,'email'=>$user_email))){
			return true;
		}else{
			return false;
		}
	}
function update_password($data){
		$user_arr=$this->session->userdata('frontend_login_cred');
        $user_id=$user_arr['id'] ;
		
		if(trim($data['password'])!=NULL){
        	$enc_pass = $this->encrypt->hash(($this->config->item('encryption_key').$data['password']));
			$data_user['password'] = $enc_pass;
		} 

		if($this->db->update('user_tbl', $data_user, array('id' =>$user_id))){
		    return true;
		} else {
	     	return false;
	    }
	}


	
	
	
}
