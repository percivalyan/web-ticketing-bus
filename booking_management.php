<?php
include('conn.php');

// Handle form submissions for CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_booking'])) {
        // Create Booking
        $customer_id = $_POST['customer_id'];
        $bus_id = $_POST['bus_id'];
        $seat_number = $_POST['seat_number'];
        $query = "INSERT INTO booking (customer_id, bus_id, seat_number) VALUES ('$customer_id', '$bus_id', '$seat_number')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['update_booking'])) {
        // Update Booking
        $booking_id = $_POST['booking_id'];
        $customer_id = $_POST['customer_id'];
        $bus_id = $_POST['bus_id'];
        $seat_number = $_POST['seat_number'];
        $query = "UPDATE booking SET customer_id='$customer_id', bus_id='$bus_id', seat_number='$seat_number' WHERE booking_id=$booking_id";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_booking'])) {
        // Delete Booking
        $booking_id = $_POST['booking_id'];
        $query = "DELETE FROM booking WHERE booking_id=$booking_id";
        mysqli_query($conn, $query);
    }
}

// Retrieve all bookings for display
$query = "SELECT b.booking_id, c.name AS customer_name, bus.bus_number, b.seat_number, b.booking_date 
          FROM booking b
          JOIN customer c ON b.customer_id = c.customer_id
          JOIN bus ON b.bus_id = bus.bus_id";
$result = mysqli_query($conn, $query);
$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Retrieve customers and buses for selection
$customers = mysqli_query($conn, "SELECT customer_id, name FROM customer");
$buses = mysqli_query($conn, "SELECT bus_id, bus_number FROM bus");
?>

<?php
include('security.php');
include('includes/header.php');
include('includes/nav.php');
?>

<!-- Add Booking Form -->
<div class="card mb-4">
    <div class="card-header">Add New Booking</div>
    <div class="card-body">
        <form action="booking_management.php" method="POST">
            <div class="form-group">
                <label for="customer_id">Customer</label>
                <select class="form-control" id="customer_id" name="customer_id" required>
                    <?php while ($customer = mysqli_fetch_assoc($customers)): ?>
                        <option value="<?php echo $customer['customer_id']; ?>"><?php echo $customer['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="bus_id">Bus</label>
                <select class="form-control" id="bus_id" name="bus_id" required>
                    <?php while ($bus = mysqli_fetch_assoc($buses)): ?>
                        <option value="<?php echo $bus['bus_id']; ?>"><?php echo $bus['bus_number']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="seat_number">Seat Number</label>
                <select class="form-control" id="seat_number" name="seat_number" required>
                    <option value="">Pilih Nomor Kursi</option>
                </select>
            </div>

            <script>
                const select = document.getElementById('seat_number');
                const letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

                let seatCount = 0; // Counter untuk menghitung jumlah kursi

                letters.forEach(letter => {
                    for (let i = 1; i <= 4; i++) {
                        seatCount++;
                        const option = document.createElement('option');
                        option.value = `${letter}${i}`;
                        option.textContent = `${letter}${i}`;
                        select.appendChild(option);

                        // Berhenti saat kursi mencapai 32 atau 48
                        if (seatCount === 32) {
                            console.log('Batas 32 kursi tercapai.');
                        } else if (seatCount === 48) {
                            console.log('Batas 48 kursi tercapai.');
                            break; // Menghentikan loop setelah mencapai 48
                        }
                    }
                });
            </script>


            <button type="submit" name="add_booking" class="btn btn-primary">Add Booking</button>
        </form>
    </div>
</div>

<!-- Booking Table -->
<div class="card">
    <div class="card-header">Booking List</div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Bus</th>
                    <th>Seat Number</th>
                    <th>Booking Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['booking_id']; ?></td>
                        <td><?php echo $booking['customer_name']; ?></td>
                        <td><?php echo $booking['bus_number']; ?></td>
                        <td><?php echo $booking['seat_number']; ?></td>
                        <td><?php echo $booking['booking_date']; ?></td>
                        <td>
                            <!-- Update Form -->
                            <form action="booking_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                                <select class="form-control" name="customer_id" required>
                                    <?php
                                    mysqli_data_seek($customers, 0); // Reset result pointer
                                    while ($customer = mysqli_fetch_assoc($customers)): ?>
                                        <option value="<?php echo $customer['customer_id']; ?>" <?php echo ($booking['customer_name'] == $customer['name']) ? 'selected' : ''; ?>>
                                            <?php echo $customer['name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <select class="form-control" name="bus_id" required>
                                    <?php
                                    mysqli_data_seek($buses, 0); // Reset result pointer
                                    while ($bus = mysqli_fetch_assoc($buses)): ?>
                                        <option value="<?php echo $bus['bus_id']; ?>" <?php echo ($booking['bus_number'] == $bus['bus_number']) ? 'selected' : ''; ?>>
                                            <?php echo $bus['bus_number']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <input type="number" name="seat_number" value="<?php echo $booking['seat_number']; ?>" required>
                                <button type="submit" name="update_booking" class="btn btn-warning btn-sm">Update</button>
                            </form>

                            <!-- Delete Form -->
                            <form action="booking_management.php" method="POST" style="display:inline;">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                                <button type="submit" name="delete_booking" class="btn btn-danger btn-sm">Delete</button>
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