<?php 
    session_start();
    include('db_connect.php');
    
    // Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    $query = "select * from users";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die('query failed'.mysqli_error($conn));
    }else{
        $row = mysqli_fetch_assoc($result);
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="admin.css" />
</head>

<body>
    <div class="header">
        <div class="user">
            <img src="profile.jpeg" alt="profile" />
            <div>
                <h4><?php echo $_SESSION['email']; ?></h4>
                <p>Super Admin</p>
            </div>
        </div>
    </div>

    <div class="container1">
        <div class="nav">
            <nav>
                <div class="nav_icon">
                    <i class="material-icons">home</i>
                    <a href="#">DASHBOARD</a>
                </div>
                <div class="nav_icon">
                    <i class="material-icons">school</i>
                    <a href="students.php">STUDENTS</a>
                </div>
                <div class="nav_icon">
                    <i class="material-icons">groups</i>
                    <a href="staff.php">STAFF</a>
                </div>
                <div class="nav_icon">
                    <i class="material-icons">payments</i>
                    <a href="payments.php">PAYMENTS</a>
                </div>
                <div class="nav_icon">
                    <i class="material-icons">book</i>
                    <a href="#">COURSES</a>
                </div>
                <div class="nav_icon">
                    <i class="material-icons">logout</i>
                    <a href="logout.php">Logout</a>
                </div>
            </nav>
        </div>

        <div class="main">
        <?php
            $query = "SELECT count(*) as student_count FROM `students`";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $student_count = $row['student_count'];
            } else {
                $student_count = 0;
            }
        ?>
        <?php
            $query = "SELECT count(*) as staff_count FROM `staff`";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $staff_count = $row['staff_count'];
            } else {
                $staff_count = 0;
            }
        ?>
            <!-- Dashboard codes -->
            <div class="DASHBOARD" style="display:block;">
                <h1>DASHBOARD</h1>
                <div class="dash">
                    <div class="students">
                        <h2><?php echo $student_count; ?></h2>
                        <i class="material-icons">school</i>
                        <p>Total Students</p>
                    </div>
                    <div class="teachers">  
                        <h2><?php echo $staff_count; ?></h2>
                        <i class="material-icons">groups</i>
                        <p>Total Teachers</p>
                    </div>
                    <div class="attendance">
                        <h2>100</h2>
                        <i class="material-icons">calendar_month</i>
                        <p>Today's Attendance</p>
                    </div>
                </div><br>

                <div class="analytics">
                    <h2>Analytics Graph</h2>
                    <div class="graph-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

           
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
