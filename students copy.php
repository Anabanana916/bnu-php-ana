<html>
    <body>
    <?php

    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['selected'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "cw2co551";

            $conn = new mysqli($servername, $username, $password, $database);

            //check connection
                if ($conn->connect_error) {
                    echo("Connection failed:" . $conn->connect_error);
                }

                foreach($_POST['selected'] as $selected_id){
                    $sql = "DELETE FROM student WHERE studentid=$selected_id";
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $conn->error;
                    }
                    else {
                        echo "Selection deleted.";
                    }
                }
            } 
        }
    ?>
    <form method="POST" onsubmit="return confirm('Do you really want to delete selected rows?');">
        <table border="1">
            <thead>
                <tr>
                    <th>StudentID</th>
                    <th>DOB</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Select</th>
                </tr>
            </thead>
            <tbody>
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

                    $sql = "SELECT * FROM student";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["studentid"] . "</td>";
                            echo "<td>" . $row["dob"] . "</td>";
                            echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                            echo "<td>" . $row["house"] . "</td>";
                            echo "<td>" . "<input type='checkbox' name='selected[]' value= $row[studentid]></td>";
                            echo "</tr>";  
                        }
                    }
                ?>
            </tbody>
            </table>
            <input type="submit" value="Delete" name="Delete"/>
        </form>
    
    </body>
    
</html>