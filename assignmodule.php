<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   echo "<h1 class='mt-5'>Assign Modules</h1>";
   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $sql = "INSERT into student values ('" .  $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you</p>";
      
   }
   else  // If a module has not been selected
   {

     // Build sql statment that selects all the modules
     $sql = "select * from module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<form name='frmassignmodule' action='' method='post' class='mt-5'>";
     $data['content'] .= "<label class='form-label'>Select a module to assign</label><br/>";
     $data['content'] .= "<select class='form-control' name='selmodule'>";
     // Display the module name sin a drop down selection box
     while($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }
     $data['content'] .= "</select><br/>";
     $data['content'] .= "<input type='submit' name='confirm' class='btn btn-primary' value='Save' />";
     $data['content'] .= "</form>";
   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
