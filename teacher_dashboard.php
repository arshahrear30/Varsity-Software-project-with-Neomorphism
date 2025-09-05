<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Teacher'){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Welcome, <?php echo $user['name']; ?> (Teacher)</h1>

<div class="dashboard-cards">
    <a href="add_student_attendance.php">Add Student Attendance</a>
    <a href="add_student_grade.php">Add Student Grade</a>
    <a href="add_student_course.php">Add Student Course</a>
    <a href="view_all_students.php">View All Students</a>
    <a href="profile.php">Update Profile</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>