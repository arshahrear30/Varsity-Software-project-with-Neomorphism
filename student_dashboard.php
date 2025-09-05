<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student'){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Welcome, <?php echo $user['name']; ?> (Student)</h1>

<div class="dashboard-cards">
    <a href="view_courses.php">View Courses</a>
    <a href="view_attendance.php">View Attendance</a>
    <a href="view_results.php">View Results</a>
    <a href="view_classmates.php">View Classmates</a>
    <a href="view_teachers.php">View Teachers</a>
    <a href="profile.php">Update Profile</a>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>