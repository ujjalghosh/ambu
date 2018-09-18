 <?php $this->load->view('administrator/tpl/header.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Device Track
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>administrator/"><i class="fa fa-dashboard"></i> Home</a></li>  
        <li class="active">  Device Track</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Device</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <form id="frm_device">
            <div class="col-md-6">
              <div class="form-group">

                
                <label>Device</label>
                <select id="device_id" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Select Device</option>
                  <?  
                foreach($device as $row)  
           {  ?>
            <option value="<?=$row->device_id;?>"><?=$row->device_id;?></option>

            <?   } ?>
                </select>
              </div>
              
            </div>
          </form>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
  

      </div>
  

  <!-- Map section --> 

        <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Map </h3>
            </div>
            <div class="box-body">

  <div id="map_int"></div>

            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php $this->load->view('administrator/tpl/footer.php'); ?>

<style>
  #map_int{height: 600px;}
</style>
<script> 

$(document).ready(function() {


 $(document).on('change','#device_id',function(){

 var device_id= this.value;
 jQuery('#map_int').empty();

   $.ajax({
     type: 'post',
     data: {  device_id:device_id  },
     dataType: 'json',
     url: 'administrator/map/view_map/get_device_location/',
     success: function (response) {
//console.log(response.location[0].lat);

 

  // Creating a new map
    var map = new google.maps.Map(document.getElementById("map_int"), {
          center: new google.maps.LatLng(response.location[0].lat, response.location[0].lng),
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });




    // Creating a global infoWindow object that will be reused by all markers
    var infoWindow = new google.maps.InfoWindow();

    // Looping through the JSON data
    for (var i = 0, length = response.location.length; i < length; i++) {
      var data = response.location[i],
        latLng = new google.maps.LatLng(data.lat, data.lng);

      // Creating a marker and putting it on the map
      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        title: data.title
      });

      // Creating a closure to retain the correct data, notice how I pass the current data in the loop into the closure (marker, data)
      (function(marker, data) {

        // Attaching a click event to the current marker
        google.maps.event.addListener(marker, "click", function(e) {
          infoWindow.setContent(data.title);
          infoWindow.open(map, marker);
        });


      })(marker, data);

    }

  
     }
   });



  






});


    } );
</script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBn0-gWkkO9GLdcOPlKnG2e11CywApPQyA&callback=initMap" type="text/javascript"></script>