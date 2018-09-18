<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');
$ci =& get_instance();
$ci->load->database();

function message($var = "", $mode = ""){
	switch($mode){
		case 1:
			$var = '<div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    '.$var.'
  </div>';  //Success
		break;
		case 2:
			$var = '<div class="alert alert-danger alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    '.$var.'
  </div>'; //Error
		break;
		case 3:
			$var = '<div class="alert alert-info alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    '.$var.'
  </div>'; //infoMsg
		break;
		case 4:
			$var = '  <div class="alert alert-warning alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$var.'
  </div>'; //warningMsg
		break;		
		default:
			$var = '<div class="alert  alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    '.$var.'
  </div>'; //Message
		break;
	}
	return $var;
}

	function prefix_number($number){
			 return str_pad($number, 2, "0", STR_PAD_LEFT);
	}
	
	function admin_login_check(){ 
		$ci =& get_instance();
		$login_cred=$ci->session->userdata('login_cred');
		$url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$ci->session->set_userdata('return_url_cred', $url );
			if(!$login_cred['loggedIn']){
				redirect(base_url().'administrator');
			}
	}
	function get_option($option_name){
		$ci =& get_instance();
		$ci->db->select('option_value');
		$ci->db->where('option_name', $option_name);
		$query=$ci->db->get('options');
		return $query->row()->option_value;

	}

	function array_sort_by_field($array, $on, $order=SORT_ASC)
	{
	    $new_array = array();
	    $sortable_array = array();
	
	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }
	
	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }
	
	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }
	
	    return $new_array;
	}
	
	function create_slug($string){
	   $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
	   return $slug;
	}
	
	 function check_values( $arrayA , $arrayB ) {

       @sort( $arrayA );
       @sort( $arrayB );

     return $arrayA == $arrayB;
    } 
	 
	 function setPaginationConfig($base_url,$total_rows,$uri_segment,$per_page=25){
		$config['use_page_numbers'] = TRUE;
		$config['display_pages'] 	= FALSE;
	    $config['base_url'] 		= $base_url;
	    $config['full_tag_open'] 	= '';
		$config['full_tag_close'] 	= '';
		$config['first_link'] 		= false;
	    $config['last_link'] 		= false;	    
	    $config['prev_link'] 		= 'Prev';
	    $config['prev_tag_open'] 	= '<div class="nxtPrvBtn" >';
	    $config['prev_tag_close'] 	= '</div>';
	    $config['next_link'] 		= 'Next';
	    $config['next_tag_open'] 	= '<div class="nxtPrvBtn" >';
	    $config['next_tag_close'] 	= '</div>';  
		$config['uri_segment'] 		= $uri_segment;
	    $config['total_rows'] 		= $total_rows;
	    $config['per_page'] 		= $per_page;
	    //$config['num_links'] 		= 5;			
		return $config;
   }
	 
	 
	 
	 function getAdminUsername($id){
	 	
		$ci =& get_instance();
		$ci->db->select('first_name,last_name,access_level,email_address,created_on');
		$ci->db->where('id', $id);
		$query=$ci->db->get('administrator');
		return $query->result();
	 }



	 function getuserdetails($user_id){
	 	
		$ci =& get_instance();
		$ci->db->select('*');
		$ci->db->where('user_id', $user_id);
		$query=$ci->db->get('user_master');
		return $query->result();
	 }



	function header_redirect($location = ''){ 
     $ci =& get_instance(); 
     $reffer_url = $ci->agent->referrer(); 
     if($reffer_url==''){ 
          return base_url($location); 
     }else{ 
          return $reffer_url; 
     } 
}
	 
	function customMailSend($to,$subject,$message,$from){
		if($from==''){
	  		$from="webgrity111@gmail.com";	
		}

	  $headers = "From: ".get_option('site_title').'<'. strip_tags($from) .'>'. "\r\n";
  	  $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
  	  //$headers .= "CC: info@phpgang.com\r\n";
  	  $headers .= "MIME-Version: 1.0\r\n";
  	  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
	  @mail($to, $subject, setEmailTemplate($message), $headers);
    }
	 
	function customSmtpMailSend($to,$subject,$message,$bcc = "", $path = ""){
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'webgrity111@gmail.com';
		$config['smtp_pass']    = 'catch123';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or html
		$config['validation'] = TRUE; // bool whether to validate email or not  
	
		$CI =& get_instance();
		$CI->load->library('email');
		$CI->email->initialize($config);
		$CI->email->from('webgrity111@gmail.com', 'Alumni');
	    $CI->email->to($to); 
		if($bcc != ""){
			$CI->email->bcc($bcc);
		}
	    $CI->email->subject($subject);
	    $CI->email->message(setEmailTemplate($message));
		if($path != ""){
			$CI->email->attach($path);
		}  
	    $CI->email->send();	
}
	
	function SendEmailTo($to,$subject,$message,$from="",$bcc = "", $path = ""){
		$host=$_SERVER['HTTP_HOST'];
		/*if($host=='localhost' || $host=='animesh'){
			customSmtpMailSend($to,$subject,$message,$bcc,$path);
		}else if($host=='uttam.webgrity.net'){
			customMailSend($to,$subject,$message,$from);
		}else{
			customSmtpMailSend($to,$subject,$message,$bcc,$path);
		}*/
		customMailSend($to,$subject,$message,$from);
	}

    $const_result = $ci->db->get('options')->result();
		foreach($const_result as $result){
			define( strtoupper($result->option_name), $result->option_value );
		}
		
   /*======== Fullday Event Times =========*/
   
   define('FULLDAY_EVENT_START', '00:01:00');
   define('FULLDAY_EVENT_END', '23:59:00');
		
 function date_time_format($date_time){
	$empty_date_time_format="0000-00-00 00:00:00";
	$empty_date_format="0000-00-00";
    
    $unx_stamp = strtotime($date_time);
    $date_str  = "-";
	if($date_time!=$empty_date_time_format || $date_time!=$empty_date_format){
    switch (DATE_FORMAT) {
        case 1:
            $date_str = (date("Y/m/d", $unx_stamp));
            break; //2016/06/13
        case 2:
            $date_str = (date("m/d/Y", $unx_stamp));
            break; //06/13/2016
        case 3:
            $date_str = (date("d/m/Y", $unx_stamp));
            break; //13/06/2016
        case 4:
            $date_str = (date("d M Y", $unx_stamp));
            break; //13 Jun 2016
        case 5:
            $date_str = (date("dS M, Y", $unx_stamp));
            break; //13 June 2016
        case 6:
            $date_str = (date("M d, Y", $unx_stamp));
            break; //13th Jun ,2016
        case 7:
            $date_str = (date("D M dS, Y", $unx_stamp));
            break; //Tue Jun 13th,2016
        case 8:
            $date_str = (date("dS F, Y", $unx_stamp));
            break; //Tuesday Jun 13th,2016
        case 9:
            $date_str = (date("l M dS, Y", $unx_stamp));
            break; //Tuesday June 29th,2016
        case 10:
            $date_str = (date("d M Y l", $unx_stamp));
            break; //13 June 2016 Tuesday
        case 11:
            $date_str = (date("Y/m/d H:i:s", $unx_stamp));
            break; //13 June 2016 Tuesday
        default :
        	$date_str = (date("dS M, Y", $unx_stamp));
            break; //13 June 2016 Tuesday
         }
    }

return $date_str;
}

function setEmailTemplate($msg){
	
	$header_email= '
	<html>
	<head>
<style type="text/css">
body{margin:0; padding:0; background:#ffffff; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; color:#656363; line-height:18px;}
a{text-decoration:none; color:#faae2c;}
a:hover{text-decoration:none; color:#2f6f82;}
img{border:0; margin:0;}
p{margin:0;}
.similar_popup_box{margin:0; float:left; padding:20px; background:#ffffff; min-height:200px;}
.similar_popup_box table{font:12px/18px Arial, Helvetica, sans-serif; color:#111111;}
.similar_popup_box table tr:first-child{border-top:1px solid #dadada;}
.similar_popup_box table tbody tr:hover{background:#f7f7f7;}
.similar_popup_box table tr td{padding:10px 10px; vertical-align:middle; border-right:1px solid #dadada; border-bottom:1px solid #dadada;}
.similar_popup_box table tr td:first-child{border-left:1px solid #dadada; font-size:14px;}
</style>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td style="padding:10px 20px;" valign="top">
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:5px; border-bottom:1px solid #e5e5e5;">
          <tr>
            <td width="60%" valign="top"><img src="'.base_url().'assets/images/logo.jpg" width="193" height="89" alt=""></td>
            <td width="40%" valign="top" style="text-align:right;">
            &nbsp;
            </td>
          </tr>
        </table>
    </td>
  </tr><tr>
    <td style="padding:10px 20px 20px;">';  

  $footer_email='</td>
  </tr><tr>            	
        <td align="center" valign="top" style="padding:20px 20px 30px;">
           
        </td>
    </tr>
  <tr>
    <td style="padding:16px 20px; color:#ffffff; background:#3d3d3d" align="center">'.COPYRIGHT.'</td>
  </tr>  
</table>
</body>
</html>';
	
	return $message = $header_email.$msg.$footer_email;
}



function db_date_format($date){
	$blank='';
	if(!empty($date)){
	 $formatted=str_replace("/","-",$date);
	 return date("Y-m-d",strtotime($formatted));
	}else{
	  return $blank;
	}
}


function db_time_format($time){
	$blank='';
	if(!empty($time)){
	 $formatted=str_replace("/",":",$time);
	 return date("H:i:s",strtotime($formatted));
	}else{
	  return $blank;
	}
}

function db_datetime_format($time){
	$blank='';
	if(!empty($time)){
	 $formatted=str_replace("/",":",$time);
	 return date("Y-m-d H:i:s",strtotime($formatted));
	}else{
	  return $blank;
	}
}

	 function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    $aryRange=array();
		
	    $iDateFrom=mktime(substr($strDateFrom,11,2),substr($strDateFrom,14,2),substr($strDateFrom,17,2),substr($strDateFrom,5,2),substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(substr($strDateFrom,11,2),substr($strDateFrom,14,2),substr($strDateFrom,17,2),substr($strDateTo,5,2),substr($strDateTo,8,2),substr($strDateTo,0,4));
	
	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d H:i:s',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d H:i:s',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}

  function createDayWiseDateRange($strDateFrom,$strDateTo,$day){
  	$date_arr=createDateRangeArray($strDateFrom,$strDateTo);
	$day_date=array();
	  if(count($date_arr)>0){
	  	foreach ($date_arr as $date) {
			 if(date('w',strtotime($date))==$day){
	  		   $day_date[]=$date;
	  	     } 
		  }
	  	
	  }
	return $day_date;
  }
  
  function createWeekDayWiseDateRange($strDateFrom,$strDateTo='',$day='',$week=''){
  	$date_arr=createDateRangeArray($strDateFrom,$strDateTo);
	$day_date=array();
	  if(count($date_arr)>0){
	  	$ord = 1;
		foreach ($date_arr as $date) {
			$timestamp = is_numeric($date) ? $date : strtotime($date);
			$week_day_arr=weekDay($timestamp);
			  if($week_day_arr['day']==$day && $week_day_arr['week']==$week) {
	  		    $day_date[]=$date;
			  }
		  }
	  }
  	return $day_date;
  }
  
   function weekDay($timestamp) {
   	
	$timestamp = is_numeric($timestamp) ? $timestamp : strtotime($timestamp);
	$weekday = date('w', $timestamp);
	$month = date('M', $timestamp);

	$ord = 1;

	while(date('M', ($timestamp = strtotime('-1 week', $timestamp))) == $month) {
		$ord++;
	}

	$lit = array(null, 'first', 'second', 'third', 'fourth', 'fifth');

	return array('day'=>$weekday,'week'=>$ord);
}
   
   /*========= Calendar Function ============ */
   
    function getAllDates()
	{
	    $alldates = array();
		
		$year=date("Y",strtotime(date("Y-m-d")));
		$cur_month=date("m",strtotime(date("Y-m-d")));
		$last_month_days = date('t', mktime(0,0,0,$cur_month,366,$year));
		$day_number_last_month = date('j', mktime(0,0,0,$cur_month,366,$year));
		$day_diff=$last_month_days-$day_number_last_month;
	
	   for($i = 1; $i <= 366+$day_diff; $i++){
	        $month = date('M Y', mktime(0,0,0,$cur_month,$i,$year));
	        $wk = date('W', mktime(0,0,0,$cur_month,$i,$year));
	        $wkDay = date('D', mktime(0,0,0,$cur_month,$i,$year));
	        $day = date('d', mktime(0,0,0,$cur_month,$i,$year));
	
	        $alldates[$month][$wk][$wkDay] = $day;
	    } 
	
	
	    return $alldates;   
	}
	
	/* ============ View Form ============ */
	
	function view_from($id,$type,$name,$label_name,$required,$options='',$options_val='',$min='',$max=''){
	 	
		$data='';
	 	$type=$type;
		$name=$name;
		$label=$label_name;
		$arr_string['options']=$options;
		$arr_string['options_val']=$options_val;
		$arr_string['min']=$min;
		$arr_string['max']=$max;
		
		 $data='<tr id="fieldid_'.$id.'" class="field_list">
					  <td><h4>'.$label.'&nbsp;'.($required=='yes' ? '<span style="color:#ff0000">*</span>' : '').'<a data_id="'.$id.'" class="delete" style="cursor:pointer;float:right;"><i class="fa fa-remove"></i></a><a data_id="'.$id.'" class="field_edit" style="cursor:pointer;float:right;margin-right:10px;"><i class="fa fa-edit"></i></a></h4>';
		 switch($type){
		 	case 'text': $data.='<input type="text" name="'.$name.'" />';
			 break;
			case 'textarea': $data.='<textarea name="'.$label.'" ></textarea>';
			break;
			case 'email': $data.='<input type="email" name="'.$name.'" />';
			break;
			case 'radio': 
			  $options=isset($arr_string['options']) ? $arr_string['options'] : '';
			  foreach ($options as $key=>$option) {
				  $data.=$option.'&nbsp;<input type="radio" name="'.$name.'" value="'.$arr_string['options_val'][$key].'" />';
			  }
			
			break;
			case 'checkbox': 
				 $options=isset($arr_string['options']) ? $arr_string['options'] : '';
			  foreach ($options as $key=>$option) {
				  $data.=$option.'&nbsp;<input type="checkbox" name="'.$name.'[]" value="'.$arr_string['options_val'][$key].'" />';
			  }
			break;
			case 'date': 
			$min_date=isset($arr_string['min']) ? $arr_string['min'] : '';
			$max_date=isset($arr_string['max']) ? $arr_string['max'] : '';
			$data.='<input type="text" name="'.$name.'" class="formDatepkrAll" />
			<script>
			$(function(){
				$(".formDatepkrAll").datepicker(
	    		{
					dateFormat: "dd/mm/yy",
			    	changeMonth: true,
					changeYear: true,
					minDate: "'.$min_date.'",
					maxDate: "'.$max_date.'"
			    });
			})</script>';
			break;
			case 'number': 
			$min=isset($arr_string['min']) ? $arr_string['min'] : '';
			$max=isset($arr_string['max']) ? $arr_string['max'] : '';
			$data.='<input type="number" name="'.$name.'" min="'.$min.'" max="'.$max.'" />';
			break;
			case 'single': 
			 $options=isset($arr_string['options']) ? $arr_string['options'] : '';
				 $data.='<div class="form_box_row cus_select"><select name="'.$label.'">';
				  foreach ($options as $key=>$option) {
					  $data.='<option value="'.$arr_string['options_val'][$key].'">'.$option.'</option>';
				  }
			    $data.='</select></div>';
			break;
			case 'multiple': 
			 $options=isset($arr_string['options']) ? $arr_string['options'] : '';
				 $data.='<div class="form_box_row cus_select"><select name="'.$name.'" multiple="multiple">';
				  foreach ($options as $key=>$option) {
					  $data.='<option value="'.$arr_string['options_val'][$key].'">'.$option.'</option>';
				  }
			    $data.='</select></div>';
			break;
			case 'upload': 
			$data.='<input type="file" name="'.$name.'" />';
			break;
		 }
		
		$data.='</td></tr>';
			
		return $data;		
	 }

/* =========== Form HTML ========== */

  function form_html($id,$type,$name,$label_name,$required,$options='',$options_val='',$min='',$max='',$class=''){
  	$data='';
	switch($type){
		 	case 'text': 
		 	$data.='<div class="form_box_row"><input type="text" id="'.$name.'" name="'.$name.'_'.$id.'" placeholder="'.$label_name.'" '.($required=='yes' ? 'required' : '').'  /></div>';
			break;
			case 'textarea': 
			$data.='<div class="form_box_row"><textarea id="'.$name.'" name="'.$name.'_'.$id.'"  placeholder="'.$label_name.'"  '.($required=='yes' ? 'required' : '').'></textarea></div>';
			break;
			case 'email': 
			$data.='<div class="form_box_row"><input type="email" id="'.$name.'" name="'.$name.'_'.$id.'" placeholder="'.$label_name.'" '.($required=='yes' ? 'required' : '').' /></div>';
			break;
			case 'radio': 
			  $options=isset($options) ? $options : '';
			  $data.='<div class="form_box_row">';
			  $data.='<h4>'.$label_name.'</h4><ul class="cus_radiobtn inb">';
			  foreach ($options as $key=>$option) {
				  $data.='<li><label><input type="radio" id="'.$name.'" name="'.$name.'_'.$id.'" value="'.$options_val[$key].'" '.($required=='yes' ? 'required' : '').' /><span class="overlay"></span>'.$option.'</label></li>';
			  }
			  $data.='</ul></div"><span class="error" for="'.$name.'_'.$id.'" generated="true"></span>';
			break;
			case 'checkbox': 
			  $options=isset($options) ? $options : '';
			  $data.='<div class="form_box_row">';
			  $data.='<h4>'.$label_name.'</h4><ul class="cus_checkbox inb">';
			  foreach ($options as $key=>$option) {
				  $data.='<li><label><input type="checkbox" id="'.$name.'" name="'.$name.'_'.$id.'[]" value="'.$options_val[$key].'" '.($required=='yes' ? 'required' : '').' /><span class="overlay"></span>'.$option.'</label></li>';
			  }
			  $data.='</div"><span class="error" for="'.$name.'[]" generated="true"></span>'; 
			break;
			case 'date': 
			$min_date=isset($min) ? $min : '';
			$max_date=isset($max) ? $max : '';
			$data.='<div class="form_box_row"><input type="text" id="'.$name.'" name="'.$name.'_'.$id.'" placeholder="'.$label_name.'" class="formDatepkrAll" '.($required=='yes' ? 'required' : '').' readonly="readonly" /></div>
			<script>
			$(function(){
				$(".formDatepkrAll").datepicker(
	    		{
					dateFormat: "dd/mm/yy",
			    	changeMonth: true,
					changeYear: true,
					minDate: "'.$min_date.'",
					maxDate: "'.$max_date.'"
			    });
			})</script>';
			break;
			case 'number': 
			$min_date=isset($min) ? $min : '';
			$max_date=isset($max) ? $max : '';
			$data.='<div class="form_box_row"><input type="number" id="'.$name.'" name="'.$name.'_'.$id.'"  placeholder="'.$label_name.'" min="'.$min.'" max="'.$max.'" '.($required=='yes' ? 'required' : '').' /></div>';
			break;
			case 'single': 
			 $options=isset($options) ? $options : '';
				 $data.='<div class="form_box_row cus_select"><select id="'.$name.'" name="'.$name.'_'.$id.'" '.($required=='yes' ? 'required' : '').'>';
				 $data.='<option value="">'.$label_name.'</option>';
				  foreach ($options as $key=>$option) {
					  $data.='<option value="'.$options_val[$key].'">'.$option.'</option>';
				  }
			    $data.='</select></div>';
			break;
			case 'multiple': 
			 $options=isset($arr_string['options']) ? $arr_string['options'] : '';
				 $data.='<div class="form_box_row cus_select"><select id="'.$name.'" name="'.$name.'_'.$id.'[]" multiple="multiple" '.($required=='yes' ? 'required' : '').'>';
				 $data.='<option value="">'.$label_name.'</option>';
				  foreach ($options as $key=>$option) {
					  $data.='<option value="'.$options_val[$key].'">'.$option.'</option>';
				  }
			    $data.='</select></div>';
			break;
			case 'upload': 
			$data.='<div class="form_box_row"><input type="file" id="'.$name.'" name="'.$name.'_'.$id.'"  placeholder="'.$label_name.'" '.($required=='yes' ? 'required' : '').' /><input type="hidden" name="'.$name.'_'.$id.'" value="upload" /></div>';
			break;
		 }

		return $data;
   }

	function array_equal($a, $b) {
	    return (is_array($a) && is_array($b) && array_diff($a, $b) === array_diff($b, $a));
	}
    


    
    /*============== Member Accesibility ================*/
    
    function have_access($controller,$access){
    	
		$ci =& get_instance();	
	    $ministry_access = $access;	
	    $ret = false;
		if(count($access)>0){
			foreach ($access as $access_id) {
				
				switch($access_id){
				case 1:
					$ret =true;
					break;
				case 11:  // follow-up_personal
					$can_access = array('guests');
					if(in_array($controller, $can_access)){
						$ret = true;	
					}else{
						$ret = false;
					}
				}
			}
		}else{
			$ret=false;
		}
		
		return $ret;
    }
	
	/*=========== Method Accessibility ============== */
	
	function have_access_method($method,$access){
	   $ret=false;
	   switch($access){
	   	case @in_array(1,$access):
			$ret=true;
	   }
	   return $ret;
	}
	
	/*============= Text Input =============*/
	function text_input($text){
		$sanitized=filter_var(filter_var( $text, FILTER_SANITIZE_STRING),FILTER_SANITIZE_MAGIC_QUOTES);
		return $sanitized;
	}
	
	/*============= Text Output ===============*/
	
	function text_output($text){
		$rest=nl2br(htmlentities($text));
		return $rest;
	}
	
	/*========== Object array to array =========== */
	
	function ObjArrToArray($Objarr,$field){
		$arr=array();
		if(count($Objarr)>0){
			foreach ($Objarr as $obj) {
				$arr[]=$obj->$field;	
		    }
		}
		return $arr;
	}
	/*======== deafult_date_format ==========*/
	
	function formal_date_format($date_time){
		
	    $empty_date_time_format="0000-00-00 00:00:00";
	    $empty_date_format="0000-00-00";
	    $ret_date='';
	    $unx_stamp = strtotime($date_time);
	    $date_str  = "-";
	   if($date_time!=$empty_date_time_format || $date_time!=$empty_date_format){
		  $ret_date=date('d/m/Y',strtotime($date_time));
	   }
	  return $ret_date;
	}
	

	//=========== Currentdatetime=======

	function get_current_date_time(){
		$datestring = '%Y-%m-%d %H:%i:%s';
	   $time = time();	
	   return mdate($datestring, $time);
	}

	//Function Desclaration
function date_time_ago($input_date,$date_format='M d, Y h:i A',$time_format='h:i A'){
    $formated_date = "";
    if (!empty($input_date)) {
        
        $current_date_time = time();
        $orignal_date_time = strtotime($input_date);
        $date_time_difference = $current_date_time - $orignal_date_time;


        $full_days = floor($date_time_difference/(60*60*24));
        $full_hours = floor(($date_time_difference-($full_days*60*60*24))/(60*60));
        $full_minutes = floor(($date_time_difference-($full_days*60*60*24)-($full_hours*60*60))/60);
        $full_seconds = floor(($date_time_difference-($full_days*60*60*24)-($full_hours*60*60)-($full_minutes*60)));

        if($full_days > 2){
            $time = date($date_format,$orignal_date_time);
        } elseif($full_days == 2){
            $time = '2 days ago';
        } elseif(date("j",$current_date_time) > date("j",$orignal_date_time)){
            $time = 'Yesterday at '.date($time_format,$orignal_date_time);
        } elseif ($full_hours > 0) {
            $time = $full_hours . ' hours ago';
            if ($full_hours == 1) {
                $time = $full_hours . ' hour ago';
            }
        } elseif ($full_minutes > 0) {
            $time = $full_minutes . ' mins ago';
            if ($full_minutes == 1) {
                $time = $full_minutes . ' min ago';
            }
        } else {
            $time = 'Just now';
        }
        $formated_date = $time;                
    }
    return $formated_date;
}

function get_time_ago( $datetime, $full = false )
{

$estimate_time = time() - $datetime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }

}

// Auto Generate Password //
function generatePassword($l=8) {
    $chars = array(
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
        'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '?', '!', '@', '#',
        '$', '%', '^', '&', '*', '(', ')', '[', ']', '{', '}', '|', ';', '/', '=', '+'
    );

    shuffle($chars);

    $num_chars = count($chars) - 1;
    $token = '';

    for ($i = 0; $i < $l; $i++){ // <-- $num_chars instead of $len
        $token .= $chars[mt_rand(0, $num_chars)];
    }

    return $token;
}

function generatePIN($digits = 4){
    $i = 0; 
    $pin = ""; 
    while($i < $digits){
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

?>