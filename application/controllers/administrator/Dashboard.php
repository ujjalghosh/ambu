<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
		$this->load->model('administrator/dashboard_model');
		$this->load->helper('cookie');
		
		$data['page_title']='Dashboard';
		$data['meta_keywords']='This is admin dashboard ';
		$data['meta_description']='This is description';
		$this->seoData=$data;
	}
	 function index(){
		
		$data=$this->seoData;
		$this->load->view('administrator/dashboard', $data);
	}
	
	public function logout()
	{
		///$this->session->sess_destroy();
		$this->session->unset_userdata('login_cred');
		$this->session->unset_userdata('return_url_cred');
		delete_cookie("logged_in","","/");
		redirect('administrator/login');
		
	}

		 public function  profile_update($id,$method=''){
	 	
	 	$data=$this->seoData; 
		if(!empty($id)){
		$data['user_info']=$this->dashboard_model->profile_details($id);	
		
		}

	 	$this->load->view('administrator/pages/profile',$data);
	 }
}