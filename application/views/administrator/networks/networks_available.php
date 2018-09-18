 <?php $this->load->view('administrator/tpl/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Available Network 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active">Available Network</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Available Network</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>new_network_id</th>
                  <th>Network Name</th>
                  <th>Institution Name</th>
                  <th>City</th>
                  <th>Email</th>                  
                  <th>Network Type</th> 
                  <th>Network Status</th> 
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
      <div class="modal-dialog">  
           <form method="post" id="user_form">  
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add User</h4>  
                     </div>  
                     <div class="modal-body">  
 
                    <div class="form-group">
                      <label for="demo_name">Network Name:</label>
                      <input type="text" class="form-control" readonly name="demo_name" id="demo_name">
                    </div>
                    <div class="form-group">
                      <label for="demo_institute_name">Institute Name:</label>
                      <input type="text" class="form-control" readonly name="demo_institute_name" id="demo_institute_name">
                    </div>
                    <div class="form-group">
                      <label for="demo_city_name">City:</label>
                      <input type="text" class="form-control" readonly name="demo_city_name" id="demo_city_name">
                    </div>
                    <div class="form-group">
                      <label for="demo_official_mail">Official Email:</label>
                      <input type="text" class="form-control" readonly name="demo_official_mail" id="demo_official_mail">
                    </div>
                    <div class="form-group">
                      <label for="demo_phone">Phone:</label>
                      <input type="text" class="form-control" readonly name="demo_phone" id="demo_phone">
                    </div>
                     <div class="form-group">
                      <label for="demo_phone">Remarks:</label>
                      <textarea class="form-control" name="demo_remarks" id="demo_remarks"></textarea>
                    </div>
                    

                <div class="form-group">
              <label for="request_status">  Network Status:</label>
  <input type="radio" class="form-control" name="request_status"   value="Pending"/> Pending
  <input type="radio" class="form-control" name="request_status"   value="Accepted"/> Accepted
  <input type="radio" class="form-control" name="request_status"   value="Cancel"/> Cancel
              </div>

                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="demo_id" id="demo_id" /> 
                           <input type="hidden" name="action" id="action" />   
                          <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 

 <!-- Admin add to network -->
     <div id="adminModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="admin_form">  
             <input type="hidden" name="network_id" id="network_id" value="1">
            <input type="hidden" name="item" id="item" value="1">
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">Add Admin</h4>  
                     </div>  
                     <div class="modal-body">  
 
    <div class="form-group"> 
      
                <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr >
                        <th class="text-center"> S.N </th>
                        <th class="text-center">  User </th> 
                       <th><a href="javascript:void(0);" style="font-size:18px;" id="add_prefix" title="Add More "><span class="glyphicon glyphicon-plus"></span></a>
                        </th>
                        </tr>
                </thead>

                <tbody>
 
 
          <tr id='addr1'></tr>                
 
                </tbody>
       </table>
      </div>
      </div>
       </div>

 

                     </div>  
                     <div class="modal-footer">  
                          <input type="hidden" name="demo_id" id="demo_id" /> 
                           <input type="hidden" name="action" id="action" />   
                          <input type="submit" name="submit" id="submit" class="btn btn-success" value="Add" />  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div> 

 <!-- Admin emails -->
     <div id="adminmailModal" class="modal fade">  
      <div class="modal-dialog">  
           <form method="post" id="admin_form">    
                <div class="modal-content">  
                     <div class="modal-header">  
                          <button type="button" class="close" data-dismiss="modal">&times;</button>  
                          <h4 class="modal-title">  Admin list</h4>  
                     </div>  
                     <div class="modal-body">  
 
    <div class="form-group"> 
      
                <div class="col-sm-12">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" id="admin_mails">
                <thead>
                    <tr >
                        <th class="text-center"> S.N </th>
                        <th class="text-center">  Name </th> 
                        <th class="text-center">  Email </th> 
                         
                        </tr>
                </thead>

                <tbody>
 
               
 
                </tbody>
       </table>
      </div>
      </div>
       </div>

 

                     </div>  
                     <div class="modal-footer">  
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                     </div>  
                </div>  
           </form>  
      </div>  
 </div>


<link rel="stylesheet" href="<?php echo base_url('assets/administrator/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">
<script src="<?php echo base_url('assets/administrator/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<!-- DataTables -->
<script src="assets/administrator/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/jquery.dataTables.delay.min.js"></script>
<script src="assets/administrator/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/administrator/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
 <script src="assets/administrator/bower_components/datatables.net-bs/js/fnSetFilteringDelay.js"></script>
 
<!-- ./wrapper -->
  <!--   <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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
    // Setup - add a text input to each footer cell
/*    $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
  */
    // DataTable
    var table = $('#example');
 
   var dataTable =  table.dataTable( {
      "processing": true,
      "serverSide": true,
      "iDisplayLength": 10,
      "sAjaxSource": "<?php echo base_url();?>administrator/networks/Networks_available/getTable",
      "order": [[ 1, "asc" ]],
      "stripeClasses": [ 'odd-row', 'even-row' ],
      "aoColumnDefs": [
      {
       "bSortable": false,
       "aTargets": [ 7 ] ,
       "mData": "download_link",
       "mRender": function ( data, type, full ) {
        
       return '<button type="button" data-toggle="tooltip" title="Update Network" name="update" id="'+full[0]+'" class="btn btn-warning btn-xs update">Update</button>&nbsp;<button type="button" name="set_admin" id="'+full[0]+'" class="btn btn-info btn-xs set_admin" data-toggle="tooltip" title="Update Admin for network">Admin</button>&nbsp;<button type="button" name="set_admin" id="'+full[0]+'" class="btn btn-warning btn-xs view_admin_mail" data-toggle="tooltip" title="View all Admin for network">Emails</button>';
     }
       
   },
   {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
              {
                "targets": [ 4 ],
                "visible": false,
                "searchable": false
            }
   ],
        

 }).fnSetFilteringDelay(700); 

 

$(document).on('click', '.update', function(){  
           var demo_id = $(this).attr("id");  
            swal("Information", 'Functionality is under progress', "warning");
           $.ajax({  
                url:"<?php echo base_url(); ?>administrator/networks/Demo_network/fetch_single_demo_network",  
                method:"POST",  
                data:{demo_id:demo_id},  
                dataType:"json",  
                success:function(data)  
                {  
                   //  $('#userModal').modal('show');  
                     $('#demo_name').val(data.demo_name); 
                     $('#demo_institute_name').val(data.demo_institute_name);  
                     $('#demo_city_name').val(data.demo_city_name);  
                     $('#demo_official_mail').val(data.demo_official_mail);
                     $('#demo_phone').val(data.demo_phone);
                     $('#demo_remarks').html(data.demo_remarks);
                     $('input:radio[name=request_status][value='+ data.request_status + ']').iCheck('check');
                     $('.modal-title').text("Verify Network");  
                     $('#demo_id').val(demo_id);  
                     $('#action').val("Edit");  
                }  
           })  
      }); 
    $(document).on('submit', '#user_form', function(event){  
           event.preventDefault(); 
                $.ajax({  
                     url:"<?php echo base_url() . 'administrator/networks/Demo_network/demo_network_action'?>",  
                     method:'POST',  
                     data:$("#user_form").serialize(),  
                     contentType:false,  
                     processData:false,  
                     dataType:"json",  
                     success:function(data)  
                     {  
                          if (data.status==true) {
                            swal("Good job!", data.msg, "success");
                          $('#user_form')[0].reset();  
                          $('#userModal').modal('hide');  
                            dataTable.api().ajax.reload();
                         // dataTable.api().sAjaxSource.reload(); 
                          }else{
                          swal("Good job!", data.msg, "success");
                          }
                          
                     }  
                });
            }); 

    
    $(document).on('click', '.view_admin_mail', function(){  
           var    network_id = $(this).attr("id");  
            $('#network_id').val(network_id);  
                 $('.page-loader').show();
            $.ajax({  
                url:"<?php echo base_url(); ?>administrator/networks/Networks_available/fetch_admins_mail_network",  
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


    $(document).on('click', '.set_admin', function(){  
           var    network_id = $(this).attr("id");  
            $('#network_id').val(network_id);  
                 $('.page-loader').show();
            $.ajax({  
                url:"<?php echo base_url(); ?>administrator/networks/Networks_available/fetch_admins_network",  
                method:"POST",  
                data:{network_id:network_id},  
                success:function(data)  
                {   
                     //$('#adminModal').modal('show');  
                      $("#tab_logic > tbody").html(data);
                      $("select").select2();
                      var rowCount = $('#tab_logic > tbody >tr').length; 
                       jQuery('#item').val(rowCount); 
                     $('.modal-title').text("Update Admin for network");   
                     $('#action').val("Edit");  
                      $('.page-loader').hide();
                      $('#adminModal').modal('show');
                }  
           })   
      });


     
     $("#add_prefix").click(function(){
      var i=Number(jQuery('#item').val());
      Getusers(i);
      $('#addr'+i).html("<td>"+ (i) +"</td> <td><select name='user_id"+ (i) +"' id='user_id"+ (i) +"'  class='form-control select2' style='width: 100%;'  data-validation-engine='validate[required]'>  </select></td> <td><a href='javascript:void(0);'  class='remove_prefix'><span class='glyphicon glyphicon-remove'></span></a></td>");

      $('#tab_logic').append('<tr class="xx" id="addr'+(i+1)+'"></tr>');
      i++; 
       jQuery('#item').val(i);
       $("select").select2();
       jQuery(".form-horizontal").validationEngine('attach', {
      relative: true,
      overflownDIV:"#divOverflown",
      promptPosition:"topLeft"
    });
  });

     $(document).on('click', '.remove_prefix', function() {
         var trIndex = $(this).closest("tr").index(); 
             $(this).closest("tr").remove();
            
      });

    function Getusers(i)
     {
   $.ajax({
     type: 'post',
     url: '<?php echo base_url(); ?>administrator/networks/Networks_available/get_network_user',
     success: function (response) {
       document.getElementById("user_id"+i+"").innerHTML=response; 
     }
   });
}


    $(document).on('submit', '#admin_form', function(event){  
           event.preventDefault(); 
            $('.page-loader').show();
                $.ajax({  
                     url:"<?php echo base_url() . 'administrator/networks/Networks_available/admin_network_action'?>",  
                     method:'POST',  
                     data:new FormData(this),  
                     contentType:false,  
                     processData:false,  
                     dataType:"json",  
                     success:function(data)  
                     {  
                       $('.page-loader').hide();
                          if (data.status==true) {
                            swal("Success", data.msg, "success");
                            $("#tab_logic > tbody").html("");
                            jQuery('#item').val(1);
                            $('#tab_logic').append('<tr id="addr1"></tr>');
                          $('#adminModal').modal('hide');  
                           // dataTable.api().ajax.reload();
                         // dataTable.api().sAjaxSource.reload(); 
                          }else{
                          swal("Sorry", data.msg, "error");
                          }
                          
                     }  
                });
            }); 


    } );

</script>
 