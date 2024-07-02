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

        $query = "select * from students where id = '$id' ";

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

    if (isset($_POST['update_student'])) {
        # code...
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $index = $_POST['index'];
        $class = $_POST['class'];
        $age = $_POST['age'];


        $query = "update students set index_num ='$index', first_name ='$fname', lastname ='$lname', age ='$age', c_id='$class' where id ='$id' ";

        $result = mysqli_query($conn,$query);

        if (!$result) {
            # code...
            die('query failed'.mysqli_error($conn));
        }else{
            header('Location: students.php?new=Your data has been added successfully!');
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
                    <label for="index">Index Number</label>
                    <input type="text" name="index" class="form-control" value="<?php echo $row['index_num'];?>" required>
                </div>

                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" name="class" class="form-control" value="<?php echo $row['c_id'];?>" required>
                </div>

    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" class="form-control" value="<?php echo $row['age'];?>" required>
    </div>

    <input type="submit" id="submit" class="btn btn-success" name="update_student" value="Update">
    <a href="students.php" class="btn btn-secondary">Close</a>
</form>


<?php include('footer.php'); ?>