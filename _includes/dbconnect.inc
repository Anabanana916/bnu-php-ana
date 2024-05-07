<?php
	//  replace mysqllogin and mysqlpassword with your own
	$conn = mysqli_connect("localhost", "root", "", "cw2CO551");

	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		die();
	}

?>
<?php
    //<!--method of sql real escape security by looping through posts to check for sneaky characters-->
    if (isset($_POST) && count($_POST) > 0) {
            foreach ($_POST as $key => $value){
				if (is_string($value)){
					$_POST[$key] = mysqli_real_escape_string($conn, $value);

				}
            }
    }
?>
