<?php
session_start();
// Check if user is logged in
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit();
    }


include('header.php');
include('db_connect.php');


// Handle messages from query parameters
if (isset($_GET['message'])) {
    echo "<h6>Unsuccessful: some fields are empty</h6>";
}

if (isset($_GET['msg'])) {
    echo "<h6>Incorrect password!</h6>";
}

if (isset($_GET['new'])) {
    echo "<h5>Data has been added successfully!</h5>";
}

if (isset($_GET['del'])) {
    echo "<h6>Data has been deleted successfully!</h6>";
}
?>

<div class="box1">
    <h2>All Students</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ADD STUDENT</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Class</th>
            <!-- <th>courses</th> -->
            <th></th>
        </tr>
    </thead> 

    <tbody>
        <?php
            $query = "SELECT id, students.index_num, students.first_name, students.lastname, students.age, class.c_name FROM students join class on students.c_id=class.c_id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['index_num']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td><?php echo $row['c_name'];?></td>
                        <td>
                            <a href="student_update.php?id=<?php echo $row['id']; ?>"><i class="material-icons">edit</i></a>
                            <a href="student_delete.php?id=<?php echo $row['id']; ?>"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                <?php
                }
            }
        ?>
    </tbody>
</table>

<!-- Modal -->
<form action="insert_data.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" placeholder="Mavin" required>
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" placeholder="eg. Johnson" required>
                </div>

                <div class="form-group">
                    <label for="age">Date of birth</label>
                    <input type="date" name="age" class="form-control" placeholder="dd-mm-yyyy"required>
                </div>

                <div class="form-group">
                    <label for="index">Index Number</label>
                    <input type="text" name="index" class="form-control" placeholder="NL-000021"required>
                </div>

                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" name="class" class="form-control" placeholder="Enter the class number" required>
                </div>
<!-- 
                <div class="form-group">
                    <label for="course">Courses</label>
                    <input type="text" name="course" class="form-control" required>
                </div> -->
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="add_student" value="ADD">
            </div>
        </div>
    </div>
</div>
</form>

<?php include('footer.php'); ?>
