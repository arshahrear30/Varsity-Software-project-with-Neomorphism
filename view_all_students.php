<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Teacher'){
    header("Location: login.php");
    exit;
}

$students = $conn->query("SELECT * FROM users WHERE role='Student'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard-cards">
    <?php while($row = $students->fetch_assoc()){ ?>
        <div>
            <img src="uploads/<?php echo $row['profile_photo']; ?>" class="profile-img">
            <p><?php echo $row['name']; ?></p>
            <p><?php echo $row['email']; ?></p>
            <p><?php echo $row['department']; ?></p>
        </div>
    <?php } ?>
</div>
<a href="teacher_dashboard.php"><button>Back</button></a>
</body>
</html>