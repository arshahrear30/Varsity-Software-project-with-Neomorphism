<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Teacher'){
    header("Location: login.php");
    exit;
}

$teacher_id = $_SESSION['user_id'];
if(isset($_POST['add_course'])){
    $course_name = $_POST['course_name'];
    $department = $_POST['department'];

    $conn->query("INSERT INTO courses (course_name, teacher_id, department) VALUES ('$course_name', '$teacher_id', '$department')");
    echo "<script>alert('Course added successfully!');</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Add Course</h2>
    <form method="POST">
        <input type="text" name="course_name" placeholder="Course Name" required>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="CSE">CSE</option>
            <option value="EEE">EEE</option>
        </select>
        <button type="submit" name="add_course">Add Course</button>
    </form>
    <a href="teacher_dashboard.php"><button>Back</button></a>
</div>
</body>
</html>