<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #4CAF50;
}


.imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
      }

      img.avatar {
        width: 8%;
        border-radius: 50%;
      }
</style>
</head>
<body>

<ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="threads.php">Threads</a></li>
  <li><a href="add.php">Add Friends</a></li>
  <li><a href="addneigh.php">Add Neighbor</a></li>
  <li><a href="requests.php">Requests</a></li>
    <li><a href="update.php">Update Profile</a></li>
  <li style="float:right"><a class="active" href="logout.php">[ <?php echo $_SESSION['username']; ?> ]  Logout</a></li>
</ul>

</body>
</html>


