<?php
session_start(); 
$username=$_SESSION['admin_username'];

$connection=new mysqli('localhost','root','','city_taxi');

//code for genarate id for driver
$sql = "SELECT driverid FROM driver ORDER BY driverid DESC LIMIT 1";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_id = $row["driverid"];
    $last_id_number = substr($last_id, 1); // Extract the numeric part of the last ID
    $new_id_number = str_pad($last_id_number + 1, strlen($last_id_number), '0', STR_PAD_LEFT); // Increment the numeric part and pad with zeros
    $new_did = 'D' . $new_id_number; // Concatenate 'P' with the new numeric part
} else {
    // If no records exist, start from D01
    $new_pid = 'P01';
} 

 //code for insert driver details of the driver
 if(isset($_POST['submit'])){
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
    $status=$_POST['driverstatus'];
    //code starts for inserting reservation record 
    $insert_query="INSERT INTO driver(driverid,drivername,driveremail,driverphoneno,drivervehicleregno,drivernic,driveraddress,status) VALUES('$driverid','$drivername','$driveremail','$driverphoneno','$drivervehicleregno','$drivernic','$driveraddress','$status')";
    mysqli_query($connection,$insert_query);
    $insert_login_query="INSERT INTO user(username,password,usertype) VALUES('$driveremail','','driver')";
    mysqli_query($connection,$insert_login_query);
    echo "<script> alert('Insertion successful.'); </script>";      
    
  }
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
                <h5 class="card-title">Manage Driver</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" method="POST" action="">
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Driver ID</label>
                    <input value="<?php echo $new_did; ?>" name="driverid" type="text" class="form-control" id="inputNanme4" placeholder="">
                  </div>
                  <div class="col-6">
                    <label for="inputState" class="form-label">Name</label>
                    <input name="drivername" type="text" class="form-control" id="inputNanme4">
                  </div>
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Email</label>
                    <input name="driveremail" type="text" class="form-control" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">PhoneNo</label>
                    <input name="driverphoneno" type="text" class="form-control" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">VehicleRegNo</label>
                    <input name="drivervehicleregno" type="text" class="form-control" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">NIC</label>
                    <input name="drivernic" type="text" class="form-control" id="inputNanme4">
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Address</label>
                    <input name="driveraddress" type="text" class="form-control" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Status</label>
                    <select name="driverstatus" id="inputState" class="form-select">
                      <option selected>Choose...</option>
                      <option value="Available" style="color: white; background-color: green;">Available</option>
                      <option value="Busy" style="color: white; background-color: red;">Busy</option>
                    </select>
                  </div>

                  <div class="text-Left">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Driver Details</h5>
                <table class="table">
                  <thead>
                    <tr>                     
                      <th scope="col">DriverID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>                      
                      <th scope="col">PhNo</th>
                      <th scope="col">Vehicle.No</th>
                      <th scope="col">NIC</th>
                      <th scope="col">Address</th>
                      <th scope="col">Status</th>
                      <th scope="col">Update</th>
                      <th scope="col">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    
                    $table_result=mysqli_query($connection,"SELECT * FROM driver");  //input table name and id of passenger to retrive respective passenger booking details
                    while($row=mysqli_fetch_array($table_result))
                    {
                     ?>
                       <tr>
                         <th scope="row"><?php echo $row['driverid']; ?></th>
                         <td><?php echo $row['drivername']; ?></td>
                         <td><?php echo $row['driveremail']; ?></td>
                         <td><?php echo $row['driverphoneno']; ?></td>
                         <td><?php echo $row['drivervehicleregno']; ?></td>
                         <td><?php echo $row['drivernic']; ?></td>
                         <td><?php echo $row['driveraddress']; ?></td>
                         <td><?php echo $row['status']; ?></td>
                         <td><a href="update_driver.php?id=<?php echo $row['driverid']; ?>"><button type="button" name="update" class="btn btn-warning">Update</button></a></td>
                         <td><a href="delete_driver.php?id=<?php echo $row['driverid']; ?>"><button type="button" name="delete" class="btn btn-danger">Delete</button></a></td>
                       </tr>	
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
                <!-- End Default Table Example -->
              </div>
            </div>
              
            </div><!-- End Reports -->
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

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