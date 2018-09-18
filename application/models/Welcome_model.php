<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User Model
 */
class Welcome_model extends CI_Model {
	
	function __construct() {
		
		parent::__construct();
	    $this->load->database();
	}
	
 


	function add_location($data){
		
		 $this->db->trans_start();       
	        $this->db->insert('location_tracking', $data);
			$insert_id = $this->db->insert_id();
	        $this->db->trans_complete();
	
	        if($this->db->trans_status() === FALSE) {
				return 0;
			} else {
				return $insert_id;
			}
	}

 	function getlocation($tracking_id ) {	
		
	    $this->db->select('t.*');
	  	$this->db->from('location_tracking as t');
	  	$this->db->where('tracking_id',$tracking_id);
		$query=$this->db->get();		
	  	return $query->result_array();
   }
	
	
}
