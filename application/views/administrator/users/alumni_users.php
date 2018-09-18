 <?php $this->load->view('administrator/tpl/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni Users
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active"> Alumni Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Alumni Registered Users</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body  table-responsive">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>user_id</th>
                  <th>First Name</th>
                  <th>Middle Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Oauth Provider</th>
                  <th>Password</th>
                  <th>DOB</th>
                  <th>Gender</th>                  
                  <th>Country</th> 
                  <th>Pincode</th>  
                  <th>City</th>                
                  <th>Phone No</th>
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
   var table = $('#example'); 
   var dataTable =  table.dataTable( {
      "processing": true,
      "serverSide": true,
      "iDisplayLength": 12,
      "sAjaxSource": "<?php echo base_url();?>administrator/users/Network_users/getALl_user_Table",
      "order": [[ 0, "asc" ]],
      "stripeClasses": [ 'odd-row', 'even-row' ],
      "aoColumnDefs": [
      {
       "bSortable": false,
       "aTargets": [ 12 ] 
       
   },
   {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
   ],
        

 }).fnSetFilteringDelay(700); 
    } );
</script>