<?php
session_start();
include "db_conn.php";

function createTable($className): void {
    $sql= "SELECT * FROM classes JOIN user ON classes.id = user.id WHERE className = '$className'";
    global $conn;
    $result = mysqli_query($conn, $sql);

    echo "<table> 
        <tr>  
        <td>First Name</td>
        <td>Last Name</td>
        </tr>";


    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>  
                <td>" . $row['firstName'] . "</td>
                <td>" . $row['lastName'] . "</td>
                </tr>";
    }
    echo "</table>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A+ Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    createTable("Chemistry AP");
    ?>
</body>
</html>
