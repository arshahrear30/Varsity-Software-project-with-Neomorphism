<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Teacher'){
    header("Location: login.php");
    exit;
}

$teacher_id = $_SESSION['user_id'];
$students = $conn->query("SELECT * FROM users WHERE role='Student'");

$courses = $conn->query("SELECT * FROM courses WHERE teacher_id='$teacher_id'");

if(isset($_POST['add_attendance'])){
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $conn->query("INSERT INTO attendance (student_id, course_id, status, date) VALUES ('$student_id','$course_id','$status','$date')");
    echo "<script>alert('Attendance added successfully!');</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Attendance</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Add Attendance</h2>
    <form method="POST">
        <select name="student_id" required>
            <option value="">Select Student</option>
            <?php while($row = $students->fetch_assoc()){ ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php } ?>
        </select>

        <select name="course_id" required>
            <option value="">Select Course</option>
            <?php while($row = $courses->fetch_assoc()){ ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['course_name']; ?></option>
            <?php } ?>
        </select>

        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>

        <input type="date" name="date" required>
        <button type="submit" name="add_attendance">Add Attendance</button>
    </form>
    <a href="teacher_dashboard.php"><button>Back</button></a>
</div>
</body>
</html>