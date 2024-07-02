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

           $query = "delete from staff where id = '$id'";
           $result = mysqli_query($conn, $query);

           if(!$result){
            die('query failed'.mysqli_error($conn));
           }else{
            header('location: staff.php?del=Data is deleted');
            exit();
           }
        }
?>

<!-- <form action="staff_delete.php" method="post">

                <div class="form-group">
                    <label for="pass">Confirm Admin Password</label>
                    <input type="password" name="pass" class="form-control" required>
                    <input type="hidden" name="id" id="delete-student-id">
                </div>
            
            <div class="modal-footer">
                <a href="index.php" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <input type="submit" class="btn btn-success" name="new_delete" value="Delete">
            
</form>  -->
   
</script>