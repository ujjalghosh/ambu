<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networks_available extends CI_Controller{
	private $seoData=array();
	function __construct()	{
		parent::__construct();
		admin_login_check();
		$this->load->model('administrator/network/Available_network_model');
		$this->load->helper('cookie');
		
		$data['page_title']='Available Networks';
		$data['meta_keywords']='This is admin dashboard ';
		$data['meta_description']='This is description';
		$this->seoData=$data;
	}
	 function index(){
		
		$data=$this->seoData;
		$this->load->view('administrator/networks/networks_available', $data);
	}
	

    public function getTable()
    {
        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
$aColumns = array('new_network_id', 'network_name', 'institution_name','city','email','network_type','network_status');
        
        // DB table to use
        $sTable = 'new_network';
        //
    
        $iDisplayStart = $this->input->get_post('iDisplayStart', true);
        $iDisplayLength = $this->input->get_post('iDisplayLength', true);
        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
    
        // Paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }
        
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
        }
        
        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        $rResult = $this->db->get($sTable);
    
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;
    
        // Total data set length
        $iTotal = $this->db->count_all($sTable);
    
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
            }
    
            $output['aaData'][] = $row;
        }
    
        echo json_encode($output);
    }


        function get_network_user() { 
        
           $data = $this->Available_network_model->getAllusers();  
           if (count($data)>0) { ?>
<option value=""> Select user for Admin </option>
<optgroup label="User Name">
    <?php  foreach($data as $row)    {   ?>
    <option value="<?php echo $row['user_id']; ?>"><?php echo $row['first_name']. $row['first_name'] .$row['last_name'] ; ?></option> 
    <?php  }  ?>
</optgroup> 
<optgroup label="User Email">
     <?php  foreach($data as $row)    {   ?>
 <option value="<?php echo $row['user_id']; ?>"><?php echo  $row['user_email'] ; ?></option> 
  <?php  }  ?>
  </optgroup> 
         <?php  //echo json_encode($output);  
}
   }


function fetch_admins_network(){
$network_id=$this->input->post('network_id');
   $where=array('isAdmin'=>'1','network_id'=>$network_id); 
   $chk_data= $this->Available_network_model->fetch_network_user($where);  $k=0;  ?>

        <?php
        if(count($chk_data)>0){ $k=0;
          foreach($chk_data as $rowdata)    { $k=$k+1;  ?>
         
<tr id="addr<?php echo $k; ?>">
<td><?php echo $k; ?></td> <td><select name='user_id<?php echo $k; ?>' id='user_id<?php echo $k; ?>'  class='form-control select2' style='width: 100%;'  data-validation-engine='validate[required]'>
<?php
           $data = $this->Available_network_model->getAllusers();  
           if (count($data)>0) { ?>
<option value=""> Select user for Admin </option>
<optgroup label="User Name">
    <?php  foreach($data as $row)    {   ?>
    <option value="<?php echo $row['user_id']; ?>" <?php echo $row['user_id']==$rowdata['user_id'] ? 'selected' : ''; ?>><?php echo $row['first_name']. $row['first_name'] .$row['last_name'] ; ?></option> 
    <?php  }  ?>
</optgroup> 
<optgroup label="User Email">
     <?php  foreach($data as $row)    {   ?>
 <option value="<?php echo $row['user_id']; ?>"><?php echo  $row['user_email'] ; ?></option> 
  <?php  }  ?>
  </optgroup> 
         <?php  
}
?>
  </select></td> <td><a href='javascript:void(0);'  class='remove_prefix'><span class='glyphicon glyphicon-remove'></span></a></td>
 </tr>
 <?php
}
} ?>
  <tr id='addr<?php echo $k+1; ?>'></tr>
<?php }



function fetch_admins_mail_network(){
$network_id=$this->input->post('network_id');
   
   $chk_data= $this->Available_network_model->fetch_network_user_email($network_id);  $k=0;  ?>

        <?php
        if(count($chk_data)>0){ $k=0;
          foreach($chk_data as $rowdata)    { $k=$k+1;  ?>

<tr>
    <td><?= $k; ?></td>
    <td><?php echo $rowdata['first_name']. $rowdata['first_name'] .$rowdata['last_name'] ; ?></td>
     <td><a href="mailto:<?= $rowdata['user_email']; ?>" target="_top"> <?= $rowdata['user_email']; ?></a></td>
</tr>

 <?php } }   }

        function admin_network_action(){  
          $item= $this->input->post('item'); 
             $network_id=$this->input->post('network_id');
$add=0;
/*for ($un=0; $un <$item ; $un++) { 
  echo  $user_id=$this->input->post('user_id'.$un, true);
}*/
$this->db->update('user_network', array('isAdmin'=>'0'), array('network_id'=>$network_id));
for ($un=0; $un <=$item ; $un++) { 
   $user_id=$this->input->post('user_id'.$un, true);


    if (!empty($user_id)) {
     $updated_data = array( 'user_id' => $user_id,'network_id' =>$network_id, 'isActive' =>'1','isAdmin'=>'1','approval_status'=>'1' );
$where=array('user_id'=>$user_id,'network_id'=>$network_id);



        $chk_data= $this->Available_network_model->fetch_network_user($where);       
        if (count($chk_data)>0) {
         $insert_id=    $this->Available_network_model->edit_network_user($updated_data,array('network_id'=>$network_id,'user_id'=>$user_id));
         if($insert_id){ $add=$add+1; } 
        }
        else{
           $insert_id=  $this->Available_network_model->add_network_user($updated_data);
            if($insert_id){ $add=$add+1; } 
        }

    }
}
 
        $return_data = array(); 
 
                if($add>0){ 

                $return_data["status"]=TRUE;
                 $return_data["msg"]="Admin is updated for Network.";
                }else{
                $return_data["status"]=FALSE;
                 $return_data["msg"]="Sorry, Nothing is updated";
                }
             
            
           echo json_encode($return_data);
      } 

}