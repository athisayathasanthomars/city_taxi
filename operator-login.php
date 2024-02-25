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
					header("Location:Operator/index.php");
					$id_result=mysqli_query($connection,"SELECT * FROM operator WHERE operatoremail='$username'");
			        $id_row=mysqli_fetch_assoc($id_result);					
					$_SESSION['operatorid']=$id_row['operatorid'];                             
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
	<!--HTML Code-->
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		
		<title>Taxi</title>
        <style>
			.form-row{
				padding-top: 30px;
				width: 300px;
				height: 210px;
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
				  

			<!-- Start Sample Area -->
			<section class="sample-text-area">
				<div class="container">
					<div class="row section-title">
						<h1>Operator Login</h1>
					</div>
					<div class="form-row section-title">
						<form class="form" action="" method="POST">
							<div class="from-group">
								<input class="form-control txt-field" type="email" name="email" placeholder="Email address"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'">
								<input class="form-control txt-field" type="password" name="password" placeholder="Password"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>								    
							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-default btn-lg btn-block text-center text-uppercase">Login</button>
							</div>
					  </form>												
					</div>
				</div>
			</section>
			<!-- End Sample Area -->

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