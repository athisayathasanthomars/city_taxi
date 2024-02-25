<?php
$connection=new mysqli('localhost','root','','city_taxi');

if(isset($_POST['submit'])){
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phoneno']) || empty($_POST['address'])){
        echo "<script> alert('Provide all the details!!'); </script>";        
    }
    else{
        //code for genarate id for passenger
        $sql = "SELECT passengerid FROM passenger ORDER BY passengerid DESC LIMIT 1";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
         $row = $result->fetch_assoc();
         $last_id = $row["passengerid"];
         $last_id_number = substr($last_id, 1); // Extract the numeric part of the last ID
         $new_id_number = str_pad($last_id_number + 1, strlen($last_id_number), '0', STR_PAD_LEFT); // Increment the numeric part and pad with zeros
         $new_pid = 'P' . $new_id_number; // Concatenate 'P' with the new numeric part
         echo $new_pid;//the new passenger ID
        } else {
        // If no records exist, start from P01
         $new_pid = 'P01';
        } 

        $email=$_POST['email'];
        //code to check email format
        // Check if the email address is in the correct format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $phoneno=$_POST['phoneno'];
            if (strlen($phoneno) == 10 && substr($phoneno, 0, 1) == '0') {
                $name=$_POST['name'];      
                $address=$_POST['address'];
                //code starts for inserting passenger record in passenger table 
                $query1="INSERT INTO passenger(passengerid,passengername,passengeremail,passengerphoneno,passengeraddress) VALUES('$new_pid','$name','$email','$phoneno','$address')";
                //code for record login credentials of passenger in login table
                $usertype='passenger';
                $query2="INSERT INTO user(username,password,usertype) VALUES('$email','','$usertype')";
                //executing the queries 
                mysqli_query($connection,$query1);
                mysqli_query($connection,$query2);
                echo "<script> alert('Successfully registered. Check your email!'); </script>";
                header("Location:index.php");
            } else {
                echo "<script> alert('Phone number not valid. provide 10 digits number with 0 in start!!'); </script>";
            }                        
        } else {
            echo "<script> alert('email not valid..'); </script>";
        }        
    }       
}

?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    
    <title>Taxi</title>
    <style>        
        .form-row{
            padding-top: 30px;
            width: 300px;
            height: 250px;
            align-items: center;
            justify-content: center;
        }
        .form-group{
            padding: 10px;
        }
        .form-control{
            margin-bottom: 10px;
            width: 200px;
        }	
    </style>
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/magnific-popup.css">
        <link rel="stylesheet" href="css/nice-select.css">							
        <link rel="stylesheet" href="css/animate.min.css">
        <link rel="stylesheet" href="css/jquery-ui.css">			
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>	
          <header id="header">
              <div class="header-top">
            </div>
            <div class="container main-menu">
                <div class="row align-items-center justify-content-between d-flex">
                    <a href="index.html"><img src="" alt="" title="" /></a>		
                    <nav id="nav-menu-container">
                        <ul class="nav-menu">
                          <li class="menu-active"><a href="index.php">Home</a></li>
                          <li><a href="about.html">About</a></li>
                          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                              Login
                          </a>							  
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="driver-login.php">Driver</a>
                              <a class="dropdown-item" href="operator-login.php">Operator</a>
                              <a class="dropdown-item" href="admin-login.php">Admin</a>
                            </div>
                        </ul>
                    </nav><!-- #nav-menu-container -->		
                </div>
            </div>
          </header><!-- #header -->
             
       
        <section class="services-area section-gap">
            <div class="container1">
                <div class="row section-title">
                    <h1>Passenger-Register</h1>
                </div>
                <div class="form-row section-title">
                    <form class="form" action="" method="POST">
                        <div class="from-group">
                            <input class="form-control col-xs-3 txt-field" type="text" name="name" placeholder="Your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'name'">
                            <input class="form-control txt-field" type="email" name="email" placeholder="Email address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'">
                            <input class="form-control txt-field" type="text" name="phoneno" placeholder="Phone number"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'">
                            <input class="form-control txt-field" type="text" name="address" placeholder="Address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'">
                        </div>								    
                        <div class="form-group">
                            <button class="btn btn-default btn-lg btn-block text-center text-uppercase" type=""submit" name="submit">Register</button>
                        </div>
                  </form>												
                </div>
            </div>	
        </section>
        <!-- End services Area -->

                                                    
                                                                                            
        <!-- start footer Area -->		
        <footer class="footer-area section-gap">
            <div class="container">
                <div class="row">
                    <p class="mt-80 mx-auto footer-text col-lg-12">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | City Taxi Pvt Ltd.
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>											
                </div>
            </div>
            <img class="footer-bottom" src="img/footer-bottom.png" alt="">
        </footer>	
        <!-- End footer Area -->	

        <script src="js/vendor/jquery-2.2.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/vendor/bootstrap.min.js"></script>			
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
          <script src="js/easing.min.js"></script>			
        <script src="js/hoverIntent.js"></script>
        <script src="js/superfish.min.js"></script>	
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>	
         <script src="js/jquery-ui.js"></script>								
        <script src="js/jquery.nice-select.min.js"></script>							
        <script src="js/mail-script.js"></script>	
        <script src="js/main.js"></script>		
    </body>
</html>
    
