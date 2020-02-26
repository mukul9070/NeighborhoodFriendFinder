<?php
include('database_connection.php');



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
		
		include 'navbar.php';
		

		if(isset($_POST['submit'])){
			$_SESSION['threadid'] = $_POST['submit'];
		}
?>


<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>

	<script src="jquery-3.4.1.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>


	<div id='threadmessages'>
		<?php
		include 'threadmessages2.php';
		?>

	</div>
</body>
</html>

