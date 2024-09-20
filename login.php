<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['username']) && $_SESSION['username'] != '') {
    header('Location: index.php');
    exit(); // Always use exit() after header redirection
}

include('includes/header.php'); 
?>
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                <?php
                    if(isset($_SESSION['failed']) && $_SESSION['failed'] !='') {
                        echo '<h4 class="h5 mb-0 font-weight-bold text-gray-800">'.$_SESSION['failed'].'</h4>';
                        unset($_SESSION['failed']);
                    }
                ?>
              </div>

              <form class="user" action="code.php" method="POST">
                  <div class="form-group">
                    <input type="email" name="emaill" class="form-control form-control-user" placeholder="Enter Email Address..." required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="passwordd" class="form-control form-control-user" placeholder="Password" required>
                  </div>
            
                  <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                  <hr>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

<?php
include('includes/scripts.php');
?>
