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
    <h2>All Payments</h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payModal">ADD PAYMENT</button>
</div>

<table class="table table-hover table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Amount</th>
            <th>Date of payment</th>
            <!-- <th>courses</th> -->
            <th></th>
        </tr>
    </thead> 

    <tbody>
        <?php
            $query = "SELECT payments.pay_id, students.first_name, students.lastname, payments.amount, payments.dop FROM payments JOIN students ON students.index_num = payments.students_id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['pay_id']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['lastname']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['dop'];?></td>
                        <td>
                            <a href="payments_update.php?pay_id=<?php echo $row['pay_id']; ?>"><i class="material-icons">edit</i></a>
                            <a href="payments_delete.php?pay_id=<?php echo $row['pay_id']; ?>"><i class="material-icons">delete</i></a>
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
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payModalLabel">Add Payment</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="s_id">Index Number</label>
                    <input type="tel" name="s_id" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" class="form-control" required>
                </div>

            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" name="add_payment" value="ADD">
            </div>
        </div>
    </div>
</div>
</form>

<?php include('footer.php'); ?>
