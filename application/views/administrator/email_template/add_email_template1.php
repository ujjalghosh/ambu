<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/left'); 
if(isset($email_template_info)){
	$email_template_id = $email_template_info->id;
	$email_template_title = $email_template_info->title;
	$email_template_subject = $email_template_info->subject;
	$email_template_content = $email_template_info->content;
	$email_template_keywords = $email_template_info->keywords;
}else{
	$email_template_id = '';
	$email_template_title = '';
	$email_template_subject = '';
	$email_template_content = '';
}
?>
<script>	
	$(function(){		
		$("#email_template_form").validate({
			errorElement: "span",
			rules:
			{
				email_template_title: "required",
				email_template_subject: "required",
				email_template_content: {
					required: function() {
				    	var editorContent = tinyMCE.get('email_template_content').getContent();
						if (editorContent == ''){
						     return true;
						}
						else{
						     return false;
						}
				       
				    }	
				},
			},
			messages:
			{
				email_template_title: "Please enter email template title",
				email_template_subject: "Please enter email subject",
				email_template_content: "Please enter email content",
			},
			submitHandler: function(form) {
				$('#email_template_content').val(tinyMCE.get('email_template_content').getContent());

				$.ajax({
			        type     : "POST",
			        url      : form.action,
			        dataType : 'json',
			        data     : $("#email_template_form").serialize(),
			        success  : function(data) {			            
			        	if(data.success==0){
			        		$('#message_show').html(data.error_message);
			        		 $('html, body').animate({
					            scrollTop: 0
					         }, 800);
			        	}else{
			        		$('#message_show').html(data.success_message);
					        $('html, body').animate({
					            scrollTop: 0
					        }, 800);
					        $("#err_report").hide();
					        location.href="<?=base_url('admin/email_template/manage_email_templates')?>";
			        	}
			        },
			        beforeSend: function(){ 
	                   $("#loadingDv").show(); 
	               }, 
	               complete: function(){ 
	                   $("#loadingDv").hide(); 
	               }
			    });
			    
			}
		});	
	});
</script>
<div id="message_show"></div>
<div class="content_wrap">
        	<div class="row">
            	<div class="breadcrumb_nav">
                	<ul>
                    	<li><a href="<?=base_url()?>admin/">Dashboard</a></li>
                        <li><a href="<?=base_url()?>admin/email_template/manage_email_templates/">Email Templates</a></li>
                        <li><?=isset($email_template_info)?'Update':'Add'?> Email Template</li>
                    </ul>
                </div>
            	<form id="email_template_form" method="post" action="<?=base_url()?>admin/email_template/insert_update_email_template" enctype="multipart/form-data">
                    <div class="form_box">
                        <div class="form_box_row">
                            <div class="form_box_col">                            
                                <div class="form_box_row"><input name="email_template_title" id="email_template_title" type="text" placeholder="Email title" value="<?= $email_template_title ?>"></div>
                            </div>
                            <div class="form_box_col right">                            
                                <div class="form_box_row"><input name="email_template_subject" id="email_template_subject" type="text" placeholder="Email Subject" value="<?= $email_template_subject ?>"></div>
                            </div>
                        </div>
                        <div class="form_box_row">
                           <p><?= $email_template_keywords ?></p>
						   <p>[***Do not delete keywords (i.e keywords preceded and succeeded by '#' sign) from email content.]</p>
                        </div>
                        <div class="form_box_row">
                        	<textarea name="email_template_content" id="email_template_content" class="editor" rows="10" cols="30"><?=$email_template_content?></textarea>
						</div>
                    </div>
                    <div class="form_box_bottom">
                        <a href="<?php echo base_url(); ?>admin/email_template/manage_email_templates/" class="btn left black"><i class="fa fa-arrow-circle-left"></i> Back</a>                        
                        <button type="submit" class="btn right orange"><i class="fa fa-plus-circle"></i><?=isset($email_template_info)?'Update':'Add'?></button>
                        <input type="hidden" name="email_template_id" value="<?= $email_template_id ?>" />
                        <span class="loadingSpan"></span>
                    </div>
                </form>
            </div>
        </div>

<?php $this->load->view('admin/includes/footer'); ?>