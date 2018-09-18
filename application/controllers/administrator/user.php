<?php

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('encrypt');
		$this->load->helper('cookie');
		 $login_cred=$this->session->userdata('login_cred');
   		 if($login_cred){
   		 	redirect(base_url().'administrator/dashboard');
   		 }
	}
    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
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
			
			if($this->validate_admin_credentials($cookie_username,$cookie_password,$cookie_rem_me)){	
			}else{
			 return false;
			}
		}elseif($this->session->userdata('login_cred')){
			redirect('administrator/dashboard');
		}else{
		  
		  $this->load->view('administrator/login');
		}	
	}

    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
/*	function validate_credentials()
	{	

		$this->load->model('Users_model');

		 $user_name = $this->input->post('user_name');
	 	$password = $this->__encrip_password($this->input->post('password'));
	
		$is_valid = $this->Users_model->validate($user_name, $password);
		
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('administrator/dashboard');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('administrator/login', $data);	
		}
	}*/	

	public function validate_credentials(){
		
		$user     = $this->input->post('user_name');
		$password = $this->input->post('password');
		$rem_me = $this->input->post('rem_me');

			if($this->validate_admin_credentials($user,$password,$rem_me)){	
			$return_url=$this->session->userdata('return_url_cred');
			if($return_url==''){
				$return_url='administrator/dashboard';
			}
			//print_r($return_url);
 			redirect($return_url);
			}else{
				$err['error'] = '<div class="mssg error">Access denied. Invalid username/password.</div>';
				 $this->session->set_flashdata('login_error',$err['error']);
				 redirect(base_url().'administrator');
				
			}
		
	}



function validate_admin_credentials($user,$password,$rem_me=0){
		
			//$salt     = '5&JDDlwz%Rwh!t2Yg-Igae@QxPzFTSId';
			$salt=$this->config->item('encryption_key');
			$enc_pass = $this->encrypt->hash($salt.$password);
			$sql      = "SELECT * FROM `{PRE}admin_tbl` WHERE `username` = ? AND `password` = ? AND status = '1'";
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
				// $err['error'] = 'Access Denied. Invalid Username/Password';
				// $this->load->view('admin/login', $err);
			}
		//}
	}





    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
		function dashboard()
	{
		$this->load->view('administrator/dashboard');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect('administrator');
	}




	 public function  update($id,$method=''){
	 	
	 	$data=$this->seoData;
	 	$data['user_groups']=$this->user_group_model->getAllParentCategories();
	 	$data['user_categories']=$this->user_category_model->getAllParentCategories();
	 
		if(!empty($id)){
		$category_ids=array();
		$user_category_ids=$this->user_model->getAllsubgroups($id);
		$data['user_info']=$this->user_model->user_details($id);
		$data['method']=$method;
		 foreach ($user_category_ids as $user_category_id) {
		 	$category_ids[]=$user_category_id->category_id;
		 }
		 $data['category_ids']=$category_ids;

		}
	 	$this->load->view('admin/user/add_user',$data);
	 }


}