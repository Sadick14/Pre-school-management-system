<?php include('header.php'); ?>
<?php include('db_connect.php');?>


<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_GET['pay_id'])) {
        # code...
        $id = $_GET['pay_id'];

        $query = "SELECT * FROM payments where pay_id = '$id'";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            # code...
            die('query failed'.mysqli_error($conn));
        }else {
            $row = mysqli_fetch_assoc($result);
        }
    }

?>

<?php

    if (isset($_POST['update_payments'])) {
        # code...
        $index = $_POST['index'];
        $amount = $_POST['amount'];


        $query = "UPDATE payments SET students_id = '$index', amount = '$amount' WHERE pay_id = '$id'";

        $result = mysqli_query($conn,$query);

        if (!$result) {
            # code...
            die('query failed'.mysqli_error($conn));
        }else{
            header('Location: payments.php?new=Your data has been added successfully!');
        }   
    }

?>

<form action="" method="POST">
    <div class="form-group">
        <label for="idex">Index Number</label>
        <input type="text" name="index" class="form-control" value="<?php echo $row['students_id'];?>" required>
    </div>

    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="tel" name="amount" class="form-control" value="<?php echo $row['amount'];?>" required>
    </div>

    <input type="submit" id="submit" class="btn btn-success" name="update_payments" value="Update">
    <a href="payments.php" class="btn btn-secondary">Close</a>
</form>


<?php include('footer.php'); ?>