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
<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/jQueryui/jquery-ui.css" rel="stylesheet">
<link href="assets/admin/css/temp.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="assets/admin/js/jquery.js"></script>
<script type="text/javascript" src="assets/admin/js/jPushMenu.js"></script>
<script type="text/javascript" src="assets/admin/js/jquery.nanoscroller.js"></script>
<script type="text/javascript" src="assets/admin/js/theme-functions.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.js" ></script>
<script src="assets/js/jquery.validate.additional-methods.min.js"></script>
<!-- css3-mediaqueries.js for IE8 or older -->
<!--[if lt IE 9]>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
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

     $(window).load(function() { 
          $(".page_loader").fadeOut("slow"); 
     })  
   
  });  

</script> 
<div class="page_loader"></div>

</head>

<body>
<div id="main_wrapper">