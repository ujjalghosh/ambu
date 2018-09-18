<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/left'); 
?>
<script>	
	$(function(){
		$('.viewEmail').click(function(){
			$.fancybox.open([{  href : '#viewEmail'}]);
			var id = $(this).attr("data-id");
			$.ajax({
		        type     : "POST",
		        url      : "<?=base_url()?>admin/email_template/view_template_details",
		        cache: false,
		        data     : { id: id },
		        success  : function(data) {	
		        	$('#eMailCont').html(data);
		        	$('#viewEmail').fadeIn(300);                    
		        },
	        	beforeSend: function(){ 
                   $("#loadingDv").show(); 
               }, 
               complete: function(){ 
                   $("#loadingDv").hide(); 
               }
		    });
		});
		
	});
	
	
</script>
<div id="viewEmail" class="email_popup_box">
	<a class="cancel" href="javascript:;" onclick="$.fancybox.close();"><i class="fa fa-times-circle"></i></a>
	<div id="eMailCont"></div>
</div>


<div class="content_wrap">
        	<div class="row">
            	<div class="breadcrumb_nav">
                	<ul>
                    	<li><a href="<?=base_url()?>admin/">Dashboard</a></li>
                        <li><a href="<?=base_url()?>admin/email_template/manage_email_templates/">Email Templates</a></li>
                    </ul>
                    <a href="#search" class="list_search fancybox"><i class="fa fa-search"></i></a>
                    <div class="popup_box" id="search">
                        <a class="cancel" href="javascript:;" onclick="$.fancybox.close();"><i class="fa fa-times-circle"></i></a>
                         <form method="post" action="<?=base_url()?>admin/email_template/search_email_templates/">
                         <input type="hidden" name="action" value="search" />
	                        <div class="form_box">
	                        	<div class="form_box_row"><input type="text" name="email_template_title" value="<?= isset($this->session->userdata['searchData']['email_template_title'])?$this->session->userdata['searchData']['email_template_title']:'' ?>" placeholder="Template title" /></div>
	                        </div>
	                        <div class="form_box">
	                        	<div class="form_box_row"><input type="text" name="email_template_subject" value="<?= isset($this->session->userdata['searchData']['email_template_subject'])?$this->session->userdata['searchData']['email_template_subject']:'' ?>" placeholder="Subject" /></div>
	                        </div>
	                        <div class="form_box_bottom">                            
	                            <button type="submit" class="btn right orange">Search</button>
	                        </div>
                        </form>
                    </div>
                </div>
            	<div class="view_category">
                	
                    <div class="view_category_right"><strong><?=$tot_rows;?></strong> <?=$tot_rows>1 ? 'Records' : 'Record';?> found.</div>
                </div>
                <div class="listing_category email_list">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <thead>
                      <tr>
                      	<th width="5%" align="center" valign="top"></th>
                        <th width="25%" align="left" valign="top">Title<a href="<?= base_url()."admin/".$this->router->fetch_class()."/".$this->router->fetch_method()."/".$page."/title/".$order ?>">
											<span class="icon sort_icon" style="float: right;color: #fff;">
												<?php if($sort_field!='title'){ ?>
													<i class="fa fa-sort"></i>
												<?php }elseif($sort_field=='title' && $order=='asc'){ ?>
													<i class="fa fa-sort-desc"></i>
												<?php }elseif($sort_field=='title' && $order=='desc'){ ?>
													<i class="fa fa-sort-asc"></i>
												<?php } ?>
											</span></a></th>
									<th width="40%" align="left" valign="top">Subject<a href="<?= base_url()."admin/".$this->router->fetch_class()."/".$this->router->fetch_method()."/".$page."/subject/".$order ?>">
											<span class="icon sort_icon" style="float: right;color: #fff;">
												<?php if($sort_field!='subject'){ ?>
													<i class="fa fa-sort"></i>
												<?php }elseif($sort_field=='subject' && $order=='asc'){ ?>
													<i class="fa fa-sort-desc"></i>
												<?php }elseif($sort_field=='subject' && $order=='desc'){ ?>
													<i class="fa fa-sort-asc"></i>
												<?php } ?>
											</span></a>
									</th>
									<th width="10%" align="center" valign="top">Created<a href="<?= base_url()."admin/".$this->router->fetch_class()."/".$this->router->fetch_method()."/".$page."/created_at/".$order ?>">
											<span class="icon sort_icon" style="float: right;color: #fff;">
												<?php if($sort_field!='created_at'){ ?>
													<i class="fa fa-sort"></i>
												<?php }elseif($sort_field=='created_at' && $order=='asc'){ ?>
													<i class="fa fa-sort-desc"></i>
												<?php }elseif($sort_field=='created_at' && $order=='desc'){ ?>
													<i class="fa fa-sort-asc"></i>
												<?php } ?>
											</span></a>
									</th>
									<th width="7%" align="center" valign="top">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php if(count($email_templates)>0){
						foreach($email_templates as $email_template){?>
					  <tr>
						<td align="center" valign="top"><?=$email_template->id ?></td>
						<td align="left" valign="top"><?= $email_template->title ?></td>
						<td align="left" valign="top"><?= $email_template->subject ?></td>
						<td align="center" valign="top"><?=date_time_format($email_template->created_at);?></td>
                        <td align="center" class="action"><a href="<?= base_url()."admin/email_template/edit_email_template/".$email_template->id ?>"><i class="fa fa-pencil"></i></a><a data-id="<?= $email_template->id ?>" style="cursor: pointer;" class="viewEmail"><i class="fa fa-eye "></i></a>
                          <!-- <input type="hidden" id="cat_del_<?= $category->id ?>" value="<?php echo $category->name?>" /> -->
                        </td>
                      </tr>
						<?php }
                      } else {?>
					 	<tr>
					 		<td align="center" colspan="7">No records found.</td>
					 	</tr>
			         <?php } ?>
                      
                      </tbody>
                    </table>
                </div>
                <?php if($no_of_page>1){ ?>
    			<?php $this->load->view('admin/includes/pagination'); ?>
    		<?php } ?>
            </div>
        </div>
<?php $this->load->view('admin/includes/footer'); ?>