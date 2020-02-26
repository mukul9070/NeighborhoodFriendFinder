<?php

include 'database_connection.php';
$countquery = "select `replierid`,`replytimestamp`,`threadid` from threadmessages";
$result = mysqli_query($conn,$countquery);
$count = $result->num_rows;
echo $count;
?>