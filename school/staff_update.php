<?php include('header.php'); ?>
<?php include('db_connect.php');?>


<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_GET['id'])) {
        # code...
        $id = $_GET['id'];

        $query = "select * from staff where id = '$id' ";

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

    if (isset($_POST['update_staff'])) {
        # code...
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $class = $_POST['class'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];


        $query = "update staff set first_name ='$fname', lastname ='$lname', class ='$class', email ='$email', phone ='$phone' where id ='$id' ";

        $result = mysqli_query($conn,$query);

        if (!$result) {
            # code...
            die('query failed'.mysqli_error($conn));
        }else{
            header('Location: staff.php?new=Your data has been added successfully!');
        }
    }

?>

<form action="" method="POST">
    <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" name="fname" class="form-control" value="<?php echo $row['first_name'];?>" required>
    </div>

    <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" class="form-control" value="<?php echo $row['lastname'];?>" required>
    </div>

    <div class="form-group">
        <label for="class">Class</label>
        <input type="text" name="class" class="form-control" value="<?php echo $row['class'];?>"required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo $row['email'];?>"required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" name="phone" class="form-control" value="<?php echo $row['phone'];?>" required>
    </div>

    <input type="submit" id="submit" class="btn btn-success" name="update_staff" value="Update">
    <a href="staff.php" class="btn btn-secondary">Close</a>
</form>


<?php include('footer.php'); ?>