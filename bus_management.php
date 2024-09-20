<?php
include('conn.php');

// Handle form submissions for CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_bus'])) {
        // Create Bus
        $bus_number = $_POST['bus_number'];
        $route = $_POST['route'];
        $seat_capacity = $_POST['seat_capacity'];
        $query = "INSERT INTO bus (bus_number, route, seat_capacity) VALUES ('$bus_number', '$route', $seat_capacity)";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_bus'])) {
        // Update Bus
        $bus_id = $_POST['bus_id'];
        $bus_number = $_POST['bus_number'];
        $route = $_POST['route'];
        $seat_capacity = $_POST['seat_capacity'];
        $query = "UPDATE bus SET bus_number='$bus_number', route='$route', seat_capacity=$seat_capacity WHERE bus_id=$bus_id";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_bus'])) {
        // Delete Bus
        $bus_id = $_POST['bus_id'];
        $query = "DELETE FROM bus WHERE bus_id=$bus_id";
        mysqli_query($conn, $query);
    }
}

// Retrieve all buses for display
$query = "SELECT * FROM bus";
$result = mysqli_query($conn, $query);
$buses = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
include('security.php');
include('includes/header.php');
include('includes/nav.php');
?>


<!-- Add Bus Form -->
<div class="card mb-4">
    <div class="card-header">Add New Bus</div>
    <div class="card-body">
        <form action="bus_management.php" method="POST">
            <div class="form-group">
                <label for="bus_number">Bus Number</label>
                <input type="text" class="form-control" id="bus_number" name="bus_number" required>
            </div>
            <div class="form-group">
                <label for="route">Route</label>
                <input type="text" class="form-control" id="route" name="route" required>
            </div>
            <div class="form-group">
                <label for="seat_capacity">Seat Capacity</label>
                <select class="form-control" id="seat_capacity" name="seat_capacity" required>
                    <option value="" disabled selected>Select seat capacity</option>
                    <option value="32">32</option>
                    <option value="48">48</option>
                </select>
            </div>
            <button type="submit" name="add_bus" class="btn btn-primary">Add Bus</button>
        </form>
    </div>
</div>

<!-- Bus Table -->
<div class="card">
    <div class="card-header">Bus List</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Bus ID</th>
                    <th>Bus Number</th>
                    <th>Route</th>
                    <th>Seat Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buses as $bus): ?>
                    <tr>
                        <td><?php echo $bus['bus_id']; ?></td>
                        <td><?php echo $bus['bus_number']; ?></td>
                        <td><?php echo $bus['route']; ?></td>
                        <td><?php echo $bus['seat_capacity']; ?></td>
                        <td>
                            <!-- Update Form -->
                            <form action="bus_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="bus_id" value="<?php echo $bus['bus_id']; ?>">
                                <input type="text" name="bus_number" value="<?php echo $bus['bus_number']; ?>" required>
                                <input type="text" name="route" value="<?php echo $bus['route']; ?>" required>
                                <input type="number" name="seat_capacity" value="<?php echo $bus['seat_capacity']; ?>" required>
                                <button type="submit" name="update_bus" class="btn btn-warning btn-sm">Update</button>
                            </form>

                            <!-- Delete Form -->
                            <form action="bus_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="bus_id" value="<?php echo $bus['bus_id']; ?>">
                                <button type="submit" name="delete_bus" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>