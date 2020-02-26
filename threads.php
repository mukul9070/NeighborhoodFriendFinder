<?php
include('database_connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}

include 'navbar.php';



?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<style type="text/css">
		.receivers{
			display: none;
		}
		.form-popup {
		  display: none;
		  position: fixed;
		  bottom: 0;
		  right: 15px;
		  border: 3px solid #f1f1f1;
		  z-index: 9;
		}
		* {
			  box-sizing: border-box;
			}
		
		  #myInput {
			  background-image: url('/searchicon.png');
			  background-position: 10px 12px;
			  background-repeat: no-repeat;
			  width: 50%;
			  font-size: 16px;
			  padding: 12px 20px 12px 40px;
			  border: 1px solid #ddd;
			  margin-bottom: 12px;
			}
			#threadtable {
			  border-collapse: collapse;
			  width: 70%;
			  border: 1px solid #ddd;
			  font-size: 18px;
			}

			#threadtable th, #threadtable td {
			  text-align: left;
			  padding: 12px;
			}

			#threadtable tr {
			  border-bottom: 1px solid #ddd;
			}

			#threadtable tr.header, #myTable tr:hover {
			  background-color: #f1f1f1;
			}

	</style>

	<script>

			function openForm() {
			  document.getElementById("myForm").style.display = "block";
			}

			function closeForm() {
			  document.getElementById("myForm").style.display = "none";
			}


		function myFunction() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("userthreads");
		  tr = table.getElementsByTagName("tr");
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[3];
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


</head>
<body>

	<div align="right" style="padding-right: 20%;"><button class="btn btn-info" onclick="openForm()" >Create Thread</button></div>

<div class="form-popup" id="myForm">
	<div class="panel panel-default" >
        <div class="panel-body">
        	<form method="post" name="myform" action="addthread.php">
              
	            
	            <label>Thread Subject</label>
	            <input type="text" name="subject" class="form-control" placeholder="Enter Subject"  required />

	            <label>Introduction</label>
	            <input type="text" name="body" class="form-control" placeholder="Enter Introduction"  required />


	            <label>Choose Receivers</label><br>
	            
	            <input type="radio" name="receiver" value="Block" checked> Block<br>
	            <input type="radio" name="receiver" value="Friend">Friend/s<br>
				<input type="radio" name="receiver" value="Neighbor"> Neighbor<br>


	            <button type="submit" name="create" value="create" class="btn btn-info">Create</button>
    			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>

       </div>
    </div>

</div>


    
	<h2 align="center">Threads for <?php echo $_SESSION['username']; ?></h2>
	<div align="center" width='70%'>
		<input style="text-align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search thread by body">
	</div>
	

	<div id='userthreads' align="center" width='70%'>
		

		<?php
				$sql = "select t.threadid, t.username, t.subject, t.body from thread t  join (select * from userjoinedthread 
				where username = '".$_SESSION['username']."') u on t.threadid=u.threadid and t.username = u.creator_id order by t.timestamp";
				//echo $sql;
				$result = mysqli_query($conn,$sql);


				if (!$result) {
				    printf("Error: %s\n", mysqli_error($conn));
				    exit();
				}
				
	 
				echo "<table id='threadtable'>";
				echo "<th >ThreadId</th><th>Creator ID</th> <th>Subject</th> <th>Introduction</th><th>Open Chat</th>";
				echo "<tr></tr>";

				while($row = mysqli_fetch_array($result)) {
			    
					echo "<form action='threadmessages.php' method='post'><tr>
					<td style='padding : 5px;' class = 'threadid' value = '".$row['threadid']."'>".$row['threadid']."</td>
					<td style='padding : 5px;' value = '".$row['username']."'>".$row['username']."</td>
					<td style='padding : 5px;' value = '".$row['subject']."'>".$row['subject']."</td>
					<td style='padding : 5px;' value = '".$row['body']."'>".$row['body']."</td>
					<td><input class='btn btn-info' name='submit' type='submit' value='".$row['threadid']."'></td>
					</tr></form>";


				}
				 echo "</table>";

			

		?>

	</div>
	

</body>
</html>