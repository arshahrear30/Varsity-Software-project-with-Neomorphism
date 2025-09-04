<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

if(isset($_POST['update'])){
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $department = $conn->real_escape_string($_POST['department']);

    // Handle profile photo upload
    $profile_photo = $user['profile_photo']; // default old photo
    if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['name'] != ""){
        $file_name = time().'_'.basename($_FILES['profile_photo']['name']);
        $file_tmp = $_FILES['profile_photo']['tmp_name'];

        if(move_uploaded_file($file_tmp, "uploads/".$file_name)){
            $profile_photo = $file_name;
        } else {
            echo "<script>alert('Failed to upload photo');</script>";
        }
    }

    // Update user info
    $update_query = "UPDATE users SET name='$name', email='$email', department='$department', profile_photo='$profile_photo' WHERE id='$user_id'";
    if($conn->query($update_query)){
        // Fetch updated user data
        $user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();
        echo "<script>alert('Profile updated successfully!'); window.location='profile.php';</script>";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Update Profile</h2>
    <img src="uploads/<?php echo $user['profile_photo'] . '?t=' . time(); ?>" class="profile-img" alt="Profile Image">
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <select name="department" required>
            <option value="CSE" <?php if($user['department']=='CSE') echo 'selected'; ?>>CSE</option>
            <option value="EEE" <?php if($user['department']=='EEE') echo 'selected'; ?>>EEE</option>
        </select>
        <input type="file" name="profile_photo" accept="image/*">
        <button type="submit" name="update">Update Profile</button>
    </form>
    <a href="<?php echo $_SESSION['role']=='Student' ? 'student_dashboard.php' : 'teacher_dashboard.php'; ?>">
        <button>Back</button>
    </a>
</div>
</body>
</html>