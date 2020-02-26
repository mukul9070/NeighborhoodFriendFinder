<?php
include('database_connection.php');
session_start();

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}


if (isset($_GET['state']) && isset($_GET['blockid']) && isset($_GET['username'])) {


	if($_GET['state'] == 'accept;'){

		echo $_SESSION['username']."". $_GET['state']."". $_GET['username'];

		$sql = "insert into approvalrequests values ( '".$_GET['username']."', '".$_SESSION['username']."' , '".$_GET['blockid']."', 'yes')";
		echo $sql;
		$result = mysqli_query($conn,$sql);

		echo "<script type='text/javascript'>alert('You approved friend request of ".$_GET['username']."');</script>";
	}

	if($_GET['state'] == 'reject;'){

		$sql = "insert into approvalrequests values( '".$_GET['username']."', '".$_SESSION['username']."' , '".$_GET['blockid']."', 'no')";
		echo $sql;
		$result = mysqli_query($conn,$sql);

		echo "<script type='text/javascript'>alert('You rejected friend request of ".$_GET['username']."');</script>";
	}

}
header("location:requests.php");


?>