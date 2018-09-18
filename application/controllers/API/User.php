<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();		
		 
		$this->load->library('form_validation'); 
		$this->load->model('api/User_model');
		$this->load->helper('cookie');		

		}

	public function index()
	{


	}



public function signup()
	{

		$user_id=0;	
		$user['user_contact_no']=$this->input->post('user_contact_no',TRUE);
		$user_contact_no=$this->input->post('user_contact_no',TRUE);
		$user['device_token']= !empty($this->input->post('device_token')) ? $this->input->post('device_token') : '';
		$user['device_id']=$this->input->post('device_id',TRUE);
		$user['user_type']=$this->input->post('user_type',TRUE);
		 
		$this->form_validation->set_rules('user_contact_no', 'Phone No', 'required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('device_id', 'Device details', 'required');
		$this->form_validation->set_rules('user_type', 'User type', 'required'); 

		$return_data = array();

		if($this->form_validation->run() == FALSE){
		$return_data['api_msg'] = strip_tags(validation_errors());
		$return_data['status'] = FALSE; 
			
		}else{	
		$user['otp_pin'] = generatePIN(4);

      $sql      = "SELECT * FROM `{PRE}user_master` WHERE `user_contact_no` = '".$user_contact_no."'  AND  `user_type` = '".$user['user_type']."' ";
      $val      = $this->db->query($sql); 

      if($val->num_rows())	{  
       $row = $val->row(); 
       $user_id= $row->user_id;	
		$user['updated_on'] 	= get_current_date_time();
		$user['otp_time']   	= get_current_date_time(); 
		$user['otp_status'] 	= 'No';
		$user['user_status'] 	= 'No';
		$update_id=$this->User_model->update_user($user,$user_id);
		if($update_id){
		$return_data['user_id'] = $update_id->user_id;
		$return_data['otp_pin'] = $user['otp_pin'];	
		$return_data['api_msg'] = "Please verify your contact no with otp.";
		$return_data['status'] 	= true;

		}else{
		$return_data['api_msg'] = "Your registration was not complete Please try again.";
		$return_data['status'] 	= false; 
		}     	 

	}	else	{

		$user['created_on'] = get_current_date_time();
		$user['updated_on'] = get_current_date_time();
		$user['otp_time']   = get_current_date_time(); 
		$user['otp_status'] = 'No';
		$insert_id=$this->User_model->add_user($user);
		if($insert_id){		
		$return_data['user_id'] = $insert_id->user_id;
		$return_data['otp_pin'] = $user['otp_pin'];	
		$return_data['api_msg'] = "Please verify your contact no with otp.";
		$return_data['status'] = true;

		}else{
		$return_data['api_msg'] = 'Your registration was not complete Please try again'; 
		$return_data['status'] = false;  
				
		}

		}
	}
	    echo json_encode($return_data);
	}



public function verify_otp()
	{

		$user_id=0;	
		$user_id=$this->input->post('user_id',TRUE);  
		$otp_pin=$this->input->post('otp_pin',TRUE);  
		$this->form_validation->set_rules('user_id', 'user', 'required');
		$this->form_validation->set_rules('otp_pin', 'OTP', 'required'); 

		$return_data = array();

		if($this->form_validation->run() == FALSE){
		$return_data['api_msg'] = strip_tags(validation_errors());
		$return_data['status'] = FALSE; 
			
		}else{	
		

      $sql      = "SELECT * FROM `{PRE}user_master` WHERE `user_id` = '".$user_id."'  ";
      $val      = $this->db->query($sql); 

      if($val->num_rows())	{  
      $row = $val->row(); 
      $otp_time= $row->otp_time;
      $otp_pindb= $row->otp_pin;
 	$datetime1 = new DateTime($otp_time);
	$datetime2 = new DateTime(get_current_date_time());
	$interval = $datetime1->diff($datetime2);
	 $time_diff= $interval->format('%i');

		
		$user['updated_on'] 	= get_current_date_time();
		$user['otp_status'] 	= 'Yes';
		$user['user_status'] 	= 'Yes';

if($time_diff > '5') { 
	$return_data['api_msg'] = 'OTP is expired, please request for new one'; 
	$return_data['status'] = false; 
}else{

if($otp_pin==$otp_pindb){

		$update_id=$this->User_model->update_user($user,$user_id);
		if($update_id){

		$return_data['api_msg'] = "you have been successfully registered.";
		$return_data['status'] 	= true;

		}else{
		$return_data['api_msg'] = "Your registration was not complete Please try again.";
		$return_data['status'] 	= false; 
		}  
	}else{
		$return_data['api_msg'] = 'Invalid OTP'; 
		$return_data['status'] = false; 
	}

}
	}	else	{
		$return_data['api_msg'] = 'You are not registered with us,'; 
		$return_data['status'] = false;  
		}


	}
	    echo json_encode($return_data);
	}

	
 

}
