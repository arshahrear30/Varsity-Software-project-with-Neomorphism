<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student'){
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch student's department
$student = $conn->query("SELECT * FROM users WHERE id='$student_id'")->fetch_assoc();
$department = $student['department'];

// Fetch courses for the student's department
$courses = $conn->query("SELECT courses.*, users.name AS teacher_name FROM courses 
                         JOIN users ON courses.teacher_id = users.id 
                         WHERE courses.department='$department'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>My Courses</h2>
<div class="dashboard-cards">
    <?php while($row = $courses->fetch_assoc()){ ?>
        <div>
            <p><strong>Course:</strong> <?php echo $row['course_name']; ?></p>
            <p><strong>Teacher:</strong> <?php echo $row['teacher_name']; ?></p>
        </div>
    <?php } ?>
</div>
<a href="student_dashboard.php"><button>Back</button></a>
</body>
</html>