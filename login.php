<?php
session_start();
include "db_conn.php";

if (isset($_POST['id']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $pass = $_POST['password'];

    if (empty($id) || empty($pass)) {
        header("Location: login.php");
    }
    else {
        $sql = "SELECT id, password FROM user WHERE id = '$id' AND password = '$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['id'] === $id && $row['password'] === $pass) {
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
            }
            else {
                header("Location: login.php");
            }
        }
        else {
            header("Location: login.php");
        }
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A+ Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="login.php" method="post">
        <h1>LOGIN</h1>
        <label>User Name</label>
        <label>
            <input type="text" name="id" placeholder="User Name">
        </label><br>
        <label>Password</label>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label><br>
        <button type="submit">Login</button>
        <a href="register.php">
            <button type="button">Register</button>
        </a>
        <img src="img/armstrong.jpg" alt="Stacey Armstrong">
    </form>
</body>
</html>
