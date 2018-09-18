<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Homepage class
 */
class Login_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		
		$this->load->database();
	}
	
	function check_email($email){
		
		$details='';
		if($this->check_admin_email($email)){
			$details=$this->check_admin_email($email);
		}
		
		return $details;
	}
	
	// function user_details($email){
// 		
		// $this->db->select('*');
		// $this->db->from('admin_tbl');
		// $this->db->where('email',$email);
		// $query=$this->db->get();
// 		
		// return $query->row();
	// }
	
	function check_admin_email($email){
		
		$this->db->select('*');
		$this->db->from('admin_tbl');
		$this->db->where('email',$email);
		$query=$this->db->get();
		 if($query->num_rows()>0){
		 	return $query->row();
		 }else{
		 	return false;
		 }
	}
	
	function check_member_email($email){
		
		// $this->db->select('email');
		// $this->db->from('admin_tbl');
		// $this->db->where('email',$email);
		// $query=$this->db->get();
// 		
		// return $query->num_rows();
		return false;
	}
	
	function reset_pass($username,$pwd,$user_email,$otp){
		
		$data=array();
		$data['password']=$pwd;
		$encrypted;
		if($this->db->update('admin_tbl',$data,array('username' =>$username,'email'=>$user_email,'otp_pass'=>$otp))){
			return true;
		}else{
			return false;
		}
	}

function check_otp_pass($email,$otp_pass){
		
		$this->db->select('*');
		$this->db->from('admin_tbl');
		$this->db->where('email',$email);
		$this->db->where('otp_pass',$otp_pass);
		$query=$this->db->get();
		 if($query->num_rows()>0){
		 	return true;
		 }else{
		 	return false;
		 }
	}

function update_otp($user_id,$num){	
		 
         $data = array();                
         $data['otp_pass'] = $num;    
         
		if($this->db->update('admin_tbl', $data, array('id' =>$user_id))){
			return true;
		}else{
			return false;
		}
	}
function remove_otp($username,$user_email){
		
		$data = array();                
        $data['otp_pass'] = '';    
                
		if($this->db->update('admin_tbl', $data, array('username' =>$username,'email'=>$user_email))){
			return true;
		}else{
			return false;
		}
	}


}

?>