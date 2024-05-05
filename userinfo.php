<?php 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cw2co551";

    $conn = new mysqli($servername, $username, $password, $database);

    //check connection
    if ($conn->connect_error) {
        echo("Connection failed:" . $conn->connect_error);
    }


    //Ana, come back and see if you can work out the extra marks
    $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house) VALUES
            (12345678, 'banana2', '1998-12-06', 'Harold', 'Minsc', '16 Milkland Ave'),
            (87654321, '2apples', '1993-10-20', 'Amy', 'Jones', '3 Walnut Street'),
            (56784321, 'fruitsalad', '2000-05-01', 'Jamie', 'Baker', '73 Anderson Road'),
            (12435687, 'BakedApple23', '2001-09-13', 'Olli', 'Miller', '18 Butchers Road'),
            (85274196, 'BapplepIE32', '1999-10-27', 'Sam', 'Anderson', '100 Big Street'),
            (01010101, 'password1', '2069-12-31', 'Dummy', 'Dummerson', '123 Fake Street')";

    if ($conn->query($sql) === TRUE){
        echo "Complete";
    } else {
        echo "Error" . $conn->error;
    }

    ?>