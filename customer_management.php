<?php
include('conn.php');

// Handle form submissions for CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_customer'])) {
        // Create Customer
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $query = "INSERT INTO customer (name, email, phone) VALUES ('$name', '$email', '$phone')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_customer'])) {
        // Update Customer
        $customer_id = $_POST['customer_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $query = "UPDATE customer SET name='$name', email='$email', phone='$phone' WHERE customer_id=$customer_id";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_customer'])) {
        // Delete Customer
        $customer_id = $_POST['customer_id'];
        $query = "DELETE FROM customer WHERE customer_id=$customer_id";
        mysqli_query($conn, $query);
    }
}

// Retrieve all customers for display
$query = "SELECT * FROM customer";
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
include('security.php');
include('includes/header.php');
include('includes/nav.php');
?>


<!-- Add Customer Form -->
<div class="card mb-4">
    <div class="card-header">Add New Customer</div>
    <div class="card-body">
        <form action="customer_management.php" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
        </form>
    </div>
</div>

<!-- Customer Table -->
<div class="card">
    <div class="card-header">Customer List</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?php echo $customer['customer_id']; ?></td>
                        <td><?php echo $customer['name']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['phone']; ?></td>
                        <td>
                            <!-- Update Form -->
                            <form action="customer_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
                                <input type="text" name="name" value="<?php echo $customer['name']; ?>" required>
                                <input type="email" name="email" value="<?php echo $customer['email']; ?>" required>
                                <input type="text" name="phone" value="<?php echo $customer['phone']; ?>" required>
                                <button type="submit" name="update_customer" class="btn btn-warning btn-sm">Update</button>
                            </form>

                            <!-- Delete Form -->
                            <form action="customer_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="customer_id" value="<?php echo $customer['customer_id']; ?>">
                                <button type="submit" name="delete_customer" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>