<?php include('db_connect.php'); ?>

<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

if (isset($_POST['add_student'])) {
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $index = $_POST['index'];
    $age = $_POST['age'];
    $class = $_POST['class'];

    if ($f_name == "" || empty($f_name)) {
        header('Location: students.php?message=You need to fill in the first name!');
        exit();
    } else {
        $query = "INSERT INTO students (index_num, first_name, lastname, age, c_id)  VALUES ('$index','$f_name', '$l_name', '$age', '$class')";
        
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        } else {
            header('Location: students.php?new=Your data has been added successfully!');
            exit();
        }
    }
}
?>

<?php
if (isset($_POST['add_staff'])) {
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if ($f_name == "" || empty($f_name)) {
        header('Location: staff.php?message=You need to fill in the first name!');
        exit();
    } else {
        $query = "INSERT INTO staff (first_name, lastname, class, email, phone) VALUES ('$f_name', '$l_name', '$class', '$email', '$phone')";
        
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        } else {
            header('Location: staff.php?new=Your data has been added successfully!');
            exit();
        }
    }
}
?>


<?php
if (isset($_POST['add_payment'])) {
    $s_id = $_POST['s_id'];
    $amount = $_POST['amount'];


        $query = "INSERT INTO payments (students_id, amount) VALUES ('$s_id', '$amount')";
        
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));
        } else {
            header('Location: payments.php?new=Your data has been added successfully!');
            exit();
        }
}
?>

