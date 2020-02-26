<!--
//login.php
project
!-->

<?php

include('database_connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$message = '';

if(isset($_SESSION['username']))
{
	header('location:index.php');
}

if(isset($_POST['signup'])){

	header('location:signup.php');
}

if (isset($_POST['login']) && $_POST['username']=='' && $_POST['password']==''){
	$message = '<label>Fields Empty</label>';

}

if(isset($_POST['login']) && $_POST['username']!='' && $_POST['password']!='')
{


		$sql = "SELECT * FROM logindetails WHERE username ='".$_POST['username']."'";
		$result = mysqli_query($conn,$sql);


	$count = $result->num_rows;
	if($count > 0)
	{
		while($row = mysqli_fetch_array($result)) {

			if(MD5($_POST["password"])== $row["password"])
			{
				
				$_SESSION['username'] = $row['username'];
				
				echo $_SESSION['username'];
				echo "yolo";

				header('location:index.php');
			}
			else
			{
				$message = '<label>Wrong Password</label>';
			}
		}
	}
	else
	{
		$message = '<label>Wrong Username</label>';
	}
}



?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



  		<style type="text/css">
  			
  			.imgcontainer {
			  text-align: center;
			  margin: 24px 0 12px 0;
			}

			img.avatar {
			  width: 12%;
			  border-radius: 50%;
			}
			.container {
				width: 50%;
			  padding: 16px;
			}
  		</style>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<br />
			<div class="panel panel-default">
  				<div class="panel-heading" align="center">Web Chat Application</div>
				<div class="panel-body">
					<p class="text-danger"><?php echo $message; ?></p>

					<form method="post">
							
							<div class="imgcontainer">
							    <img src="avatar.png" alt="Avatar" class="avatar">
							  </div>
						<div class="form-group">
							<label>Enter Username</label>
							<input type="text" name="username" class="form-control" placeholder="Enter Username"  />
						</div>
						<div class="form-group">
							<label>Enter Password</label>
							<input type="password" name="password" class="form-control" placeholder="Enter Password"  />
						</div>
						<div class="form-group">
							<input type="submit" name="login" class="btn btn-info" value="Login" />
							&nbsp;&nbsp;&nbsp;&nbsp;
						
							<input type="submit" name="signup" class="btn btn-info" value="SignUp" />
						</div>
						
					</form>
					
				</div>
			</div>
		</div>


    </body>  
</html>