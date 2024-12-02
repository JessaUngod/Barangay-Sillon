
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BSWAS</title>
	 <link rel="stylesheet" href="./assets/css/mdb.css">
	<link rel="stylesheet" href="./assets/fontawesome6/css/all.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="./assets/img/sillon.jpg">
	 <link rel="stylesheet" href="./assets/css/web.css">
</head>

<body class="overflow-hidden">
	<nav class="navbar navbar-expand-lg  navbar-dark " style="background-color: #000;">
		<div class="container">
			
			<h1 class="navbar-brand"><img src="./assets/img/sillon.jpg" style="width: 70px; height: 70px; border-radius: 50%;"><strong> Barangay Sillon  <span class="d-lg-initial d-none">Employee Attendance</span></strong></h1>
			<button class="navbar-toggler shadow-none border-0" type="button" data-mdb-toggle="offcanvas" data-mdb-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"> 
				<i class="fas fa-bars"></i>
				

			</button>

			<div class="sidebar offcanvas offcanvas-start" style="width: 250px;" tabindex="-1" id="offcanvasNavbar"
			aria-labelledby="offcanvasNavbarLabel">

			<div class="offcanvas-header text-white border-button">
				<h5 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel"><strong style="font-size: 1em;">Attendance</strong></h5>
				<button class="btn-close btn-close-white shadow-none" type="button"
				data-mdb-dismiss="offcanvas"
				aria-label="Close">
					
				</button>
				
			</div>

				<!-- side <bodybody> -->
				<div class="offcanvas-body" style="padding: unset">
					<ul class="navbar-nav justify-content-center flex-grow-1 pe-3" id="navbar">
				<!-- <li class="nav-item me-3">
					<a href="#" class="nav-link" data-mdb-toggle="modal" data-mdb-target="#homemodal"><strong>Home</strong></a>
					
				</li>
				<li class="nav-item me-3">
					<a href="3" class="nav-link " data-mdb-toggle="modal" data-mdb-target="#about"><strong>About Us</strong></a>
					
				</li>
				<li class="nav-item me-3">
					<a href="#" class="nav-link" data-mdb-toggle="modal" data-mdb-target="#feed"> <strong>Feedback</strong></a>
					
				
 -->
			
				
			</ul>

			<a href="attendance.php" class="btn btn-light py-3 fw-bold" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Attendance</strong></a>
			<a href="staff/index.php" class="btn btn-light py-3 fw-bold d-lg-none d-block" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Login</strong></a>
			<a href="admin/index.php" class="btn btn-light py-3 fw-bold d-lg-none d-block" style="max-height: 47px; margin-bottom: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Admin Login</strong></a>
			
					

				</div>
			</div>

			

		</div>

		

	</nav>

	<main class="d-flex justify-content-center align-items-center" style="height: 100vh;
	background: linear-gradient( rgba(0,0,0,0.3), rgba(0,0,0,0.3)),url(./assets/img/brgy.hall1.jpg); background-repeat: no-repeat;
	background-size: cover;
	background-position: center;">
	   <!-- <div class="modal fade" id="studentLog"> -->
	  
	



	</main>



  

     
   









  <script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.bundle.js"></script>
<script src="./assets/js/mdb.js"></script>

<script>

	$(".navbar ul li a").on('click' , function(){
		$(".navbar ul li a.active").removeClass('active');
		$(this).addClass('active');


	});

	$('.open-btn').on('click' , function(){
		$('.navbar').addClass('active');
	});
	$('.close-btn').on('click' , function(){
		$('.navbar').removeClass('active');
	});
   </script> 



</body>
</html>
