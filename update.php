<!DOCTYPE html>  
<?php

include('database_connection.php');



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


 
      
     $sql = "select * from user where username= '".$_SESSION['username']."'";
      //echo $sql;
      $result = mysqli_query($conn,$sql);
	  
while ($row = mysqli_fetch_row($result)) {
$firstname= $row[1];
$lastname= $row[2];
$intro=$row[6];
	 $street= $row[3];
	 $city=$row[4];
	 $code=$row[5];
	 $add=$street.",".$city.",".$code;
	 }
	 
$flag = 0;
if(isset ($_POST['update'])){
	  	  echo "<script type='text/javascript'>alert('entered');</script>";

if( $_POST['street']!='' && $_POST['city']!=''
&& $_POST['postalcode']!='' && $_POST['introduction']!='' && $_POST['firstname']!='' && $_POST['lastname']!='')
{

  	  //echo "<script type='text/javascript'>alert('entered');</script>";

    $flag = 1;
}
}
    	  //echo "<script type='text/javascript'>alert('".$flag."');</script>";

  if($flag==1)
  {
      $sql = "update user set ufirstname='".$_POST['firstname']."',ulastname='".$_POST['lastname']."',street= '".$_POST['street']."',city='".$_POST['city']."',postalcode=".$_POST['postalcode'].",
	  introduction='".$_POST['introduction']."',latitude='".$_POST['latitude']."',longitude='".$_POST['longitude']."' where username= '".$_SESSION['username']."'";
      echo $sql;
	  //echo "<script type='text/javascript'>console.info('".$sql."');</script>";
      $result = mysqli_query($conn,$sql);
      echo $result;
	  //echo "<script type='text/javascript'>alert('".$result."');</script>";
	  
  }



      //echo "<script type='text/javascript'>alert('".$result."');</script>";


      //echo "<script type='text/javascript'>alert('Signed Up Successfully!');</script>";

    
    


include 'navbar.php';

?>




<html>
    <head>  
        <title>Web Chat Application Sign Up</title>  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 
    


      <style type="text/css">
        
        .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
      }

      img.avatar {
        width: 12%;
        border-radius: 50%;
      }
      .container {
        width: 50%;
        padding: 16px;
      }
	   .container1 {
        width: 100%;
		height: 500px;
        padding: 16px;
      }
	  #map-canvas {
  margin: 0;
  padding: 0;
  height: 100%;
}
 .button {

width:100%;
}
      </style>
    </head>  
    <body>  
        <div class="container">

      <div class="panel panel-default">
          <div class="panel-heading" align="center">Update Details</div>
        <div class="panel-body">
         

          <form method="post" name="myform">
              
              <div class="imgcontainer">
                  <img src="avatar.png" alt="Avatar" class="avatar">
                </div>
            
            <div class="col-xs-6">
              <label>Firstname</label>
              <input type="text" name="firstname" class="form-control" value=<?php echo $firstname;?> />
            </div>
            <div class="col-xs-6">
              <label>Lastname</label>
              <input type="text" name="lastname" class="form-control"  value=<?php echo $lastname;?> />
            </div>
          
            
            
			 
            <div class="form-group">
              <label>Introduction</label>
              <input type="text" name="introduction" class="form-control" placeholder="Enter small Introduction" value=<?php echo $intro;?> />
            </div>
			 <input type="hidden"  name="street" >
			 <input type="hidden"  name="city" >
			 <input type="hidden"  name="postalcode" >
			  <input type="hidden"  name="latitude" >
			   <input type="hidden"  name="longitude" >
			
			<div class="form-group"> 
		<label>Address</label>
		<!-- search box -->
		<div >
			<input type="text" id="address" class="form-control"  /> 
      <br>
      <input type="button" class="btn btn-info" value="Find" onClick="search()"/>
		</div>
    
	</div> 
	<div id="map" class="container1"></div>
					 
					   
		   <script>

      var map;
	  var markers = [];
      function initMap() {
		  var myLatlng = {lat: 40.6782, lng: -73.9442};
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 40.6782, lng: -73.9442},
          zoom: 12
        });
		var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title: 'Click to zoom'
  });

  

  marker.addListener('click', function() {
    map.setZoom(12);
    map.setCenter(marker.getPosition());
  });
  markers.push(marker);
  google.maps.event.addListener(map,'click',function(event) {
    console.info(event.latLng.lat());  // print lat of click pos
    console.info(event.latLng.lng());  
	myLatlng={lat:event.latLng.lat(),lng:event.latLng.lng()};
			 for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
	marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title: 'Click to zoom'
  });
  markers.push(marker);// print lng of click pos
});
var geocoder = new google.maps.Geocoder();

google.maps.event.addListener(map, 'click', function(event) {
  geocoder.geocode({
    'latLng': event.latLng
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        alert(results[0].formatted_address);
				var a=results[0].address_components;
		
		document.forms["myform"]["postalcode"].value=a[a.length-1].long_name;
		document.forms["myform"]["street"].value=a[2].long_name;
		document.forms["myform"]["city"].value=a[a.length-5].long_name;
		document.forms["myform"]["latitude"].value=results[0].geometry.location.lat();
		document.forms["myform"]["longitude"].value=results[0].geometry.location.lng();
      }
    }
  });
});

 
 
 }
 

	function search() 
{var geocoder = new google.maps.Geocoder();
      
	var address = $('#address').val();
	
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) 
		{
			map.setCenter(results[0].geometry.location);
		 for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
		
		var a=results[0].address_components;
		//alert(a[a.length-2].long_name));
		<!--alert(results[0].geometry.location.Qa);-->
		document.forms["myform"]["postalcode"].value=a[a.length-1].long_name;
		document.forms["myform"]["street"].value=a[2].long_name;
		document.forms["myform"]["city"].value=a[a.length-5].long_name;
		document.forms["myform"]["latitude"].value=results[0].geometry.location.lat();
		document.forms["myform"]["longitude"].value=results[0].geometry.location.lng();
		<!--document.forms["myform"]["street"].value=address[address.length-1];-->
			var marker = new google.maps.Marker({
				map: map, 
				position: results[0].geometry.location
			});
			markers.push(marker);
		} 
		else 
		{
			alert("Geocode was not successful for the following reason: " + status);
		}
	});
}  
	 
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRksSfjkrMR9-2ReTI0KcGXZERJsMGMWc&callback=initMap"
    ></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRksSfjkrMR9-2ReTI0KcGXZERJsMGMWc&v=3.exp&sensor=false&libraries=places&callback=initMap"></script>



            <div class="form-group">
              <br>
            
              <input type="submit" name="update" class="btn btn-info" value="Update" />
            </div>
            <p><a href="index.php" style="color:dodgerblue">Go back to Home</a></p>
            
          </form>

   
          
        </div>
      </div>
    </div>


    </body>  
</html>