<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
  if($this->session->userdata('login_cred')){
   $login_cred=$this->session->userdata('login_cred');
   $username=$login_cred['username'];
   $user_id=$login_cred['id'];
   $user_name_arr=getAdminUsername($user_id);
   $user_name=$user_name_arr[0]->first_name.'&nbsp;'.$user_name_arr[0]->last_name;
 }else{
   $username='';
   $user_id='';
   $user_name='';
 }
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Admin : <?php echo $page_title;?></title>
<base href="<?php echo base_url()?>" />
<link href="assets/admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="assets/admin/css/left-sidebar.css" rel="stylesheet" type="text/css" />
<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/admin/css/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
<!-- <link type="text/css" rel="stylesheet" href="assets/admin/css/jquery.stepy.css" /> -->

<!-- JQUERY UI -->
<link rel="stylesheet" href="assets/jQueryui/jquery-ui.css" type="text/css" />
<link href="assets/jQueryui/jquery-ui-timepicker.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="assets/admin/js/jquery.js"></script>
<script type="text/javascript" src="assets/admin/js/left-sidebar.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="assets/admin/js/organictabs.jquery.js"></script>
<script type="text/javascript" src="assets/admin/js/theme-functions.js"></script>
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<!-- Validation -->
<script type="text/javascript" src="assets/admin/js/jquery.validate.js" ></script>
<script src="assets/admin/js/jquery.validate.additional-methods.min.js"></script>
<!--   <script type="text/javascript" src="assets/admin/js/jquery.stepy.js"></script> -->
<!-- JQuery UI -->
<!-- <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
<script type="text/javascript" src="assets/jQueryui/jquery-ui.js"></script>
<script type="text/javascript" src="assets/jQueryui/jquery-ui-timepicker.js"></script>
<script type="text/javascript" src="assets/admin/tinymce/tinymce.min.js"></script>
<script>
	tinymce.init({selector: 'textarea.editor',
	    plugins: [
	            "advlist autolink lists link image charmap print preview anchor textcolor colorpicker",
	            "searchreplace visualblocks code fullscreen",
	            "insertdatetime media table contextmenu paste jbimages"
	        ],
	        toolbar: "code | insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
	        relative_urls: false,         
			height: 300,
   			width: 880
    	});
    	
</script>
<script>
	$(function(){
		$(".datepkrAll").datepicker(
    		{
				dateFormat: "dd/mm/yy",
		    	changeMonth: true,
				changeYear: true
		    });
		 $(".dobdatepkr").datepicker(
    		{
				dateFormat: "dd/mm/yy",
		    	changeMonth: true,
				changeYear: true,
				maxDate:0,
				yearRange: "-80:+0"
		    });
		    
	 $('.event_row').click(function(){
		if($(this).next('.event_list').is(":visible")){						
			$(this).next('.event_list').slideUp(500);
			$('.event_row').removeClass("selected");						
		}else{			
			$('.event_list').slideUp(500);
			$('.event_row').removeClass("selected");			
			$(this).next('.event_list').slideDown(500);
			$(this).addClass('selected');
		}		
	  })	
	});
</script>
</head>

<body>
	<div id="main_wrapper">
	<div class="header_wrap">
    	<div class="row">
        	<div class="logo"><a href="#"><img src="assets/admin/images/logo.png" alt=""></a></div>
            <!-- <div class="alert_box">
            	<i class="fa fa-bell"><span>6</span></i>
                <i class="fa fa-envelope"><span>0</span></i>
            </div> -->
            <div class="header_right">
                <a href="javascript:void(0);" class="administrator"><span class="user"><img src="assets/admin/images/user.png" alt="" /></span> <span class="username">Welcome, <?=isset($user_name) ? $user_name  : '';?></span> <i class="down fa fa-angle-down"></i></a>
                <div class="account_details_box">
                    <ul>
                        <li><a href="<?=base_url()?>admin/account/my_account"><i class="fa fa-user"></i> My Account</a></li>
                        <li><a href="<?=base_url()?>admin/account/settings"><i class="fa fa-cog"></i> General Settings</a></li>
                        <li><a href="<?=base_url()?>admin/account/change_pw"><i class="fa fa-lock"></i> Change Password</a></li>
                        <li class="logout"><a href="<?=base_url()?>admin/dashboard/logout/"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>                
            </div>
            <div id="pull_nav">
                <a href="javascript:void(0);" id="menuBtn" class="menu_link">
                    <span class="n"></span>
                    <span class="g"></span>
                    <span class="s"></span>
                </a>
            </div>   
        </div>        
    </div>