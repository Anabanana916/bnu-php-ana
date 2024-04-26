<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      //var_dump($_POST);

      $hashed_password= password_hash($_POST['password'], PASSWORD_DEFAULT);
      $studentID= random_int(10000000, 99999999);

      //check if all boxes are filled
      if(empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['dob']) && empty($_POST['password']) &&
      empty($_POST['home']) && empty($_POST['town']) && empty($_POST['county']) && empty($_POST['country']) && empty($_POST['postcode'])){
         $data['content'] .= "<input name='submit' disabled/>";
      } else{
         $data['content'] .= "<input name='submit' enabled/>";
      }

      //add INSERT statement
      $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES
         ('$studentID', '$hashed_password', '{$_POST['dob']}', '{$_POST['firstname']}',
          '{$_POST['lastname']}', '{$_POST['house']}', '{$_POST['town']}', '{$_POST['county']}',
          '{$_POST['country']}', '{$_POST['postcode']}')";

      //echo $sql;

      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Student record added</p>";

   }

      $data['content'] = <<<EOD

   <h2>Add new student</h2>
   <form name="frmdetails" action="" method="post">
   <!-- TO DO STUDENT ID-->
   <!--<input type="hidden" name="studentid" value="" /><br/>-->
   First Name :
   <input name="firstname" type="text" value="" /><br/>
   Surname :
   <input name="lastname" type="text"  value="" /><br/>
   Date of Birth (format: yyyy-mm-dd): :
   <input name="dob" type="text"  value="" /><br/>
   <!-- TO DO PASSWORD -->
   Please create a password: 
   <input type='text' name='password' value='' /><br/>
   Number and Street :
   <input name="house" type="text"  value="" /><br/>
   Town :
   <input name="town" type="text"  value="" /><br/>
   County :
   <input name="county" type="text"  value="" /><br/>
   Country :
   <input name="country" type="text"  value="" /><br/>
   Postcode :
   <input name="postcode" type="text"  value="" /><br/>
   <input type="submit" value="Save" name="submit"/>
   </form>

EOD;

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");


