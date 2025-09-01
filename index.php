<?php
include 'db.php';

// Fetch total students and teachers
$total_students = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='Student'")->fetch_assoc()['total'];
$total_teachers = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='Teacher'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Northern University</title>
  
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #e0e5ec;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Top corner Login/Register */
        .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
        }
        .top-right a {
            text-decoration: none;
            color: #555;
            margin-left: 15px;
            font-size: 0.9rem;
            padding: 5px 12px;
            border-radius: 10px;
            background: #e0e5ec;
            box-shadow: 3px 3px 6px #bebebe, -3px -3px 6px #ffffff;
            transition: 0.3s;
        }
        .top-right a:hover {
            box-shadow: inset 3px 3px 6px #bebebe, inset -3px -3px 6px #ffffff;
        }

        /* Centered content */
        .center-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            text-align: center;
            padding: 0 20px;
        }

        .university-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .counter {
            display: flex;
            gap: 50px;
            margin-bottom: 40px;
        }

        .counter div {
            background: #e0e5ec;
            padding: 20px 30px;
            border-radius: 20px;
            box-shadow: 6px 6px 12px #bebebe, -6px -6px 12px #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .form-container button {
            margin: 10px;
            padding: 12px 25px;
            border-radius: 15px;
            border: none;
            background: #e0e5ec;
            color: #555;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 6px 6px 12px #bebebe, -6px -6px 12px #ffffff;
            transition: 0.3s;
        }
        .form-container button:hover {
            box-shadow: inset 6px 6px 12px #bebebe, inset -6px -6px 12px #ffffff;
        }

        /* Bottom developers */
        .developers {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 1rem;
            color: #555;
        }
        .developers span {
            margin: 0 15px;
            cursor: pointer;
            text-decoration: underline;
        }

        /* Responsive */
        @media(max-width:768px){
            .counter {
                flex-direction: column;
                gap: 20px;
            }
            .top-right {
                top: 10px;
                right: 10px;
            }
        }
    </style>

    <script>
        function animateCounter(id, target) {
            let count = 0;
            let speed = 80; // ms
            let step = Math.ceil(target / 50);
            let obj = document.getElementById(id);
            let interval = setInterval(() => {
                count += step;
                if(count >= target){
                    count = target;
                    clearInterval(interval);
                }
                obj.innerText = count;
            }, speed);
        }
        window.onload = function(){
            animateCounter('student-counter', <?php echo $total_students; ?>);
            animateCounter('teacher-counter', <?php echo $total_teachers; ?>);
        }
    </script>
</head>
<body>
    <div class="top-right">
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>

    <div class="center-content">
        <div class="university-name">Student Record Northern University</div>

        <div class="counter">
         
            <div>Students: <span id="student-counter">0</span></div>
            <div>Teachers: <span id="teacher-counter">0</span></div>
        </div>

       
    </div>

    <div class="developers">
        Developers: 
        <span onclick="window.open('https://www.facebook.com/arshahrear.cse', '_blank')">A R Shahrear</span>
        <span onclick="window.open('https://www.facebook.com/tamim.ahamed.1426876', '_blank')">Tamim Akondo</span>
        <span onclick="window.open('https://www.facebook.com/ahnaf.tanvir.942', '_blank')">Tanvir Hasan</span>
        <span onclick="window.open('https://www.facebook.com/das.puspita.18', '_blank')">Puspita Das</span>
    </div>
</body>
</html>
