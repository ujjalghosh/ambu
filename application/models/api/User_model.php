<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* User Model
*/
class User_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	$this->load->database();
	}



		function add_user($data){

		$this->db->trans_start();
		$this->db->insert('user_master', $data);
		$insert_id = $this->db->insert_id();
		$this->db->trans_complete();

		if($this->db->trans_status() === FALSE) {
		return 0;
		} else {
		return $this->fetch_user_details($insert_id);
		}
		}

	function update_user($data,$user_id){
		if($this->db->update('user_master', $data, array('user_id' =>$user_id))) {
		return	$this->fetch_user_details($user_id);
		} else {
			return false;
		}
	}


	function fetch_user_details($user_id) {		
		$this->db->select('*');
		$this->db->where(array('user_id'=> $user_id));
		$query = $this->db->get('user_master');
		if($query->num_rows() > 0){
		return $query->row();
		}else{
		return false;
		}
	}




	function add_post_comment($data){
		
		$this->db->trans_start();
	$this->db->insert('posts_comments', $data);
			$insert_id = $this->db->insert_id();
	$this->db->trans_complete();
	if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
	$this->db->where(array('post_master_id'=>$data['post_master_id']));
$query=$this->db->get('network_post_master'); 
 
	$notable_array= $query->result_array();	 
$this->db->update('network_post_master', array('total_comment'=>$notable_array[0]['total_comment'] + 1), array('post_master_id' =>$data['post_master_id'])); 


				return $insert_id;
			}
	}


	

	function fetch_details($user_id) {		
		$this->db->select('*');
		$this->db->where(array('user_id'=> $user_id));
		$query = $this->db->get('user_master');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}

	function	connect_network($user_id,$viewer_id){
$query =$this->db->query("SELECT  COUNT(*) as total FROM al_user_network e INNER JOIN al_user_network m ON m.`network_id` = e.`network_id` WHERE e.`user_id`='".$user_id."' AND m.`user_id`='".$viewer_id."'");


	 $events_array= $query->result_array();	
return $events_array[0]['total'];

	}

	function user_experience ($user_id) {		
		$this->db->select('*');
		$this->db->where(array('user_id'=> $user_id));
		$query = $this->db->get('work_details');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}

	function user_education  ($user_id) {		
		$this->db->select('*');
		$this->db->where(array('user_id'=> $user_id));
		$query = $this->db->get('education_details');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}

	function user_voluntary_experience  ($user_id) {		
		$this->db->select('*');
		$this->db->where(array('user_id'=> $user_id));
		$query = $this->db->get('voluntary_experience');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}
	
	function edit_education($data,$institute_id){	
		if($this->db->update('education_details', $data, array('institute_id' =>$institute_id))) {
			return true;
		} else {
			return false;
		}
	}

	function add_education($data){
		
		 $this->db->trans_start();       
	        $this->db->insert('education_details', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();
	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}

	
		function fetch_education_details  ($institute_id) {		
		$this->db->select('*');
		$this->db->where(array('institute_id'=> $institute_id));
		$query = $this->db->get('education_details');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}

	//**** Volunteer

	function edit_volunteer_experience($data,$voluntary_experience_id){	
		if($this->db->update('voluntary_experience', $data, array('voluntary_experience_id' =>$voluntary_experience_id))) {
			return true;
		} else {
			return false;
		}
	}

	function add_volunteer_experience($data){
		 $this->db->trans_start();       
	        $this->db->insert('voluntary_experience', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}

	
		function fetch_volunteer_experience_details  ($voluntary_experience_id) {		
		$this->db->select('*');
		$this->db->where(array('voluntary_experience_id'=> $voluntary_experience_id));
		$query = $this->db->get('voluntary_experience');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}
		
			function edit_user($data,$user_id){	
		if($this->db->update('user_master', $data, array('user_id' =>$user_id))) {
			return true;
		} else {
			return false;
		}
	}

	//*************** experience

		function edit_experience($data,$work_id){	
		if($this->db->update('work_details', $data, array('work_id' =>$work_id))) {
			return true;
		} else {
			return false;
		}
	}

	function add_experience($data){
		 $this->db->trans_start();       
	        $this->db->insert('work_details', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}

	
		function fetch_experience_details  ($work_id) {		
		$this->db->select('*');
		$this->db->where(array('work_id'=> $work_id));
		$query = $this->db->get('work_details');
		if($query->num_rows() > 0){
		return $query->result_array();
		}else{
		return false;
		}
	}


	function network_check($organization_name){

	    $this->db->select('*'); 
	  	$this->db->where(array('network_status'=> 'Accepted','network_name'=> $organization_name));
	    $query = $this->db->get('new_network'); 
	    if($query->num_rows() > 0){
		return $query->result_array();
	    }else{
	    	return false;
	    }

	}

	function network_check_join($user_id,$network_id){
		$this->db->select('*'); 
	  	$this->db->where(array('user_id'=> $user_id,'network_id'=> $network_id,'approval_status'=>1,'isActive'=>1));
	    $query = $this->db->get('user_network'); 
	    if($query->num_rows() > 0){
		return true;
	    }else{
	    return false;
	    }
	}
}