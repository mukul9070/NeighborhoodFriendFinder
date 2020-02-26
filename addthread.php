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

if(isset($_POST['create'])){
	echo $_POST['receiver'];
	echo "<script type='text/javascript'>alert('".$_POST['receiver']."');</script>";

	$receiver  = $_POST['receiver'];

	$sql = "select latitude, longitude from user where username = '".$_SESSION['username']."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);
    $latitude = $row[0]; $longitude = $row[1]; 



	$sql = "select threadid from thread where timestamp = (select max(timestamp) from thread)";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_row($result);
    $threadval = $row[0];

    $final = substr($threadval, 0, strlen($threadval)-1).  strval(intval(substr($threadval, strlen($threadval)-1, strlen($threadval)))+1);
	echo $final;

	$sql = "insert into thread values ('".$_SESSION['username']."', '".$_POST['subject']."', NOW(), '".$_POST['body']."', ".$latitude.", ".$longitude.", '".$final."')";
	$result = mysqli_query($conn,$sql);


				if (!$result) {
				    printf("Error: %s\n", mysqli_error($conn));
				    exit();
				}
		$sql = "insert into userjoinedthread values ('".$_SESSION['username']."','".$final."')";
		$result = mysqli_query($conn,$sql);


			if($receiver == 'Block'){
				echo "inside block";

				$sql = "select blockid from userapproval where username= '".$_SESSION['username']."' and permission	=1";
				$result = mysqli_query($conn,$sql);
				$rows = [];
				while($row = mysqli_fetch_array($result))
				{
				    array_push($rows, strval($row[0]));
				}
				print_r($rows);
				foreach($rows as $block)
				{

					$sql = "select username from userapproval where blockid= '".$block."' and permission =1";
					echo $sql;
					$result = mysqli_query($conn,$sql);
					$users = [];
					while($row = mysqli_fetch_array($result))
						{
						    array_push($users, strval($row[0]));
						}
					foreach($users as $friend)
						{
						$sql = "insert into userjoinedthread values ('".$friend."','".$final."', '".$_SESSION['username']."')";
						echo $sql;
						$result = mysqli_query($conn,$sql);
						}
				}

			}
			elseif ($receiver == 'Friends') {
				# code...
				$sql = "select username2 from friends where username1= '".$_SESSION['username']."' and acceptflag=1";
				$result = mysqli_query($conn,$sql);
				$rows = [];
				while($row = mysqli_fetch_array($result))
				{
				    array_push($rows, strval($row[0]));
				}
				foreach($rows as $friend)
				{
				$sql = "insert into userjoinedthread values ('".$friend."','".$final."', '".$_SESSION['username']."')";
				echo $sql;
				$result = mysqli_query($conn,$sql);
				}
			}
			elseif($receiver == 'Neighbor'){
				# code...
				$sql = "select username2 from neighbors where username1= '".$_SESSION['username']."'";
				$result = mysqli_query($conn,$sql);
				$rows = [];
				while($row = mysqli_fetch_array($result))
				{
				    array_push($rows, strval($row[0]));
				}
				foreach($rows as $friend)
				{
				$sql = "insert into userjoinedthread values ('".$friend."','".$final."', '".$_SESSION['username']."')";
				echo $sql;
				$result = mysqli_query($conn,$sql);
				}
			}


}


header('Location: threads.php');
?>