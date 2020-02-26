<?php

//logout.php
include 'database_connection.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}


$sql = "update logindetails set lastlogout = NOW() where username = '".$_SESSION['username']."'";
echo $sql;
echo "<script type='text/javascript'>alert('".$sql."');</script>";
$result = mysqli_query($conn,$sql);



session_destroy();

header('location:login.php');

?>