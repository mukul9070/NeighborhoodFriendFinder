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


<?php
	echo "<h2 align='center'>Pending requests:</h2>";

//update friends set `acceptflag` = 1 where username2='u3' and username1 ='u1' 
		
		$sql = "select username2 from friends where acceptflag=0 and username1='".$_SESSION['username']."'";
		$result = mysqli_query($conn,$sql);
		$numrows = mysqli_num_rows($result); 

		if($numrows ==0){
			echo "<h3 align='center'><i>No pending friend requests</i></h3>";
		}
		else{
			echo "<h3 align='center'><i>Friend requests</i></h3>";
			if (!$result) {
			    printf("Error: %s\n", mysqli_error($conn));
			    exit();
			}

			

			echo "<table align='center' id='friends' border='1px' cellspacing='0'>";
			echo "<th>Friends ID</th><th colspan='2'>Action</th> ";

			while($row = mysqli_fetch_array($result)) {
		    
				echo "<tr><td value = '".$row['username2']."'>".$row['username2']."</td>
				<td><a href='newrequests.php?username=". $row['username2'] . "&state=reject;' > reject </a></td>
				<td><a href='newrequests.php?username=". $row['username2'] . "&state=accept;'> accept </a></td>
				</tr>";


			}

			 echo "</table>";
		}

		echo "<br><br>";

		
		$sql = "select blockid from userapproval where username = '".$_SESSION['username']."' and permission=1 ";
		$result = mysqli_query($conn,$sql); 

		$rows = [];
		array_push($rows, 'Shaft');
		while($row = mysqli_fetch_array($result))
		{
		    array_push($rows, strval($row[0]));
		}
		foreach($rows as $blockname)
		{


		$sql = "select username, blockid from userapproval NATURAL JOIN blockapplyrequests where permission = 0 and applytimestamp = (select max(applytimestamp) from blockapplyrequests b where b.username = username) and blockid = '".$blockname."' ";
		$result = mysqli_query($conn,$sql);

		}
		$numrows = mysqli_num_rows($result); 
		if($numrows==0){
					echo "<h3 align='center'><i>No pending block requests</i></h3>";
				}
				else{

					echo "<h3 align='center'><i>Block requests</i></h3>";
					if (!$result) {
					    printf("Error: %s\n", mysqli_error($conn));
					    exit();
					}

					

					echo "<table align='center' id='blocks' border='1px' cellspacing='0'>";
					echo "<th>Username</th><th>Block ID</th><th colspan='2'>Action</th> ";

					while($row = mysqli_fetch_array($result)) {
				    
						echo " <tr><td value = '".$row['username']."'>".$row['username']."</td>
						<td value = '".$row['blockid']."'>".$row['blockid']."</td>
						<td><a href='newrequests2.php?blockid=".$row['blockid']."&username=". $row['username'] . "&state=reject;' > reject </a></td>
						<td><a href='newrequests2.php?blockid=".$row['blockid']."&username=". $row['username'] . "&state=accept;'> accept </a></td>
						</tr>";


					}

					 echo "</table>";
				}
		


		

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		
		#friends ,#blocks {
			  border-collapse: collapse;
			  width: 50%;
			  border: 1px solid #ddd;
			  font-size: 18px;
			}

			#friends th, #friends td,#blocks th,#blocks td {
			  text-align: left;
			  padding: 12px;
			}

			#friends tr ,#blocks tr{
			  border-bottom: 1px solid #ddd;
			}

			#friends tr.header, #friends tr:hover ,#blocks tr.header, #blocks tr:hover {
			  background-color: #f1f1f1;
			}
	</style>
</head>
<body>

<div id='divToShow' align="center">


</div>

</body>
</html>
