<?php include('header.php')?>
<?php include('db_connect.php');?>

<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

           $query = "delete from students where id = '$id'";
           $result = mysqli_query($conn, $query);

           if(!$result){
            die('query failed'.mysqli_error($conn));
           }else{
            header('location: students.php?del=Data is deleted');
            exit();
           }
        }else{
            header('location: students.php?msg=incorrect password');
        }
?>

