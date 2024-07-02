<?php include('header.php')?>
<?php include('db_connect.php');?>

<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    if(isset($_GET['pay_id'])){
        $id = $_GET['pay_id'];

        $query = "DELETE FROM payments WHERE pay_id = '$id'";
        $result = mysqli_query($conn, $query);
           
           if(!$result){
            die('query failed'.mysqli_error($conn));
           }else{
            header('location: payments.php?del=Data is deleted');
            exit();
           }
        }
?>

