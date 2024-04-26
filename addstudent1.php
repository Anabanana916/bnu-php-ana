<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "cw2co551";

   $conn = new mysqli($servername, $username, $password, $database);

   //check connection
   if ($conn->connect_error) {
       echo("Connection failed:" . $conn->connect_error);
   }

    
   $data['content'] .= "<form name='createstudent' method='POST' onsubmit='return confirm('Do you really want to delete selected rows?')'>";
   $data['content'] .= "Please enter the following student details below<br/>";
   // Display the module name sin a drop down selection box
   $data['content'] .= "Student First Name: ";
   $data['content'] .= "<input type='text' name='txtfirstname' value='' /><br/>";
   $data['content'] .= "Student Last Name: ";
   $data['content'] .= "<input type='text' name='lastname' value='' /><br/>";
   $data['content'] .= "Date of Birth (format: yyyy-mm-dd): ";
   $data['content'] .= "<input type='text' name='dob' value='' /><br/>";
   $data['content'] .= "1st Line of Address: ";
   $data['content'] .= "<input type='text' name='house' value='' /><br/>";
   $data['content'] .= "Please create a password: ";
   $data['content'] .= "<input type='text' name='password' value='' /><br/>";
   $data['content'] .= "<input type='hidden' name='studentid' value='random_int(10000000, 99999999);'";
   $data['content'] .= "<br/><input type='submit' name='confirm' value='Save' />";
   $data['content'] .= "</form>";

   if (isset($_POST['submit'])){
      $firstname = $_POST['firstname'];
   $lastname = $_POST['lastname'];
   $dob = $_POST['dob'];
   $address = $_POST['home'];
   $password = $_POST['password'];
   $studentid = $_POST['studentid'];
   
   //submit data to database
   $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house) VALUES
   ('$studentid', '$password', '$dob', '$firstname', '$lastname', '$address')";
    
   if(mysqli_query($conn, $sql)){
      echo $data['content'] .= "Student data uploaded successfully";
   } else{
      echo "Error: $sql"
      . mysqli_error($conn);
   }

   //check if all boxes are filled
   if(empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['dob']) && empty($_POST['home']) && empty($_POST['password'])){
      $data['content'] .= "<input name='confirm' disabled/>";
   } else{
      $data['content'] .= "<input name='confirm' enabled/>";
   }

   // render the template
   echo template("templates/default.php", $data);
   }
} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>