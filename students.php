<html>
    <body>

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
                        echo "<tr><td>" . $row["studentid"]. "</td><td>" . $row["dob"] . "</td><td>" .
                        $row["firstname"] . " " . $row["lastname"] . "</td><td>" . $row["house"] . "</td><td>";
                        echo "<input type='checkbox' name='selected[]' value='" .  $row["studentid"] . "'></td>";
                        
                    }
                }
            ?>
        </tbody>
        </table>
    </body>
</html>