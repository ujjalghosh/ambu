 <?php $this->load->view('administrator/tpl/header.php'); 
 //print_r($email_template_info);
 if(isset($email_template_info)){
  $email_template_id=$email_template_info->id;
  $title=$email_template_info->title;
  $template_content=$email_template_info->template_content;
  $status=$email_template_info->status;

 }else{
    $email_template_id='';
    $title='';  
    $template_content='';
    $status=1;
  
    //print_r($all_members);

 }

 ?>
 <script type="text/javascript">
 $(function(){    
    $('#email_template_form').validate({
        errorElement: "span",
        ignore:"",
            rules:
            {
                title: "required",  
                template_content: {
                    required: function() {                        
                        var template_content = tinyMCE.get('template_content').getContent();                       
                        if (template_content == ''){
                             return true;
                        }
                        else{
                             return false;
                        }
                       
                    }
                    },              
                status: "required",
            },
            messages:
            {
                title: "Please enter email template.",  
                template_content: "Please enter email template content",             
                status: "Please choose status",
                
            },
            submitHandler: function(form) {
            $('#template_content').val(tinyMCE.get('template_content').getContent());
                var formData = new FormData($(form)[0]);
                
                $.ajax({
                    type     : "POST",
                    cache    : false,
                    contentType: false,
                    processData: false,
                    url      : form.action,
                    dataType : 'json',
                    data     : formData,
                    success  : function(data) {
                        console.log(data);
                        if(data.success==0){
                            $('#message_show').html(data.error_message);
                          
                        }else{
                            $('#message_show').html(data.success_message);
                            if(data.action == 'add'){
                                $("#email_template_form")[0].reset();     
                            }
                            if(data.action == 'update'){
                                location.href='<?=base_url()?>admin/email_template/'
                            }
                            
                            
                        }
                        
                    },
                   beforeSend: function(){
                       $(".loadingSpan").show(); 
                   }, 
                   complete: function(){ 
                       $(".loadingSpan").hide(); 
                   }
                });
            }
    });

    
      

 });


 </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Email Templates
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>administrator"><i class="fa fa-dashboard"></i> Home</a></li>
        <li ><a href="<?=base_url()?>administrator/email_template">Email Templates</a></li>
        <li class="active"><?=isset($email_template_info) ? 'Update' : 'Add'?> Email Template </li>
         
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form class="form-horizontal" role="form" name="email_template_form" id="email_template_form" method="post" action="<?=base_url()?>administrator/email_template/insert_update_email_template/">
                   <input type="hidden" name="email_template_id" id="email_template_id" value="<?=$email_template_id?>" />
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label" >Template title</label>
                  <div class="col-sm-10">
                  <input   class="form-control" name="title" id="title" type="text" value="<?=$title?>" placeholder="Title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" >Email template content</label>
                  <div class="col-sm-10">
                 <textarea id="template_content" name="template_content" class="editor">
                                <?=$template_content?>           
                    </textarea>
                    </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" >Choose Status</label>
                   <div class="col-sm-10">
                  <select name="status" id="status">
                    <option value="">Choose Status...</option>
                    <option value="1" <?=$status==1 ? 'selected' : ''?>>Active</option>
                    <option value="0" <?=$status==0 ? 'selected' : ''?>>Inactive</option>
                </select>
                </div>
                
                </div>
      
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="<?=base_url()?>administrator/email_template/" class="btn left black"><i class="fa fa-arrow-circle-left"></i> Back</a>  
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?=isset($email_template_info) ? 'Update' : 'Add'?></button>
              </div>
            </form>
          </div>
          <!-- /.box -->



          <!-- /.box -->

        </div>

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>   <?php $this->load->view('administrator/tpl/footer.php'); ?>
  <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>