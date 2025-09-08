<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Student'){
    header("Location: login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$student = $conn->query("SELECT * FROM users WHERE id='$student_id'")->fetch_assoc();
$department = $student['department'];

// Fetch teachers
$teachers = $conn->query("SELECT * FROM users WHERE department='$department' AND role='Teacher'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Teachers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>My Teachers</h2>
<div class="dashboard-cards">
    <?php while($row = $teachers->fetch_assoc()){ ?>
        <div>
            <img src="uploads/<?php echo $row['profile_photo']; ?>" class="profile-img">
            <p><?php echo $row['name']; ?></p>
            <p><?php echo $row['email']; ?></p>
        </div>
    <?php } ?>
</div>
<a href="student_dashboard.php"><button>Back</button></a>
</body>
</html>