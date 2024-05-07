<?php
     include("_includes/config.inc");
     include("_includes/dbconnect.inc");
     include("_includes/functions.inc");
    header("Content-type: image/jpeg");

    $sql = "SELECT studentimage FROM student WHERE studentid='" . $_GET["id"] ."';";
	
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
  
    $jpg = $row["studentimage"];

    echo $jpg;
?>