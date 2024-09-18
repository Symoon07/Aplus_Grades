<?php
session_start();
include "db_conn.php";

if (isset($_POST['id']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName'])
    && isset($_POST['email'])) {
    $id = $_POST['id'];
    $pass = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    if (empty($id) || empty($pass) || empty($firstName) || empty($lastName) || empty($email)) {
        header("Location: register.php");
    }
    else {
        $sql = "SELECT id FROM user WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            header("Location: register.php");
        }
        else {
            $sql = "INSERT INTO `user`(`id`, `password`, `firstName`, `lastName`, `email`) 
    VALUES ('$id','$pass','$firstName','$lastName','$email')";
            mysqli_query($conn, $sql);

            header("Location: index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A+ Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="post">
        <h1>REGISTER</h1>
        <label>User Name</label>
        <label>
            <input type="text" name="id" placeholder="User Name">
        </label><br>
        <label>Password</label>
        <label>
            <input type="password" name="password" placeholder="Password">
        </label><br>
        <label>First Name</label>
        <label>
            <input type="text" name="firstName" placeholder="First Name">
        </label><br>
        <label>Last Name</label>
        <label>
            <input type="text" name="lastName" placeholder="Last Name">
        </label><br>
        <label>Email</label>
        <label>
            <input type="email" name="email" placeholder="Email">
        </label><br>
        <button type="submit">Register</button>
        <a href="login.php">
            <button type="button">Login</button>
        </a>
        <img src="img/armstrong.jpg" alt="Stacey Armstrong">
    </form>
</body>
</html>
