<?php
session_start(); 
$username=$_SESSION['admin_username'];
$connection=new mysqli('localhost','root','','city_taxi');

$did=$_GET['id']; 
  
  if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
  }
  else{
    $id=$_GET['id'];
    $name_result=mysqli_query($connection,"SELECT * FROM driver WHERE driverid='$did'");
	  $name_row=mysqli_fetch_assoc($name_result);
    $driver_id=$name_row['driverid'];
    $driver_name=$name_row['drivername'];
    $driver_email=$name_row['driveremail'];
    $driver_phoneno=$name_row['driverphoneno'];
    $driver_vregno=$name_row['drivervehicleregno'];
    $driver_nic=$name_row['drivernic'];
    $driver_address=$name_row['driveraddress'];
    $driver_status=$name_row['status'];
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Driver</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/cab.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block">City Taxi</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">       

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/city-taxi.png" alt="Profile" class="rounded-circle">
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $username; ?></h6>
              <span>Admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li> 
            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person-circle"></i>
                <span>Profile</span>
              </a>
            </li>      
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Passenger</span>
        </a>
      </li>     

      <li class="nav-item">
        <a class="nav-link collapsed" href="driver.php">
          <i class="bi bi-person-circle"></i>
          <span>Driver/Vehicle Owner</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="operator.php">
          <i class="bi bi-person-standing"></i>
          <span>Operator</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="reservation.php">
          <i class="bi bi-card-list"></i>
          <span>Reservation</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="payment.php">
          <i class="bi bi-credit-card-fill"></i>
          <span>Payment</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="user.php">
          <i class="bi bi-person-circle"></i>
          <span>User</span>
        </a>
      </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Update Driver</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" method="POST" action="">
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Driver ID</label>
                    <input value="<?php echo $driver_id; ?>" name="driverid" type="text" class="form-control" id="inputNanme4" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="inputState" class="form-label">Name</label>
                    <input name="drivername" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_name; ?>">
                  </div>
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Email</label>
                    <input name="driveremail" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_email; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">PhoneNo</label>
                    <input name="driverphoneno" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_phoneno; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">VehicleRegNo</label>
                    <input name="drivervehicleregno" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_vregno; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">NIC</label>
                    <input name="drivernic" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_nic; ?>">
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Address</label>
                    <input name="driveraddress" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_address; ?>">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Status</label>
                    <input name="driverstatus" type="text" class="form-control" id="inputNanme4" value="<?php echo $driver_status; ?>" readonly>
                  </div>

                  <div class="text-Left">
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    <button class="btn btn-secondary"><a href="driver.php">Cancel</a></button>
                  </div>
                </form><!-- Vertical Form -->  
              </div>
            </div>           
            </div><!-- End Reports -->
        </div><!-- End Right side columns -->
      </div>
    </section>
  </main><!-- End #main -->

  <?php
  //code for update driver details
  if(isset($_POST['update'])){
    if(empty($_POST['driverid']) || empty($_POST['drivername']) || empty($_POST['driveremail']) || empty($_POST['driverphoneno']) || empty($_POST['drivervehicleregno']) || empty($_POST['drivernic']) || empty($_POST['driveraddress']) || empty($_POST['driverstatus'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
        $driverid=$_POST['driverid'];
        $drivername=$_POST['drivername'];
        $driveremail=$_POST['driveremail'];
        $driverphoneno=$_POST['driverphoneno'];
        $drivervehicleregno=$_POST['drivervehicleregno'];
        $drivernic=$_POST['drivernic'];
        $driveraddress=$_POST['driveraddress'];
        $driverstatus=$_POST['driverstatus'];
      
        $update_query="UPDATE driver SET drivername='$drivername',driveremail='$driveremail',driverphoneno='$driverphoneno',drivervehicleregno='$drivervehicleregno',drivernic='$drivernic',driveraddress='$driveraddress',status='$driverstatus' WHERE driverid='$driverid'";
        if($connection->query($update_query)){
           echo "<script> alert('Update successful.'); </script>";
           echo "<script>window.location='driver.php';</script>";
        }
        else{
           echo "<script> alert('Update fail.'); </script>";
        }      
    }
  }
  ?>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>@ City Taxi</span></strong>
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>