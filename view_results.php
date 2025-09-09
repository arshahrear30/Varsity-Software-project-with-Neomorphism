<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student'){
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];

// Fetch grades with course name
$grades = $conn->query("SELECT grades.*, courses.course_name 
                        FROM grades 
                        JOIN courses ON grades.course_id = courses.id 
                        WHERE grades.student_id='$student_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>My Results</h2>
<div class="dashboard-cards">
    <?php while($row = $grades->fetch_assoc()){ ?>
        <div>
            <p><strong>Course:</strong> <?php echo $row['course_name']; ?></p>
            <p><strong>Grade:</strong> <?php echo $row['grade']; ?></p>
        </div>
    <?php } ?>
</div>
<a href="student_dashboard.php"><button>Back</button></a>
</body>
</html>