<?php
include('database_connection.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}


echo "out";
echo $_GET['state'];
if (isset($_GET['state']) && isset($_GET['username'])) {
	echo "in";
	echo $_SESSION['username']."". $_GET['state']."". $_GET['username'];


	if($_GET['state'] == 'accept;'){

		echo $_SESSION['username']."". $_GET['state']."". $_GET['username'];

		$sql = "update friends set acceptflag=1 where username1='".$_SESSION['username']."' and username2 = '".$_GET['username']."'";
		$result = mysqli_query($conn,$sql);
	}

}
header("location:requests.php");


?>