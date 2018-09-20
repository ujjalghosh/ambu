 <?php $this->load->view('administrator/tpl/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available Service 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active">Available Service</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12"> 
          <div class="box">
            <div class="box-header">              
              <button type="button"  class="btn btn-info pull-left " data-toggle="modal" data-target="#add_service_mod">Add Service</button>

            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>service_id</th>
                  <th>Service Name</th> 
                  <th>Service Status</th> 
                  <th>Option</th>                 
                </tr>
                </thead>


              </table>
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
  <!-- /.content-wrapper -->
   <?php $this->load->view('administrator/tpl/footer.php'); ?>

    <div id="add_service_mod" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <form method="post"   id="service_form" class="form-horizontal" >  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add User</h4>  
                     </div>  
                     <div class="modal-body">  
                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="col-md-3 control-label" for="service_name">Service Name:</label>
                      <div class="col-md-9">
                      <input type="text" class="form-control" data-validation-engine="validate[required]" name="service_name" id="service_name">
                    </div>
                    </div>
                   

                <div class="form-group">
              <label class="col-md-3 control-label" for="service_status">  Service Status:</label>
              <div class="col-md-9">
  <input type="radio" class="form-control" name="service_status" checked="checked"  value="Active"/> Active
  <input type="radio" class="form-control" name="service_status"   value="Inactive"/> Inactive
</div>
     </div>

                     </div>  

                   </div>
                     <div class="modal-footer">  
                          <input type="hidden" value="0" name="service_id" id="service_id" /> 
                           <input type="hidden" name="action" id="action" value="Add" />   
                          <input type="submit" name="submit" id="submit" class="btn btn-success" value="Save" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 





<link rel="stylesheet" href="<?php echo base_url('assets/administrator/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
<!-- DataTables -->
<script src="assets/administrator/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/jquery.dataTables.delay.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/administrator/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
 <script src="assets/administrator/bower_components/datatables.net-bs/js/fnSetFilteringDelay.js"></script>

<script> 

$(document).ready(function() { 
    // DataTable
    var table = $('#example');
 
   var dataTable =  table.dataTable( {
      "processing": true,
      "serverSide": true,
      "iDisplayLength": 10,
      "sAjaxSource": "<?php echo base_url();?>administrator/master/services/getTable",
      "order": [[ 1, "asc" ]],
      "stripeClasses": [ 'odd-row', 'even-row' ],
      "aoColumnDefs": [
      {
       "bSortable": false,
       "aTargets": [ 3 ] ,
       "mData": "download_link",
       "mRender": function ( data, type, full ) {
        if(full[2]=='Inactive'){
         var atbu='active';
       }else{var atbu='inactive';}
        
       return '<a class="update" data-id="'+full[0]+'" href="javascript:void(0);" title="Edit"><i class="fa fa-fw fa-edit"></i></a> <a href="javascript:void(0);" onclick="service_update('+full[0]+',\''+atbu+'\',\'<?php echo base_url('administrator/master/services/change_status/')?>\')" title="Change Status"><i class="fa fa-fw fa-lightbulb-o '+atbu+'"></i></a> <a href="javascript:del('+full[0]+',\'manage_product_category.php\',\'Size\')" title="Delete"><i class="fa fa-fw fa-close"></i></a>  ';
     }
       
   },
   {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
   ],
        

 }).fnSetFilteringDelay(700); 

 

$(document).on('click', '.update', function(){  
           var service_id = $(this).data("id"); 

           console.log(service_id);
           $.ajax({  
                url:"<?php echo base_url(); ?>administrator/master/services/fetch_single_service/",  
                method:"POST",  
                data:{service_id:service_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#add_service_mod').modal('show');  
                     $('#service_name').val(data.service_name);  
                     $('input:radio[name=service_status][value='+ data.service_status + ']').iCheck('check');
                     $('.modal-title').text("Update Service");  
                     $('#service_id').val(service_id);  
                     $('#action').val("Edit");  
                }  
           })  
      }); 

    $(document).on('submit', '#service_form', function(event){  
           event.preventDefault();
           if (jQuery('#service_form').validationEngine('validate') == true) {  
            var formData = new FormData(jQuery('#service_form')[0]);

$.ajax({
type     : "POST",
cache    : false,
contentType: false,
processData: false,
url      : '<?php echo base_url('administrator/master/services/service_add_edit/')?>',
dataType : 'json',
data     : formData,
success  : function(data) {
if (data.status==true) {
swal('success',  data.msg,  'success');
jQuery('#add_service_mod').modal('hide');
dataTable.api().ajax.reload();
$('#action').val("Add");
jQuery("#service_form")[0].reset();
}
if (data.status==false) {
  var form = jQuery('#service_form');
$.each(data.errors, function(key, val) {
jQuery('[name="'+ key +'"]', form).after(val);
jQuery('[name="'+ key +'"]', form).css('color', 'red');
jQuery('[name="'+ key +'"]', form).focus();
});
swal('Sorry',  data.msg,  'error');
}

},
beforeSend: function(){
//jQuery(".page-loader").show();
},
complete: function(){
//setTimeout(function() {   jQuery(".page-loader").hide();  }, 1000);

}
});
 
            }
            });  

    
    $(document).on('click', '.view_admin_mail', function(){  
           var    network_id = $(this).attr("id");  
            $('#network_id').val(network_id);  
                 $('.page-loader').show();
            $.ajax({  
                url:"<?php echo base_url(); ?>administrator/networks/Services_available/fetch_admins_mail_network",  
                method:"POST",  
                data:{network_id:network_id},  
                success:function(data)  
                {   
                      
                      $("#admin_mails > tbody").html(data);  
                      $('.page-loader').hide();
                      $('#adminmailModal').modal('show');
                }  
           })   
      });

 


    } );


$(document).ready(function() { 

 del=  function(aa,bb,cc) {
  bs=aa.replace(/\b0+/g, "");
  var a = confirm("Are you sure, you want to delete this " + cc + "?");
  if (a) {
    location.href = bb + "?cid=" + bs + "&action=delete";
  }
}

 

service_update = function(aa, bb, cc){

  var k = status_update(aa, bb, cc);
console.log(k);
  if(k==true){
    dataTable.api().ajax.reload();
  }

}

  } );
</script>
 