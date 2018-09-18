<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
  * Email_template Controller
  */
 class Email_template extends CI_Controller {
     
	 private $seoData=array();
	 
     function __construct() {     	
		parent::__construct();		
		admin_login_check();
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('administrator/email_template_model');
		
		$data['page_title']=EMAIL_TEMPLATE_SEO_TITLE;
		$data['meta_keywords']=EMAIL_TEMPLATE_SEO_META_KEYWORDS;
		$data['meta_description']=EMAIL_TEMPLATE_SEO_META_DESCRIPTION;
		$this->seoData=$data;
     }
	 
	 /*======== For listing view ========*/
	 
	 function index($page=1, $sort_field='created_at', $order='DESC'){
		if($this->session->has_userdata('searchData')){
			$this->session->unset_userdata('searchData');
		}
			
		$base_url = base_url().'administrator/email_template/';
		$total_rows = $this->email_template_model->getTotalEmail_templateCount();
		$uri_segment = 4;
		$pconfig = setPaginationConfig($base_url,$total_rows,$uri_segment);
        $this->pagination->initialize($pconfig);
        
		$data=$this->seoData;
		      
		$offset = ($page - 1 ) * $pconfig['per_page'];
		$data['email_template_info'] 		= $this->email_template_model->get_AllEmail_template($pconfig["per_page"], $offset, $sort_field, $order);
		$data['pagination'] 	= $this->pagination->create_links();			
		if($order == "asc") $order = "desc"; else $order = "asc";		
		$data['tot_rows'] 		= $pconfig["total_rows"];
		$data['offset'] 		= $offset;	
		$data['per_page'] 		= $pconfig["per_page"];
		$data['no_of_page'] 	= ceil($data['tot_rows']/$data['per_page']);
		$data['sort_field'] 	= $sort_field;
		$data['order']			= $order;    
		$data['page']			= $page;
	 	$this->load->view('administrator/email_template/manage_email_template',$data);
	 }
	 
	  /*======== For listing search view ========*/
	 
	 function  search($page=1,$sort_field='created_at',$order='desc'){
	 	if($this->input->post('action') == 'search'){
			
			$title = trim($this->input->post('title'));
			
			
			
			$searchData = array(
                'title' => $title
                
           );
		   
		   $this->session->set_userdata('searchData', $searchData);    
		}elseif($this->session->has_userdata('searchData')){
			$searchData = array(
                'title' => $this->session->userdata['searchData']['title']
                
     
           );
		}else{
			redirect('administrator/email_template/');
		}
		
		$base_url = base_url().'administrator/email_template/';
		$total_rows = $this->email_template_model->getTotalEmail_templateCount($searchData);
		$uri_segment = 4;
		$pconfig = setPaginationConfig($base_url,$total_rows,$uri_segment);
        $this->pagination->initialize($pconfig);
        
		$data=$this->seoData;      
		$offset = ($page - 1 ) * $pconfig['per_page'];
		
		$data['email_template_info'] 		= $this->email_template_model->get_AllEmail_template($pconfig["per_page"], $offset, $sort_field, $order,$searchData);
		$data['pagination'] 	= $this->pagination->create_links();		
		if($order == "asc") $order = "desc"; else $order = "asc";		
		$data['tot_rows'] 		= $pconfig["total_rows"];
		$data['offset'] 		= $offset;	
		$data['per_page'] 		= $pconfig["per_page"];
		$data['no_of_page'] 	= ceil($data['tot_rows']/$data['per_page']);
		$data['sort_field'] 	= $sort_field;
		$data['order']			= $order;    
		$data['page']			= $page;
	 	$this->load->view('administrator/email_template/manage_email_template',$data);
	 }
	 
	 /*======== For add view ========*/
	 
	 function  add($id=''){
	 	$data=$this->seoData;
	 	$this->load->view('administrator/email_template/add_email_template',$data);
	 }
	 
	  /*======== For edit view ========*/
	 
	 function  edit($id){
	 	$data=$this->seoData;
	 
		if(!empty($id)){
		$data['email_template_info']=$this->email_template_model->email_template_details($id);
		 //print_r($data['email_template_info']);
		}
	 	$this->load->view('administrator/email_template/add_email_template',$data);
	 }
	 function  view_template_details(){
	 	$data=$this->seoData;	
	 	$id=$this->input->post('id',TRUE); 
		if(!empty($id)){

		$email_template_info=$this->email_template_model->email_template_details($id);
		echo $email_msg=setEmailTemplate($email_template_info->template_content);
		 return $email_msg;
		}
	 	
	 }
	 
	 /*======== For deletion ========*/
	 
	 function delete($id){
	 	
		$result=$this->email_template_model->delete($id);
		$return_data = array();
		if($result){
           	$this->session->set_flashdata('success_msg', EMAIL_TEMPLATE_DELETE_SUCCESSFULL);
		}else{
			$this->session->set_flashdata('error_msg', DELETE_ERROR_MESSAGE);
		}
		
		redirect('administrator/email_template/');
	 }
	 
	 /*======== For bulk deletion ========*/
	 
	 function bulk_delete(){
	 	
		$email_template_ids = $this->input->post('email_template_ids');
		$result=$this->email_template_model->bulk_delete($email_template_ids);
		
		if($result){
           	$this->session->set_flashdata('success_msg', EMAIL_TEMPLATE_BULK_DELETE_SUCCESSFULL);
			$return_data['success'] = 1;
		 }else{
			$return_data['error_message'] = message(DELETE_ERROR_MESSAGE ,2);
			$return_data['success'] = 0;
		}
		
		echo json_encode($return_data);
	 }
	 
	 /*======== For insert/update ========*/
	 
	 function insert_update_email_template(){
	 	
		$datestring = '%Y-%m-%d %H:%i:%s';
		$time = time();		
		$email_template_id = $this->input->post('email_template_id',TRUE);
		$email_template['title']=$this->input->post('title',TRUE);		
		$email_template['template_content']=$this->input->post('template_content');		
		$email_template['status']=$this->input->post('status',TRUE);	
		$this->form_validation->set_rules('title','Email template','required');
		$this->form_validation->set_rules('template_content','Template content','required');
		$this->form_validation->set_rules('status','Status','required');

	    $return_data = array();
		
		if($this->form_validation->run() == FALSE){
			
			$return_data['error_message'] = message(validation_errors('<span>', '</span>'),2);
			$return_data['success'] = 0; 
			
		}else{			

		if($email_template_id>0){
			
			$email_template['updated_at'] = mdate($datestring, $time);
			//print_r($email_template);

			$insert_id=$this->email_template_model->edit($email_template,$email_template_id);
			if($insert_id){
				   	$return_data['success_message'] = message( EMAIL_TEMPLATE_UPDATE_SUCCESSFULL,1);
					$return_data['success'] = 1;
					$return_data['action'] = "update";

				}else{
					$return_data['error_message'] = message(ADD_UPDATE_ERROR_MESSAGE,2);
					$return_data['success'] = 0; 
					$return_data['action'] = "update";
				}
		}else{
	
			$email_template['created_at'] = mdate($datestring, $time);
			$email_template['updated_at'] = mdate($datestring, $time);
			//print_r($email_template);
			$insert_id=$this->email_template_model->add($email_template);
			if($insert_id){
				   	$return_data['success_message'] = message( EMAIL_TEMPLATE_ADD_SUCCESSFULL,1);
					$return_data['success'] = 1;
					$return_data['action'] = "add";

				}else{
					$return_data['error_message'] = message(ADD_UPDATE_ERROR_MESSAGE,2);
					$return_data['success'] = 0; 
					$return_data['action'] = "add";
				}
		   }
		}
		echo json_encode($return_data);
	 }
	 
	  function change_status($id,$status){
		
		$result=$this->email_template_model->change_status($id,$status);
		if($result){
           	$this->session->set_flashdata('success_msg', 'Status has been updated.');
		}else{
			$this->session->set_flashdata('error_msg', 'Status updation encountered an error. ');
		}
		//return $result;
		redirect('administrator/email_template');
	}

	function change_status_bulk($status){
		
		$cat_ids = $this->input->post('cat_ids');

		$result=$this->email_template_model->bulk_change_status($cat_ids,$status);
		
		if($result){
           	$this->session->set_flashdata('success_msg', 'Status have been updated for selected categories.');
			$return_data['success'] = 1;
		 }else{
			$return_data['error_message'] = message('Something went wrong.',2);
			$return_data['success'] = 0;
		}
		
		echo json_encode($return_data);
	 }
	 
	 
	 
 }
 

?>