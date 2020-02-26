<!DOCTYPE html>  
<?php

include('database_connection.php');



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
      
     
	 
$flag = 0;
if(isset ($_POST['update'])){
	  	  //echo "<script type='text/javascript'>alert('entered');</script>";

$flag=1;
}
    	  //echo "<script type='text/javascript'>alert('".$flag."');</script>";

  if($flag==1)
  {
      $sql = "select ufirstname,ulastname from user where username like '%".$_POST['firstname']."%'";
      //echo $sql;
	  //echo "<script type='text/javascript'>console.info('".$sql."');</script>";
      $result = mysqli_query($conn,$sql);
      while($row= mysqli_fetch_row($result))
	  {echo $row[0];
	  }
	  //echo "<script type='text/javascript'>alert('".$result."');</script>";
	  
  }

include 'navbar.php';

?>




<html>
    <head>   
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
.topnav input[type=text] {
  float: right;
  padding: 6px;
  border: none;
  margin-top: 8px;
  margin-right: 16px;
  font-size: 17px;
}

/* When the screen is less than 600px wide, stack the links and the search field vertically instead of horizontally */
@media screen and (max-width: 600px) {
  .topnav a, .topnav input[type=text] {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}
      </style>
    </head>  
    <body>  
        <div class="container">

      <div class="panel panel-default">
          <div class="panel-heading" align="center">Add Neighbor</div>
        <div class="panel-body">
         

          <form method="post" name="myform">
              
              
            
            <div class="col-xs-6">
              <label>Search</label>
              <input type="text" name="firstname" class="form-control"  />
            </div>
         
            <div class="form-group">
              <br>
            
              <input type="submit" name="update" class="btn btn-info" value="Submit" />
            </div>
            <p><a href="index.php" style="color:dodgerblue">Go back to Home</a></p>
            
          </form>
<div id='userthreads' align="center" width='70%'>
		

		<?php

				
				
				
	 if($flag==1){
		  $sql = "select username,ufirstname,ulastname from user where username like '%".$_POST['firstname']."%'";
		  
				$result = mysqli_query($conn,$sql);
				$count = mysqli_num_rows($result);


				if (!$result) {
				    printf("Error: %s\n", mysqli_error($conn));
				    exit();
				}

        if($count>0){
            echo "<table id='searchtable'>";
            echo "<th >Firstname</th><th >Lastname</th> <th>Add</th> ";
            echo "<tr></tr>";

            while($row = mysqli_fetch_array($result)) {
              
              $v=$row['username'];
              $sql2 = "insert into neighbors values ('".$_SESSION['username']."','$v')";
              //echo $sql2;
              
              echo "<form action='addneigh.php' method='post'><tr>
              <td style='padding : 5px;' class = 'searchtable' >".$row['ufirstname']."</td>
              <td style='padding : 5px;'>".$row['ulastname']."</td>
              
              <td><input class='btn btn-info' name='submit' type='submit' value='add' onclick='Inc()' ></td>
              </tr></form>";


            }
             echo "</table>";
        }
        else{
          echo "<h3><i>User does not exist!</i></h3>";
        }
				

	 }

		?>

	</div>
	
   
          
        </div>
      </div>
    </div>
<script>
        function Inc()
        {
        <?php
			
			$result2 = mysqli_query($conn,$sql2);
			
			//echo "<script type='text/javascript'>alert('".$_SESSION['username']."');</script>";
			
        ?>
        }
		
    </script>

    </body>  
</html>