 <?php $this->load->view('administrator/tpl/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Request for Network 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active">Request Network</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Request for Network</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>request_id</th>
                  <th>Network Name</th>
                  <th>Institute Name</th>
                  <th>Location</th>
                  <th>Passing Year</th>
                  <th>User Institute</th>
                  <th>User City</th>
                  <th>User Country</th>   
                  <th>Status</th> 
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


      <div id="userModal" class="modal fade">  
      <div class="modal-dialog modal-lg">  
                <section class="content">
                      <div class="row">
                      <div class="col-md-12">
           <form method="post" id="user_form" class="form-horizontal">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add Network</h4>  
                     </div>  
                     <div class="modal-body">               
 
                      <div class="form-row form-group">
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_name">Request Name:</label>
                    <input type="text" class="form-control" readonly name="request_name" id="request_name">
                          </div>
                        </div>
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_institute">Request Institute:</label>
                      <input type="text" class="form-control" readonly name="request_institute" id="request_institute">
                          </div>
                        </div>
                      </div>

                        <div class="form-row form-group">
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_location">Location:</label>
                    <input type="text" class="form-control" readonly name="request_location" id="request_location">
                          </div>
                        </div>
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_year_of_passing">Passing year of Requester:</label>
                      <input type="text" class="form-control" readonly name="request_year_of_passing" id="request_year_of_passing">
                          </div>
                        </div>
                      </div>

                       <div class="form-row form-group">
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_name">Requester Name:</label>
                    <input type="text" class="form-control" readonly name="request_user_name" id="request_user_name">
                          </div>
                        </div>
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_institute">Requester Institute:</label>
                      <input type="text" class="form-control" readonly name="request_user_institute" id="request_user_institute">
                          </div>
                        </div>
                      </div>

                                             <div class="form-row form-group">
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_city">Requester City:</label>
                    <input type="text" class="form-control" readonly name="request_user_city" id="request_user_city">
                          </div>
                        </div>
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_country">Requester Country:</label>
                      <input type="text" class="form-control" readonly name="request_user_country" id="request_user_country">
                          </div>
                        </div>
                      </div>

                                             <div class="form-row form-group">
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_mail">Requester E-mail:</label>
                    <input type="text" class="form-control" readonly name="request_user_mail" id="request_user_mail">
                          </div>
                        </div>
                        <div class="col">
                          <div class="col-sm-6">
                          <label for="request_user_phone">Requester Phone:</label>
                      <input type="text" class="form-control" readonly name="request_user_phone" id="request_user_phone">
                          </div>
                        </div>
                      </div>
                    

                <div class="form-group">
                  <div class="col">
                          <div class="col-sm-6">
              <label for="request_status">  Network Status:</label>
  <input type="radio" class="form-control" name="request_status"   value="Pending"/> Pending
  <input type="radio" class="form-control" name="request_status"   value="Accepted"/> Accepted
  <input type="radio" class="form-control" name="request_status"   value="Cancel"/> Cancel
              </div>
              </div>
              </div>

                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="request_id" id="request_id" /> 
                           <input type="hidden" name="action" id="action" />   
                          <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 
</section>
 </div>  
 </div> 






  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <link rel="stylesheet" href="<?php echo base_url('assets/administrator/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
<script src="<?php echo base_url('assets/administrator/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- DataTables -->
<script src="assets/administrator/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/jquery.dataTables.delay.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/fnSetFilteringDelay.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/administrator/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>

<!-- ./wrapper -->
   <!--  <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js" type="text/javascript"></script> -->

<!-- page script -->
<script>
 

$(document).ready(function() {
    // DataTable
    var table = $('#example');

    var dataTable =   table.dataTable( {
      "processing": true,
      "serverSide": true,
      "iDisplayLength": 10,
      "sAjaxSource": "<?php echo base_url();?>administrator/networks/request_network/getTable",
      "order": [[ 1, "asc" ]],
      "stripeClasses": [ 'odd-row', 'even-row' ],
      "aoColumnDefs": [
      {
       "bSortable": false,
       "aTargets": [ 9 ] ,
       "mData": "download_link",
       "mRender": function ( data, type, full ) { 
       return '<button type="button" name="update" id="'+full[0]+'" class="btn btn-warning btn-xs update">Update</button';
     }       
   },
   {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
   ], 

 }).fnSetFilteringDelay(700);;



$(document).on('click', '.update', function(){  
           var request_id = $(this).attr("id");  
           $.ajax({  
                url:"<?php echo base_url(); ?>administrator/networks/request_network/fetch_single_request_network",  
                method:"POST",  
                data:{request_id:request_id},  
                dataType:"json",  
                success:function(data)  
                {  
                     $('#userModal').modal('show');  
                     $('#demo_name').val(data.demo_name); 
                     $('#request_id').val(data.request_id);  
                     $('#request_name').val(data.request_name);  
                     $('#request_institute').val(data.request_institute);
                     $('#request_location').val(data.request_location);
                     $('#request_year_of_passing').val(data.request_year_of_passing);

                     $('#request_user_name').val(data.request_user_name); 
                     $('#request_user_institute').val(data.request_user_institute);  
                     $('#request_user_city').val(data.request_user_city);  
                     $('#request_user_country').val(data.request_user_country);
                     $('#request_user_mail').val(data.request_user_mail);
                     $('#request_user_phone').val(data.request_user_phone);
                     $('input:radio[name=request_status][value='+ data.request_status + ']').iCheck('check');                      
                     $('.modal-title').text("Request Network");  
                     $('#action').val("Edit");  
                }  
           })  
      }); 
    $(document).on('submit', '#user_form', function(event){  
           event.preventDefault(); 
                $.ajax({  
                     url:"<?php echo base_url() . 'administrator/networks/Request_network/request_network_action'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     dataType:"json",  
                     success:function(data)  
                     {  
                          if (data.status==true) {
                              swal("Good job!", data.msg, "success");
                           // alert(data.msg);
                          $('#user_form')[0].reset();  
                          $('#userModal').modal('hide');  
                            dataTable.api().ajax.reload(); 
                          }else{
                              swal("Good job!", data.msg, "error");
                          //alert(data.msg);
                          }
                          
                     }  
                });
            }); 


} );



</script>