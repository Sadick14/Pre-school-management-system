<?php
session_start();
include('header.php');
include('db_connect.php');

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

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
    <h2>All Staff</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">ADD STAFF</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Class</th>
            <th>email</th>
            <th>phone</th>
            <th></th>
        </tr>
    </thead> 

    <tbody>
        <?php
            $query = "SELECT staff.id, staff.first_name, staff.lastname,class.c_name, staff.email, staff.phone FROM staff join class on staff.class=class.c_id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['c_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td>
                            <a href="staff_update.php?id=<?php echo $row['id']; ?>"><i class="material-icons">edit</i></a>
                            <a href="staff_delete.php?id=<?php echo $row['id']; ?>"><i class="material-icons">delete</i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Staff</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="class">Class</label>
                    <input type="text" name="class" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="add_staff" value="ADD">
            </div>
        </div>
    </div>
</div>
</form>

<?php include('footer.php'); ?>
