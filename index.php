	<?php		
	session_start();
	$connection=new mysqli('localhost','root','','city_taxi');

	if(isset($_POST['submit'])){
		if(empty($_POST['email']) || empty($_POST['password'])){
			echo "<script> alert('Provide username and password!!'); </script>";        
		}
		else{			   
			$username=$_POST['email'];
			$password=$_POST['password'];
			echo $username;
			$result=mysqli_query($connection,"SELECT * FROM user WHERE username='$username'");
			$row=mysqli_fetch_assoc($result);

			if(mysqli_num_rows($result)>0){
				if($password==$row["password"]){					
					header("Location:Passanger/index.php");
					$id_result=mysqli_query($connection,"SELECT * FROM passenger WHERE passengeremail='$username'");
			        $id_row=mysqli_fetch_assoc($id_result);					
					$_SESSION['passengerid']=$id_row['passengerid'];
					                           
				}
				else{
					echo "<script> alert('Password Wrong!'); </script>";
				}
			}
			else{
				echo "<script> alert('Username not registered!!'); </script>";
			}
		}       
	}
	?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		
		<title>Taxi</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
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
							  <a class="btn dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
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

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
						<div class="banner-content col-lg-6 col-md-6 ">
							<h6 class="text-white ">New to Book? Need a Taxi Ride? just call</h6>
							<h1 class="text-uppercase">
								021 221 3431				
							</h1>
							<p class="pt-10 pb-10 text-white">
								Whether you enjoy city breaks or extended holidays in the sun, you can always improve your travel experiences by staying in a small.
							</p>
							<a href="passenger-register.php" class="primary-btn text-uppercase">Passenger Register</a>
						</div>
						<div class="col-lg-4  col-md-6 header-right">
							<h4 class="pb-30">Registered Passenger! Login Here</h4>
							<form action="" method="POST" class="form">
							    <div class="from-group">
							    	<input class="form-control" type="email" name="email" placeholder="Email address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'"><br>
							    	<input class="form-control txt-field" type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your password'">
							    </div>								    
							    <div class="form-group">
							        <button type="submit" class="btn btn-default btn-lg btn-block text-center text-uppercase" name="submit">Login</button>									
							    </div>
							</form>
						</div>											
					</div>
				</div>					
			</section>
			<!-- End banner Area -->	

			<!-- Start home-about Area -->
			<section class="home-about-area section-gap">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 about-left">
							<img class="img-fluid" src="img/about-img.jpg" alt="">
						</div>
						<div class="col-lg-6 about-right">
							<h1>City Taxi Pvt Ltd.</h1>
							<h4>We are here to listen from you deliver exellence</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.								
							</p>
						</div>
					</div>
				</div>	
			</section>
			<!-- End home-about Area -->		
							
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
	