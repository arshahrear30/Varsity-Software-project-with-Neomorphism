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

if(isset($_POST['add_grade'])){
    $student_id = $_POST['student_id'];
    $course_id = $_POST['course_id'];
    $grade = $_POST['grade'];

    $conn->query("INSERT INTO grades (student_id, course_id, grade) VALUES ('$student_id','$course_id','$grade')");
    echo "<script>alert('Grade added successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Grade</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Add Grade</h2>
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

        <input type="text" name="grade" placeholder="Grade (e.g., A+)" required>
        <button type="submit" name="add_grade">Add Grade</button>
    </form>
    <a href="teacher_dashboard.php"><button>Back</button></a>
</div>
</body>
</html>