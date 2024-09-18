<?php
session_start();
include "db_conn.php";

function createTable($id): void {
    $sql= "SELECT * FROM classes WHERE id = '$id' ORDER BY period";
    global $conn;
    $result = mysqli_query($conn, $sql);

    echo "<table> 
        <tr>  
        <td>Subject</td>
        <td>Teacher</td>
        <td>Period</td>
        <td>Grade</td>
        </tr>";


    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>  
                <td><a href='members.php?'>" . $row['className'] . "</a></td>
                <td>" . $row['teacher'] . "</td>
                <td>" . $row['period'] . "</td>
                <td>" . $row['grade'] . "</td>
                </tr>";
    }
    echo "</table>";
}

if (isset($_SESSION['id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>A+ Grades</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>
            Hello,
            <?php
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM user WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo $row['firstName'] . ' ' . $row['lastName'] . '<br>';
                echo 'Email: ' . $row['email'] . '<br>';
                echo 'ID: ' . $row['id'];
            }
            ?>
            <a href="addClass.php">
                <button type="submit">Add A Class</button>
            </a>
            <a href="logout.php">
                <button type="submit">Logout</button>
            </a>
        </h1>
        <p>
            <?php
            $id = $_SESSION['id'];
            createTable($id);
            ?>
        </p>
    </body>
    </html>
    <?php
}
else{
    header("Location: index.php");
    exit();
}
?>