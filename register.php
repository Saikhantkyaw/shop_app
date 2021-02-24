<?php 
session_start();
require("connection/config.php");
 require("connection/common.php");

if ($_POST) {
	if (empty($_POST['name']) || empty($_POST['password']) || empty($_POST['email']) ||
empty($_POST['phone']) || empty($_POST['address']) || strent($_POST['password'])<4 ) {

		if (empty($_POST['name'])) {
		 $name_err="*you need to put your name";

		}
		if (empty($_POST['password'])) {
		 $psw_err="*you need to put  password";
		 
		}elseif (strent($_POST['password'])<4 ) {
			 $psw_err="*your password need to be 4 at least";
		}
		if (empty($_POST['email'])) {
		 $email_err="*you need to put your email";
		 
		}
		if (empty($_POST['phone'])) {
		 $phone_err="*you need to put your phone number";
		 
		}
		if (empty($_POST['address'])) {
		 $address_err="*you need to put your address";
		 
		}
		
		
	}else{

		$name=$_POST['name'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];

		$statment=$pdo->prepare("INSERT INTO users(name,email,password,phone,address) 
			VALUES(:name,:email,:password,:phone,:address)");
		$result=$statment->execute(
			array(':name'=>$name,':email'=>$email,':password'=>$password,':phone'=>$phone,':address'=>$address)
		);
		if ($result) {
			echo "<script>alert('your registation is successfully completed');window.location.href='index.php';</script>";
		}

	}
}
 ?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>

	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area ">
		<div class="main_menu">
			
		</div>
	
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-12">
					<div class="login_form_inner">
						<h1>Register</h1><br><br>
						<form class="row login_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="email"
								 placeholder="your email" onfocus="this.placeholder = ''"
								  onblur="this.placeholder = 'email'">
							</div>
								<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
								<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="phone" placeholder="phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'phone'">
							</div>
								<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="" placeholder="address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'address'">
							</div>
							
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">register</button>
								
							</div>

							<div class="col-md-12 form-group">
								
									
									<a href="login.php" class="primary-btn" style="color: white">log in</a>
								
								
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
	
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved  
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		
	</footer>
	<!-- End footer Area -->


	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>