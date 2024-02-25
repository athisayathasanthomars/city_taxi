<?php
  session_start(); 
  $username=$_SESSION['admin_username'];

  $connection=new mysqli('localhost','root','','city_taxi');
  $driverid=mysqli_query($connection,"SELECT driverid FROM driver WHERE status='Available'");
  $passengerid=mysqli_query($connection,"SELECT passengerid FROM passenger");
  
  //code for genarate id for passenger
  $sql = "SELECT passengerid FROM passenger ORDER BY passengerid DESC LIMIT 1";
  $result = $connection->query($sql);
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $last_id = $row["passengerid"];
      $last_id_number = substr($last_id, 1); // Extract the numeric part of the last ID
      $new_id_number = str_pad($last_id_number + 1, strlen($last_id_number), '0', STR_PAD_LEFT); // Increment the numeric part and pad with zeros
      $new_pid = 'P' . $new_id_number; // Concatenate 'P' with the new numeric part
  } else {
      // If no records exist, start from P01
      $new_pid = 'P01';
  } 

  //code for insert passenger details of the passenger
  if(isset($_POST['submit'])){
    if(empty($_POST['passengerid']) || empty($_POST['passengername']) || empty($_POST['passengeremail']) || empty($_POST['passengerphoneno']) || empty($_POST['passengeraddress'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
      $passengerid=$_POST['passengerid'];
      $passengername=$_POST['passengername'];
      $passengeremail=$_POST['passengeremail'];
      $passengerphoneno=$_POST['passengerphoneno'];
      $passengeraddress=$_POST['passengeraddress'];
      //code starts for inserting reservation record 
      $insert_query="INSERT INTO passenger(passengerid,passengername,passengeremail,passengerphoneno,passengeraddress) VALUES('$passengerid','$passengername','$passengeremail','$passengerphoneno','$passengeraddress')";
      mysqli_query($connection,$insert_query);
      $insert_login_query="INSERT INTO user(username,password,usertype) VALUES('$passengeremail','','passenger')";
      mysqli_query($connection,$insert_login_query);
      echo "<script> alert('new passenger inserted successfully'); </script>";      
      
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Passenger</title>
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
                <h5 class="card-title">Manage Passenger</h5>
  
                <!-- Vertical Form -->
                <form class="row g-3" action="" method="POST">
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Passenger ID</label>
                    <input type="text" name="passengerid" class="form-control" value="<?php echo $new_pid; ?>" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Passenger Name</label>
                    <input type="text" name="passengername" class="form-control" id="inputNanme4">
                  </div>

                  <div class="col-6">
                    <label for="inputState" class="form-label">Email</label>
                    <input type="email" name="passengeremail" class="form-control" id="" autocomplete="off">
                  </div>
                  
                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Phone No</label>
                    <input type="text" name="passengerphoneno" class="form-control" id="" autocomplete="off">
                  </div>

                  <div class="col-6">
                    <label for="inputNanme4" class="form-label">Address</label>
                    <input type="text" name="passengeraddress" class="form-control" id="" autocomplete="off">
                  </div>                  
                  
                  <div class="text-Left">
                    <button type="submit" name="submit" class="btn btn-primary">Insert</button>                    
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

            <div id="map"></div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Passenger Details</h5>
  
                <!-- Default Table -->
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Passenger_ID</th>                      
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone No</th>
                      <th scope="col">Address</th>
                      <th scope="col">Update</th>
                      <th scope="col">Delete</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    $table_result=mysqli_query($connection,"SELECT * FROM passenger");  //input table name and id of passenger to retrive respective passenger booking details
                    while($row=mysqli_fetch_array($table_result))
                    {
                     ?>
                       <tr>
                         <th scope="row"><?php echo $row['passengerid']; ?></th>
                         <td><?php echo $row['passengername']; ?></td>
                         <td><?php echo $row['passengeremail']; ?></td>
                         <td><?php echo $row['passengerphoneno']; ?></td>
                         <td><?php echo $row['passengeraddress']; ?></td>
                         <td><a href="update_passenger.php?id=<?php echo $row['passengerid']; ?>"><button type="button" name="update" class="btn btn-warning">Update</button></a></td>
                         <td><a href="delete_passenger.php?id=<?php echo $row['passengerid']; ?>"><button type="button" name="delete" class="btn btn-danger">Delete</button></a></td>
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
       
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>