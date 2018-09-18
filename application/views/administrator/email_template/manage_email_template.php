 <?php $this->load->view('administrator/tpl/header.php');  
//print_r($this->session->userdata);
if(isset($this->session->userdata['searchData']['parent_id'])){
	$parent_id=$this->session->userdata['searchData']['parent_id'];
}else{ 
 $parent_id='';
}
?>




<!-- <div id="popup-overlay" class="popup_overlay"> 
     <div class="popup_overlay_position"> 
         <div class="popup_overlay_position_inner"> 
             <div class="popup_overlay_inner"> 
                 <div class="popup_box"> 
                     <a class="cancel" id="show_main2" href="javascript:;"><i class="fa fa-times-circle"></i></a> 
                    <div id="eMailCont"></div> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> -->


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Email Template
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active">Email Templates</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <?php 
if(!empty($this->session->flashdata('success_msg'))){
    echo message($this->session->flashdata('success_msg'),1);
    
  }else if(!empty($this->session->flashdata('error_msg'))){
    echo message($this->session->flashdata('error_msg'),2);
} ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Email Template</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="15%" align="left">Template Title</th>
                  <th width="8%" align="center">Action</th>              
                </tr>
                </thead>
                                          <tbody>
                          <?php if(count($email_template_info)>0){
                         foreach ($email_template_info as $email_template) {
                          ?>
                              <tr>
                               
                                <td align="left"><?=$email_template->title?></td>
                                <td align="center" class="action"><a href="<?=base_url()?>administrator/email_template/edit/<?=$email_template->id?>/"><i class="fa fa-pencil"></i></a> 
                  <a href="javascript:void(0)" data-id="<?=$email_template->id?>"  class="viewEmail"><i class="fa fa-eye"></i></a>
                </td>
                              </tr>
                              <?php } ?>
                              <?php } else {?>
            <tr>
              <td align="center" colspan="5">No records found.</td>
            </tr>
              <?php } ?>
                                   
                          </tbody>
 
              </table>
                                 <?php if($no_of_page>1){ ?>
                 <?php $this->load->view('administrator/includes/pagination'); ?>
           <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>




   
 <?php $this->load->view('administrator/tpl/footer.php'); ?>

 <script> 

$(function(){
    $('.viewEmail').click(function(){      

var $this=$(this);

      var id = $(this).attr("data-id");
      console.log(id);
      $.ajax({
            type     : "POST",
            url      : "<?=base_url()?>administrator/email_template/view_template_details",
            cache    : false,
            data     : { id: id },
            success  : function(data) { 
             $.colorbox({html: data});
              
              //$('#eMailCont').html(data);
              $('body').css('overflow-y', 'hidden');
            },
            beforeSend: function(){ 
                  // $("#loadingDv").show(); 
               }, 
               complete: function(){ 
 


               }
        });
    });

      
  });
  
  
</script>