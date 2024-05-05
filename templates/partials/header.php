<html>

   <head>
      <title>BNU Student Web Application</title>
      <h1 class="mt-2 mx-3 mb-3">BNU Student Log</h1>
      <!-- styles and JS here -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      
      <!-- <?php
         // //<!--method of sql real escape security by looping through posts to check for sneaky characters-->
         // function generateID($conn) {
         //    $studentID= random_int(10000000, 99999999);
         //    $sql = "SELECT * FROM student WHERE studentid = $studentID";
         //    $result = mysqli_query($conn,$sql);
         //    $num_rows = mysqli_num_rows($result);
         //    if ($num_rows > 0) {
         //       return generateID($conn);
         //    }
         //    return $studentID;
         
         // if ($_POST > 0) {
         //       foreach $_POST[]{
         //          $safeFname = mysqli_real_escape_string($_POST[txtfname]);
         //          $safeSname = mysqli_real_escape_string($_POST[txtsname]);
         //          //dob safe as user can only enter numerical characters
         //          $safePwd = mysqli_real_escape_string($_POST[txtpassword]);
         //          $safeHome = mysqli_real_escape_string($_POST[txthome]);
         //          $safeTown = mysqli_real_escape_string($_POST[txttown]);
         //          $safeCounty = mysqli_real_escape_string($_POST[txtCounty]);
         //          $safeCountry = mysqli_real_escape_string($_POST[txtCountry]);
         //          $safePost = mysqli_real_escape_string($_POST[txtPost]);
         //          //using LIKE to search through all metrics a user could alter
         //          $sql ="SELECT * FROM student LIKE '\' OR \'\'=\''";
         //          $sql = $sql . $safeFname . "' AND Password='" . $safeSname . "' AND Password='" . $safePwd . 
         //          "' AND Password='" . $safeHome . "' AND Password='" . $safeTown . "' AND Password='" . $safeCounty . 
         //          "' AND Password='" . $safeCountry . "' AND Password='" . $safePost ."';";
         //       }
         // }
      //?> -->

   </head>

   <body>

   <div class="container">