<?php
use LDAP\Result;

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

function generateID($conn) {
   $studentID= random_int(10000000, 99999999);
   $sql = "SELECT * FROM student WHERE studentid = $studentID";
   $result = mysqli_query($conn,$sql);
   $num_rows = mysqli_num_rows($result);
   if ($num_rows > 0) {
      return generateID($conn);
   }
   return $studentID;
   
} 
// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {
      $imagePath = "";
      if(isset($_FILES['studentimage']) && $_FILES['studentimage']['error'] == 0){
         $fileTmpPath = $_FILES['studentimage']['tmp_name'];
         $fileName = $_FILES['studentimage']['name'];
         $fileSize = $_FILES['studentimage']['size'];
         $fileType = $_FILES['studentimage']['type'];
         $fileNameCmps = explode('.', $fileName);
         $fileExtension = strtolower(end($fileNameCmps));
         $imagedata = addslashes(fread(fopen($fileTmpPath, "r"), filesize($fileTmpPath)));

         $allowedFileExtensions = ['jpg', 'png', 'jpeg'];
            if (in_array($fileExtension, $allowedFileExtensions) && $fileSize < 40000000) {
               $uploadFileDir = 'C:\xampp\htdocs\bnu-php-ana\StudentPics\\';
               $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
               $dest_path = $uploadFileDir . $newFileName;
               
               if (move_uploaded_file($fileTmpPath, $dest_path)) {
                  $imagePath = $dest_path;
               }
               else {
                  echo '<script>alert("Error moving file uploaded");</script>';
               }
            }
            else {
               echo '<script>alert("Invalid file type or size. Must be JPG, PNG or Jpeg.';
            }
      }

      //var_dump($_POST);

      $hashed_password= password_hash($_POST['password'], PASSWORD_DEFAULT);
      $studentID = generateID($conn);

      //check if all boxes are filled
      if(empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['dob']) || empty($_POST['password']) ||
      empty($_POST['house']) || empty($_POST['town']) || empty($_POST['county']) || empty($_POST['country']) || empty($_POST['postcode'])){
         $data['content'] .= "Fields not filled";
      } else{
         //add INSERT statement
         $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, studentimage) VALUES
            ('$studentID', '$hashed_password', '{$_POST['dob']}', '{$_POST['firstname']}',
            '{$_POST['lastname']}', '{$_POST['house']}', '{$_POST['town']}', '{$_POST['county']}',
            '{$_POST['country']}', '{$_POST['postcode']}', '$imagedata')";

            //echo $sql
            $result = mysqli_query($conn,$sql);
            $data['content'] .= "<p>Student record added</p>";
      }

   }

      $data['content'] .= <<<EOD
   <h2 class='mt-5'>Add New Student</h2>
   <form name="frmdetails" action="" onsubmit="return confirm('Add new student to records?');" method="post" enctype="multipart/form-data" class='mt-5'>
      <div class='mb-3'>
         <label class="form-label">First Name: </label>
         <input name="firstname" type="text" class="form-control" value="" required/><br/>
         <label class="form-label">Surname: </label>
         <input name="lastname" type="text"  class="form-control" value="" required/><br/>
         <label class="form-label">Date of Birth: </label>
         <input name="dob" type="date" class="form-control" value="" required/><br/>
         <label class="form-label">Please create a password: </label>
         <input type="password" name="password" class="form-control" value='' required/><br/>
         <label class="form-label">Number and Street: </label>
         <input name="house" type="text" class="form-control"  value="" required/><br/>
         <label class="form-label">Town: </label>
         <input name="town" type="text" class="form-control" value="" required/><br/>
         <label class="form-label">County: </label>
         <input name="county" type="text" class="form-control" value="" required/><br/>
         <label class="form-label">Country: </label>
         <input name="country" type="text" class="form-control" value="" required/><br/>
         <label class="form-label">Postcode: </label>
         <input name="postcode" type="text" class="form-control" value="" required/><br/>
         <label class="form-label">Picture: </label>
         <input name="studentimage" type="file" class="form-control" value=""/><br/>
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


