<?php
session_start();
include "db_conn.php";

if (isset($_POST['className']) && isset($_POST['teacher']) && isset($_POST['period']) && isset($_POST['grade'])) {
    $id = $_SESSION['id'];
    $className = $_POST['className'];
    $teacher = $_POST['teacher'];
    $period = $_POST['period'];
    $grade = $_POST['grade'];

    if (empty($id) || empty($className) || empty($teacher) || empty($period) || empty($grade)) {
        header("Location: addClass.php");
    }
    else {
        $sql = "SELECT className FROM classes WHERE id = '$id' AND className = '$className'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            header("Location: addClass.php");
        }
        else {
            $sql = "INSERT INTO `classes`(`id`, `className`, `teacher`, `period`, `grade`) 
    VALUES ('$id','$className','$teacher','$period','$grade')";
            mysqli_query($conn, $sql);

            header("Location: home.php");
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>A+ Grades</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="addClass.php" method="post">
    <h1>Add A Class</h1>
    <label>Class Name</label>
    <label>
        <input type="text" name="className" placeholder="Class Name">
    </label><br>
    <label>Teacher</label>
    <label>
        <input type="text" name="teacher" placeholder="Teacher">
    </label><br>
    <label>Period</label>
    <label>
        <input type="text" name="period" placeholder="Period">
    </label><br>
    <label>Grade</label>
    <label>
        <input type="number" name="grade" placeholder="Grade">
    </label><br>
    <button type="submit">Add</button>
    <img src="img/armstrong.jpg" alt="Stacey Armstrong">
</form>
</body>
</html>
