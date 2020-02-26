<?php
include 'database_connection.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
	header("location:login.php");
}
include 'navbar.php';
include 'threadmessages2.php';


if(!isset($_SESSION['username']))
{
	header("location:login.php");
}


if(isset($_POST['send']) && $_POST['replymessage']!=''){

$sql = "insert into threadmessages values ('".$_SESSION['username']."',NOW(), '".$_POST['replymessage']."','".$_SESSION['threadid']."')";
$result = mysqli_query($conn,$sql);
echo "<meta http-equiv='refresh' content='0'>";
}


/*
$page = $_SERVER['PHP_SELF'];
$sec = "10";
header("Refresh: $sec; url=$page");
*/
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="jquery-3.4.1.js"></script>

	</script>
</head>
<body>


</body>
</html>