<?php
$host = 'localhost';
$user = 'zftsszne_shahrear';
$pass = 'arshahrear30@gmail.com';
$dbname = 'zftsszne_student';

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
