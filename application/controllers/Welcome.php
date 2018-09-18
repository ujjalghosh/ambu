<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();		
		 
		$this->load->library('form_validation'); 
		$this->load->model('welcome_model');
		  

		 
		 
	}

	public function index()
	{
		 
		//$this->load->view('landing/landing',$data);
	}

   


public function add_location()
	{

		 
		$data['device_id']=$this->input->post('device_id',TRUE);
		$data['device_latitude']=$this->input->post('device_latitude',TRUE);
		$data['device_longitude']=$this->input->post('device_longitude',TRUE);
		$this->form_validation->set_rules('device_id','device_id','required');
		$this->form_validation->set_rules('device_latitude','device_latitude','required');
		$this->form_validation->set_rules('device_longitude','device_longitude','required');

		$return_data = array();

		if($this->form_validation->run() == FALSE){
		$return_data['msg'] = validation_errors('<span>', '</span>');
		$return_data['api_msg'] = strip_tags(validation_errors());
		$return_data['status'] = FALSE; 
			
		}else{	
   		$insert_id=$this->welcome_model->add_location($data);
		if($insert_id){
 
			$return_data['msg'] = "your location is added successfully";
			$return_data['api_msg'] =$return_data['msg'];
			$return_data['status'] = true;

$row_data=$this->welcome_model->getlocation($insert_id);

			$return_data['device_id'] 		=	$row_data[0]['device_id'];
			$return_data['device_latitude'] 		=	$row_data[0]['device_latitude'];
			$return_data['device_longitude'] 		= 	$row_data[0]['device_longitude'];
			 

		}else{
			$return_data['msg'] = 'Your request was not complete Please try again';
			$return_data['api_msg'] =$return_data['msg'];
			$return_data['status'] = false; 
			 
				
		}

		}

	    echo json_encode($return_data);
	}



 


	function request_network(){
		$request_id=0;
		$this->form_validation->set_error_delimiters('<span class="errMsg">', '</span>');
		$data['request_user_mail']= $this->input->post('request_user_mail',TRUE);
		$data['request_location'] = $this->input->post('request_location',TRUE);
		$data['request_institute'] = $this->input->post('request_institute',TRUE);
		$data['request_year_of_passing'] = $this->input->post('request_year_of_passing',TRUE);
		$data['request_user_name'] = $this->input->post('request_user_name',TRUE);
		$data['request_user_institute'] = $this->input->post('request_user_institute',TRUE);
		$data['request_user_city'] = $this->input->post('request_user_city',TRUE);
		$data['request_user_country'] = $this->input->post('request_user_country',TRUE);
		$data['request_user_phone'] = $this->input->post('request_user_phone',TRUE);
		$data['user_id'] = $this->input->post('user_id')? $this->input->post('user_id') : 0;
		$this->form_validation->set_rules('request_user_mail', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('request_location', 'Institute location', 'required'); 
		$this->form_validation->set_rules('request_year_of_passing', 'Year', 'required');
		$this->form_validation->set_rules('request_institute','Institute Name','required|trim|xss_clean|callback_edit_unique[{PRE}request_network.request_institute.'.$request_id.']');
		$this->form_validation->set_rules('request_user_name', 'Your Name', 'required');
		$this->form_validation->set_rules('request_user_institute', 'Your Institute', 'required');
		$this->form_validation->set_rules('request_user_city', 'Your City', 'required');
		$this->form_validation->set_rules('request_user_country', 'Your Country', 'required'); 
		$this->form_validation->set_rules('request_user_phone', 'Mobile Number ', 'required|regex_match[/^[0-9]{10}$/]');

		if($this->form_validation->run() == FALSE){
        $errors = array();
        // Loop through $_POST and get the keys
        foreach ($this->input->post() as $key => $value)
        {
            // Add the error message for this field
            $errors[$key] = form_error($key);
        }
        $return_data['errors'] = array_filter($errors);

		$return_data['msg'] = validation_errors('<span>', '</span>');
		$return_data['api_msg'] = strip_tags(validation_errors());
		$return_data['status'] = FALSE; 
			
		}else{	
 
		$insert_id=$this->welcome_model->add_request_network($data);
		if($insert_id){
 
			$return_data['msg'] = "Thank you for a new network request with ".get_option('site_title').". We will verify and create a network for you.";
			$return_data['api_msg'] =$return_data['msg'];
			$return_data['status'] = true;
			 

		}else{
			$return_data['msg'] = 'Your request was not complete Please try again';
			$return_data['api_msg'] =$return_data['msg'];
			$return_data['status'] = false; 
			 
				
		}

		}
		  echo json_encode($return_data);
	}


function fetch_networks(){

$term = $this->input->get('term');

$networks=$this->welcome_model->getAllnetworks($term);

	}

	function view_network(){

	$name=$this->input->post('name',TRUE);
	$networkid=$this->input->post('networkid',TRUE);

	$aproval_link=base_url().'networks/network?key='.urlencode($this->encrypt->encode($name.'^'.$networkid));

		  echo $aproval_link;
	}

		 function logout()
	{
		///$this->session->sess_destroy();
		$this->session->unset_userdata('user_login_cred');
		redirect('/');
		
	}

}
