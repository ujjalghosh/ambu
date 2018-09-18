<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Admin : Formbuilder</title>
<base href="<?php echo base_url()?>" />
<link href="assets/admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="assets/admin/css/font-awesome.min.css" rel="stylesheet">
<!-- JQUERY UI -->
<link rel="stylesheet" href="assets/jQueryui/jquery-ui.css" type="text/css" />
<script type="text/javascript" src="assets/admin/js/jquery.js"></script>
<!-- Validation -->
<script type="text/javascript" src="assets/admin/js/jquery.validate.js" ></script>
<script src="assets/admin/js/jquery.validate.additional-methods.min.js"></script>
<!-- JQuery UI -->
<script type="text/javascript" src="assets/jQueryui/jquery-ui.js"></script>
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
	});
</script>
</head>