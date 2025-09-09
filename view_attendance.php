<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student'){
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch attendance with course name
$attendance = $conn->query("SELECT attendance.*, courses.course_name 
                            FROM attendance 
                            JOIN courses ON attendance.course_id = courses.id 
                            WHERE attendance.student_id='$student_id' 
                            ORDER BY attendance.date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>My Attendance</h2>
<div class="dashboard-cards">
    <?php while($row = $attendance->fetch_assoc()){ ?>
        <div>
            <p><strong>Course:</strong> <?php echo $row['course_name']; ?></p>
            <p><strong>Date:</strong> <?php echo $row['date']; ?></p>
            <p><strong>Status:</strong> <?php echo $row['status']; ?></p>
        </div>
    <?php } ?>
</div>
<a href="student_dashboard.php"><button>Back</button></a>
</body>
</html>