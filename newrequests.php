<?php
include('database_connection.php');
session_start();

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}


if (isset($_GET['state']) && isset($_GET['username'])) {


	if($_GET['state'] == 'accept;'){

		echo $_SESSION['username']."". $_GET['state']."". $_GET['username'];

		$sql = "update friends set acceptflag=1 where username1='".$_SESSION['username']."' and username2 = '".$_GET['username']."'";
		$result = mysqli_query($conn,$sql);

		echo "<script type='text/javascript'>alert('You approved friend request of ".$_GET['username']."');</script>";
	}

	if($_GET['state'] == 'reject;'){

		$sql = "update friends set acceptflag=2 where username1='".$_SESSION['username']."' and username2 = '".$_GET['username']."'";
		$result = mysqli_query($conn,$sql);

		echo "<script type='text/javascript'>alert('You rejected friend request of ".$_GET['username']."');</script>";
	}

}
header("location:requests.php");


?>