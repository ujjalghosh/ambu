<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();		
		$this->load->model('administrator/login_model');
		$this->load->model('administrator/email_template_model');
		$this->load->helper('cookie');
		 $login_cred=$this->session->userdata('login_cred');
   		 if($login_cred){
   		 	redirect(base_url().'administrator/dashboard');
   		 }
	}
	public function index(){
		
		if($this->input->cookie('login_user')){
			$cookie_username = $this->input->cookie('login_user');
		}else{
			$cookie_username = '';
		}
		if($this->input->cookie('login_pass')){
			$cookie_password = $this->input->cookie('login_pass');
		}else{
			$cookie_password = '';
		}
		
		if($this->input->cookie('logged_in')){
			$cookie_logged_in = $this->input->cookie('logged_in');
		}else{
			$cookie_logged_in = '';
		}
		
		if($this->input->cookie('remember_me')){
			$cookie_rem_me = $this->input->cookie('remember_me');
		}else{
			$cookie_rem_me = '';
		}	
		
		
		
		if(!empty($cookie_username) && !empty($cookie_password) && !empty($cookie_logged_in)){
			
			if($this->validate_administrator_credentials($cookie_username,$cookie_password,$cookie_rem_me)){	
			}else{
			 return false;
			}
		}elseif($this->session->userdata('login_cred')){
			redirect('administrator/dashboard');
		}else{
		  
		  $this->load->view('administrator/login');
		}		
	}
	
	public function validate_credentials(){
		
		$user     = $this->input->post('username');
		$password = $this->input->post('password');
		$rem_me = $this->input->post('rem_me');

			if($this->validate_administrator_credentials($user,$password,$rem_me)){	
			$return_url=$this->session->userdata('return_url_cred');
			if($return_url==''){
				$return_url='administrator/dashboard';
			}
			//print_r($return_url);
 			redirect($return_url);
			}else{

				$err['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Access denied. Invalid username/password.</div>';
				 $this->session->set_flashdata('login_error',$err['error']);
				 redirect(base_url().'administrator');
				
			}
		
	}

	    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }

	function validate_administrator_credentials($user,$password,$rem_me=0){
 
			$enc_pass =$this->__encrip_password($password);
			$sql      = "SELECT * FROM `{PRE}administrator` WHERE `user_name` = ? AND `pass_word` = ? AND status = 'Active'";
			$val      = $this->db->query($sql,array($user ,$enc_pass));
			
			if($val->num_rows()){
				    //$cookie_details = array('name' => 'remember_me_details', 'value'  => array('username'=>$user,'pwd'=>$enc_pass), 'expire' => '604800', 'path' => '/'	);
					$cookie_rem= array('name' => 'remember_me', 'value'  => '1', 'expire' => '604800', 'path' => '/');
					$cookie_user = array('name' => 'login_user', 'value'  => $user, 'expire' => '604800', 'path' => '/');
					$cookie_pass = array('name' => 'login_pass', 'value'  => $password, 'expire' => '604800', 'path' => '/');
					$cookie_logged_in = array('name' => 'logged_in', 'value'  => 'yes', 'expire' => '604800', 'path' => '/');
					if($rem_me==1){
						$this->input->set_cookie($cookie_rem);
						$this->input->set_cookie($cookie_user);	
						$this->input->set_cookie($cookie_pass);	
						$this->input->set_cookie($cookie_logged_in);
					}else{
						delete_cookie("remember_me","","/");
						delete_cookie("login_user","","/");
						delete_cookie("login_pass","","/");
						delete_cookie("logged_in","","/");
					}
									
				foreach($val->result_array() as $recs => $res){
					$this->session->set_userdata('login_cred',array(
							'id'            => $res['id'],
							'username'      => $res['user_name'],
							'email'         => $res['email_address'],
							'loggedIn'		=> true
						)
					);
				}	
			return true;
			}else{
				return false;				
			}
		//}
	}

public function logout2()
	{
		 
		  $this->load->view('administrator/login');
		
	}

  
	public function logout()
	{
		///$this->session->sess_destroy();
		$this->session->unset_userdata('login_cred');
		$this->session->unset_userdata('return_url_cred');
		redirect('administrator/login');
		
	}
	function forgotpassword(){
		  
		  $c_id=$this->input->get('key');
		  $encrypted=urldecode(urlencode($c_id));
		  $decrypted=$this->encrypt->decode($encrypted);
		  $data['dyc_email']=$decrypted;
		  
		 $this->load->view('administrator/login',$data);
	}

	function logout1()
	{
		//$this->session->unset_userdata('login_cred');
		//redirect('administrator/login');
		
	}

	function forgotpass(){		
		
		 $user_email=$this->input->post('user_email',TRUE);
		  
		 $user_details=$this->login_model->check_email($user_email);
		if(!empty($user_details->email)){
			   ///$user_details=$this->login_model->user_details($user_email);
			  /// $user_email='mailaniruddha@webgrity.com';
			   $user_id=$user_details->id;
			   $user=$user_details->first_name.' '.$user_details->last_name;
			   $username=$user_details->username;
			   $num = rand(100000,999999); 
			   $result=$this->login_model->update_otp($user_id,$num);              
               if($result){

			   $reset_link=base_url().'administrator/login/forgotpassword/?key='.urlencode($this->encrypt->encode($user_email.'^'.$username.'^'.$num));
			   
			   $email_msg  = $this->email_template_model->Email_template_details(1); 
               $to=trim($user_email);
               $subject =$email_msg->title; 
			   $message=str_replace('###USER###',$user,(str_replace('###USERNAME###',$username,(str_replace('###RESETLINK###',$reset_link,$email_msg->template_content)))));
               SendEmailTo($to,$subject,$message);       
 
			  	$return_data['success_message'] = '<span style="color:#018b0e;float: left; margin-top: 10px;">An email has been sent to you. Please check your email mailbox.</span>';
				$return_data['success'] = 1;
			}
		}else{
			  
			  	$return_data['error_message'] ='<span style="color:#ff0000;float:left;margin-top: 10px;">This email id is not registered.</span>';
				$return_data['success'] = 0;
		}
		echo json_encode($return_data);
	}

    function resetpass(){
    	
		  $pwd= $this->input->post('re_password');
		  $user_name= $this->input->post('user_name');
		  $user_email= $this->input->post('user_email');
		  $otp_pass= $this->input->post('otp_pass');
		   $check_otp=$this->login_model->check_otp_pass($user_email,$otp_pass);
		 if($check_otp){
		///$con_pwd= $this->input->post('re_con_password');		
		   ///$salt     = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
		   $salt=$this->config->item('encryption_key');
		   $enc_pass = $this->encrypt->hash($salt.$pwd);
		   
		$return_data = array();			
		$pw_updated  = $this->login_model->reset_pass($user_name,$enc_pass,$user_email,$otp_pass);
    	
		if($pw_updated){

			$this->login_model->remove_otp($user_name,$user_email);
			$return_data['success_message'] = '<span style="color:#018b0e;font-size:14px;">Password has been updated successfully.</span>';
			$return_data['success'] = 1;
		}else{
			$return_data['error_message'] ='<span style="color:#ff0000;font-size:14px">Oops! Something erroneous.</span>';
			$return_data['success'] = 0;
		}
	}else{
			$return_data['error_message'] ='<span style="color:#ff0000;font-size:14px">Oops! The Reset password link hasbeen Expire. Please try again.</span>';
			$return_data['success'] = 0;

	}
		
		echo json_encode($return_data);
    }
 }
?>