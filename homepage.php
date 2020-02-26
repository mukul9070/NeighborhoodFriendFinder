<?php
include('database_connection.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['username']))
{
  header("location:login.php");
}

?>



<html>  
    <head>  
        <title>Web Chat Application Home Page</title>  
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
	  /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}


      </style>
    </head>  
    <body>  

        <div class="container">
		
			 <div class="tab">
          <button class="tablinks" onclick="openCity(event, 'Neighbours')">Neighbours</button>
          <button class="tablinks" onclick="openCity(event, 'Friends')">Friends</button>
          <button class="tablinks" onclick="openCity(event, 'Block')">Block</button>
        </div>

<!-- Tab content -->
<div id="Neighbours" class="tabcontent">
  <h3>Neighbours</h3>
 
    <h2 align="center">Threads for <?php echo $_SESSION['username']; ?></h2>
    <div align="center" width='70%'>
      <input style="text-align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search thread by body">
    </div>
    

    <div id='userthreads' align="center" width='70%'>
      

      <?php
          $sql = "select t.threadid, t.username, t.subject, t.body from thread t  join (select * from userjoinedthread 
          where username = '".$_SESSION['username']."') u on t.threadid=u.threadid and t.username = u.creator_id order by t.timestamp";
          //echo $sql;
          $result = mysqli_query($conn,$sql);


          if (!$result) {
              printf("Error: %s\n", mysqli_error($conn));
              exit();
          }
          
     
          echo "<table id='threadtable'>";
          echo "<th >ThreadId</th><th>Creator ID</th> <th>Subject</th> <th>Introduction</th><th>Open Chat</th>";
          echo "<tr></tr>";

          while($row = mysqli_fetch_array($result)) {

            $sqll = "select * from neighbors where username1 = '".$_SESSION['username']."' and username2='".$row['username']."'";
            $result1 = mysqli_query($conn,$sqll);
            $row1 = mysqli_fetch_array($result1);
            if($row1){
              echo "<form action='threadmessages.php' method='post'><tr>
            <td style='padding : 5px;' class = 'threadid' value = '".$row['threadid']."'>".$row['threadid']."</td>
            <td style='padding : 5px;' value = '".$row['username']."'>".$row['username']."</td>
            <td style='padding : 5px;' value = '".$row['subject']."'>".$row['subject']."</td>
            <td style='padding : 5px;' value = '".$row['body']."'>".$row['body']."</td>
            <td><input class='btn btn-info' name='submit' type='submit' value='".$row['threadid']."'></td>
            </tr></form>";
            }

          }
           echo "</table>";


      ?>

    </div>
</div>

<div id="Friends" class="tabcontent">
      <h3>Friends</h3>
      <h2 align="center">Threads for <?php echo $_SESSION['username']; ?></h2>
      <div align="center" width='70%'>
        <input style="text-align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search thread by body">
      </div>
      

      <div id='userthreads' align="center" width='70%'>
        

        <?php
            $sql = "select t.threadid, t.username, t.subject, t.body from thread t  join (select * from userjoinedthread 
            where username = '".$_SESSION['username']."') u on t.threadid=u.threadid and t.username = u.creator_id order by t.timestamp";
            //echo $sql;
            $result = mysqli_query($conn,$sql);


            if (!$result) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
            
       
            echo "<table id='threadtable'>";
            echo "<th >ThreadId</th><th>Creator ID</th> <th>Subject</th> <th>Introduction</th><th>Open Chat</th>";
            echo "<tr></tr>";

            while($row = mysqli_fetch_array($result)) {

              $sqll = "select acceptflag from friends where username1 = '".$_SESSION['username']."' and username2='".$row['username']."'";
              $result1 = mysqli_query($conn,$sqll);
              $row1 = mysqli_fetch_array($result1);
              if($row1[0]==1){
                echo "<form action='threadmessages.php' method='post'><tr>
              <td style='padding : 5px;' class = 'threadid' value = '".$row['threadid']."'>".$row['threadid']."</td>
              <td style='padding : 5px;' value = '".$row['username']."'>".$row['username']."</td>
              <td style='padding : 5px;' value = '".$row['subject']."'>".$row['subject']."</td>
              <td style='padding : 5px;' value = '".$row['body']."'>".$row['body']."</td>
              <td><input class='btn btn-info' name='submit' type='submit' value='".$row['threadid']."'></td>
              </tr></form>";
              }

            }
             echo "</table>";

          

        ?>

      </div>
</div>

<div id="Block" class="tabcontent">
  <h3>Block</h3>
  <h2 align="center">Threads for <?php echo $_SESSION['username']; ?></h2>
    <div align="center" width='70%'>
      <input style="text-align:center;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search thread by body">
    </div>
    

    <div id='userthreads' align="center" width='70%'>
      

      <?php
          $sql = "select t.threadid, t.username, t.subject, t.body from thread t  join (select * from userjoinedthread 
          where username = '".$_SESSION['username']."') u on t.threadid=u.threadid and t.username = u.creator_id order by t.timestamp";
          //echo $sql;
          $result = mysqli_query($conn,$sql);


          if (!$result) {
              printf("Error: %s\n", mysqli_error($conn));
              exit();
          }
          
     
          echo "<table id='threadtable'>";
          echo "<th >ThreadId</th><th>Creator ID</th> <th>Subject</th> <th>Introduction</th><th>Open Chat</th>";
          echo "<tr></tr>";

          while($row = mysqli_fetch_array($result)) {

            $sqll = "select blockid from userapproval where username = '".$_SESSION['username']."' and permission=1";
            $result1 = mysqli_query($conn,$sqll);
            $row1 = mysqli_fetch_array($result1);

          $sqll2 = "select blockid from userapproval where username = '".$row['username']."' and permission=1";
            $result2= mysqli_query($conn,$sqll2);
            $row2= mysqli_fetch_array($result2);



            if($row1[0]==$row2[0]){
              echo "<form action='threadmessages.php' method='post'><tr>
            <td style='padding : 5px;' class = 'threadid' value = '".$row['threadid']."'>".$row['threadid']."</td>
            <td style='padding : 5px;' value = '".$row['username']."'>".$row['username']."</td>
            <td style='padding : 5px;' value = '".$row['subject']."'>".$row['subject']."</td>
            <td style='padding : 5px;' value = '".$row['body']."'>".$row['body']."</td>
            <td><input class='btn btn-info' name='submit' type='submit' value='".$row['threadid']."'></td>
            </tr></form>";
            }

          }
           echo "</table>";


      ?>

    </div>
</div>
      
    </div>
	<script>
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
    </body>  
</html>