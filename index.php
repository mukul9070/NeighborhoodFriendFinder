<!--
//index.php
!-->

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

echo "<h3 align='center'>Web Chat Application</h3><br/>";

include 'homepage.php';
?>

<html>  
    <head>
		

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        
        
    </head>  
    <body>  

        <div class="container">
			<br />
			
			
			
			
		</div>
		
    </body>  
</html>
