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
   <h1 class='mt-5'>Add New Student</h1>
   <form name="frmdetails" action="" method="post" class='mt-5'>
      <div class='mb-3'>
         <label class="form-label">First Name: </label>
         <input name="firstname" type="text" class="form-control" value="" /><br/>
         <label class="form-label">Surname: </label>
         <input name="lastname" type="text"  class="form-control" value="" /><br/>
         <label class="form-label">Date of Birth (format: yyyy-mm-dd): </label>
         <input name="dob" type="text" class="form-control" value="" /><br/>
         <label class="form-label">Please create a password: </label>
         <input type="text" name="password" class="form-control" value='' /><br/>
         <label class="form-label">Number and Street: </label>
         <input name="house" type="text" class="form-control"  value="" /><br/>
         <label class="form-label">Town: </label>
         <input name="town" type="text" class="form-control" value="" /><br/>
         <label class="form-label">County: </label>
         <input name="county" type="text" class="form-control" value="" /><br/>
         <label class="form-label">Country: </label>
         <input name="country" type="text" class="form-control" value="" /><br/>
         <label class="form-label">Postcode: </label>
         <input name="postcode" type="text" class="form-control" value="" /><br/>
         <input type="submit" value="Save" class="btn btn-primary" name="submit"/>
      </div>
   </form>

EOD;

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");


