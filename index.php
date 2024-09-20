<?php
include('security.php');
include('includes/header.php');
include('includes/nav.php');

// Fetch counts
require 'conn.php';

// Count of registered admins
$queryAdmins = "SELECT COUNT(id) AS total FROM register";
$resultAdmins = mysqli_query($conn, $queryAdmins);
$dataAdmins = mysqli_fetch_assoc($resultAdmins);
$totalAdmins = $dataAdmins['total'];

// Count of buses
$queryBuses = "SELECT COUNT(bus_id) AS total FROM bus";
$resultBuses = mysqli_query($conn, $queryBuses);
$dataBuses = mysqli_fetch_assoc($resultBuses);
$totalBuses = $dataBuses['total'];

// Count of customers
$queryCustomers = "SELECT COUNT(customer_id) AS total FROM customer";
$resultCustomers = mysqli_query($conn, $queryCustomers);
$dataCustomers = mysqli_fetch_assoc($resultCustomers);
$totalCustomers = $dataCustomers['total'];

// Count of bookings
$queryBookings = "SELECT COUNT(booking_id) AS total FROM booking";
$resultBookings = mysqli_query($conn, $queryBookings);
$dataBookings = mysqli_fetch_assoc($resultBookings);
$totalBookings = $dataBookings['total'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Registered Admin Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAdmins; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Buses Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Buses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBuses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Customers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalCustomers; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Bookings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalBookings; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
