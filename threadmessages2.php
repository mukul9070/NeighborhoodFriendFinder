<?php
include 'database_connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}
$flag=1;


		$sql = "select subject from thread where threadid = '".$_SESSION['threadid']."'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_row($result);

		echo "<h2 align='center' >Subject: ". $row[0]."</h2>";

echo "<a href='threads.php'> <- Back to threads Page</a>";

if (isset($_SESSION['threadid']) && $flag){
	$flag=0;
	#unset($_POST['send']);
	$idval= $_SESSION['threadid'];

	$sql = "select replierid, body from threadmessages where threadid='".$idval."' order by replytimestamp";
				$result = mysqli_query($conn,$sql);


				if (!$result) {
				    printf("Error: %s\n", mysqli_error($conn));
				    exit();
				}

		echo "<div align='center' width='70%'>
				<input style='text-align:center;' type='text' id='myInput' onkeyup='myFunction()' placeholder='Search message'>
			</div>";

				echo "<table id='messagetable' align='center'>";
				//echo "<div align='center'>";

				while($row = mysqli_fetch_array($result)) {
					//echo "<div style='height:10px; width:100%; clear:both;'></div>";

					if($row['replierid'] == $_SESSION['username'] ){
						echo "<tr><td><div style='height:10px; width:100%; clear:both;'></div></td></tr>";
						echo "<tr><td><div align='right' style='width:100%;border-style: outset;'>".$row['body']."</div></td></tr>";
					}
					else{
						echo "<tr><td><div style='height:10px; width:100%;'><p align='left'><b>". $row['replierid']."</b></p></div></td></tr>";
						echo "<tr><td><div style='border-style: outset;width:100%;'><p align='left'>".$row['body']."</p></div></td></tr>";
					}

			}

				 echo "</table>";
		

			echo "<div style='height:10px; width:100%; clear:both;'></div>";


 
	echo "<div align='center'>
	<form action='messagetodb.php' method='post' style='width:40%; border-style: solid;padding : 5px;'>
			  <fieldset>
			    <legend>Reply</legend>
			    <input type='text' name='replymessage'  style='width: 440px;'>
			    <input class='btn btn-info' type='submit' name='send' value='Send'>
			    <div style='height:10px; width:100%; clear:both;'></div>
			  </fieldset>
			</form> </div>";

	if(isset($_POST['send'])){
		$flag=1;
	}

}
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		* {
			  box-sizing: border-box;
			}
			#myInput {
			  background-image: url('/searchicon.png');
			  background-position: 10px 12px;
			  background-repeat: no-repeat;
			  width: 30%;
			  font-size: 16px;
			  padding: 12px 20px 12px 40px;
			  border: 1px solid #ddd;
			  margin-bottom: 12px;
			}
		#messagetable {
			text-align: center;
			  border-collapse: collapse;
			  width: 50%;
			  border: 1px solid #ddd;
			  font-size: 18px;
			}

			#messagetable th, #myTable td {
			  text-align: left;
			  padding: 12px;
			}

			#messagetable tr {
			  border-bottom: 1px solid #ddd;
			}

			#messagetable tr.header, #myTable tr:hover {
			  background-color: #f1f1f1;
			}
	</style>
	<script>
		function myFunction() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("messagetable");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[0];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
		      }
		    }       
		  }
		}
	</script>
</head>
<body>
	
</body>
</html>