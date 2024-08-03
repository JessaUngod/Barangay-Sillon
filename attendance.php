<?php 

require_once'db.php';


 ?>
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
	 <script type="text/javascript" src="sweet_alert/sweetalert.min.js"></script>
</head>

<body class="overflow-hidden">
	

	<nav class="navbar navbar-expand-lg  navbar-dark " style="background-color: #000;">
		<div class="container">
			
			<h1 class="navbar-brand"><img src="./assets/img/sillon.jpg" style="width: 70px; height: 70px; border-radius: 50%;"><strong> Barangay Sillon Employee Attendance</strong></h1>
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

				
				<div class="offcanvas-body">
					<ul class="navbar-nav justify-content-center flex-grow-1 pe-3" id="navbar">
		
			
				
			</ul>

			<a href="attendance.php" class="btn btn-light py-3 fw-bold" style="max-height: 47px;"><i class="fas fa-sign-in-alt me-1" ></i><strong> Attendance</strong></a>
			
					

				</div>
			</div>

			

		</div>

		

	</nav>

	<main class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 60px);
	background: linear-gradient( rgba(0,0,0,0.3), rgba(0,0,0,0.3)),url(./assets/img/brgy.hall1.jpg); background-repeat: no-repeat;
	background-size: cover;
	background-position: center;">
	  <div class="col-md-12">
	   		 <?php
	   		 
                if (isset($_POST['timein'])) {
                	$idemp= $_POST['inputid'];
           date_default_timezone_set("Asia/manila"); 
          $time = date('y-m-d');
          $timeds = date('y-m-d');
          
          $late = date('H:i:s');
          $orastime = date('H:i:s');
			$5pm = date('H:i:s');

                	 $onlyone = "SELECT * FROM employee_info WHERE emp_id ='$idemp'";
                                      $result = mysqli_query($con, $onlyone);
                                        if (!empty($idemp)) {
                                        	if(mysqli_num_rows($result) > 0){
                                       $onlyone = "SELECT * FROM `attendance` WHERE emp_id ='$idemp' AND time_in='$time'";
                                      $result = mysqli_query($con, $onlyone);
                                        		if (mysqli_num_rows($result) > 0) {
                                        			 ?>
                                       <script>
                                           window.location = "attendance.php?donetime_in=donetime_in";
                                       </script>
                                       <?php
                                        		}else{
								if($5pm >= '17:00:00'){
									echo "<div class='fw-bold alert alert-danger py-2 px-2 text-center'><a class='btn-close  float-end'></a>Invalid Time In</div>";
								}else{
									if ($late >= '08:00:00') {
                                        				 $insert_sql = "INSERT INTO `attendance`(`emp_id`,`time_in`,`hour_in`,`status`) VALUES ('$idemp','$timeds','$orastime','Late Time In')";
                	$totaldays=mysqli_query($con, $insert_sql);
                	if ($totaldays) {
                		$onlyone = "SELECT * FROM `countofdays` WHERE days ='$time'";
                                      $result = mysqli_query($con, $onlyone);
                                      if(mysqli_num_rows($result) > 0){

                                      	?>
                                       <script>
                                           window.location = "attendance.php?msginsert=inserted";
                                       </script>
                                       <?php

                                      }else{

                                          $insert_sql ="INSERT INTO `countofdays`(`days`) VALUES ('$time')";
                                          mysqli_query($con, $insert_sql);
                                          	?>
                                       <script>
                                           window.location = "attendance.php?msginsert=inserted";
                                       </script>
                                       <?php
                                      }



                		
                	}
                                        			}else{
                                        				 $insert_sql = "INSERT INTO `attendance`(`emp_id`,`time_in`,`hour_in`,`status`) VALUES ('$idemp','$timeds','$orastime','On Time')";
                	$totaldays=mysqli_query($con, $insert_sql);
                	if ($totaldays) {
                		$onlyone = "SELECT * FROM `countofdays` WHERE days ='$time'";
                                      $result = mysqli_query($con, $onlyone);
                                      if(mysqli_num_rows($result) > 0){

                                      	?>
                                       <script>
                                           window.location = "attendance.php?msginsert=inserted";
                                       </script>
                                       <?php

                                      }else{

                                          $insert_sql ="INSERT INTO `countofdays`(`days`) VALUES ('$time')";
                                          mysqli_query($con, $insert_sql);
                                          	?>
                                       <script>
                                           window.location = "attendance.php?msginsert=inserted";
                                       </script>
                                       <?php
                                      }



                		
                	}
                                        			}
								}
                                        			
                                        			
                                     
                	 
                                        		}
                                        }else{
                                        	 header("location:attendance.php?timeinvalid=invalid");
							
                                        	         

                                        }
                                        }else{
                                        	?>
                                       <script>
                                           window.location = "attendance.php?msgempty_in=empty_in";
                                       </script>
                                       <?php
                                        }
                	

                	
                }

                 ?>
                 <?php
	   		 
                if (isset($_POST['timeout'])) {
                	$idemp= $_POST['inputid'];
           date_default_timezone_set("Asia/manila"); 
          $time = date('F d, Y h:i A');
          $datein = date('y-m-d');


                	 $onlyone = "SELECT * FROM employee_info WHERE emp_id ='$idemp'";
                                      $result = mysqli_query($con, $onlyone);
                                        if (!empty($idemp)) {
                                        	if(mysqli_num_rows($result) > 0){

                                       $onlyones = "SELECT * FROM attendance WHERE emp_id ='$idemp' AND time_in ='$datein'";
                                      $results = mysqli_query($con, $onlyones);
                                        	if(mysqli_num_rows($results) > 0){
                                        		  $insert_sql = "UPDATE `attendance` SET `time_out`='$time' WHERE emp_id ='$idemp' AND time_in ='$datein'";
                	        mysqli_query($con, $insert_sql);
                	             ?>
                                       <script>
                                           window.location = "attendance.php?msgtime_out=time_out";
                                       </script>
                                       <?php
                                        	}else{
                                        		?>
                                       <script>
                                           window.location = "attendance.php?msgtimein=empty_in";
                                       </script>
                                       <?php
                                        
                                        	}

                               
                                        		
                                        }else{
                                        	 header("location:attendance.php?timeinvalid=invalid");
                                        	         

                                        }
                                        }else{
                                        	?>
                                       <script>
                                           window.location = "attendance.php?msgempty_in=empty_in";
                                       </script>
                                       <?php
                                        }
                	

                	
                }

                 ?>
				<div class="row">
	   	<div class="col-md-4"></div>
	   	<div class="col-md-4 mb-12">
    		<div class="card py-3 px-3 cb1 ">
    			<div class="card-header">
    			 	<a href="index.php" class="btn-close float-end" ></a>
                        <span aria-hidden="true"></span>
                     	
                   <div class="text-center px-5 py-1">
    					<h3 class="card-title mb-1"><strong class="fw-bold"> Attendance</strong></h3>
    					
    						</div>
    						  
                        <div class="clock text-center fs-4" style="font-size: 1rem; color: #fff;">
                        	<strong ><?php echo date('F d, Y') ?>  <strong id="time"></strong></strong>
                            
                        </div>
                       
                    
                </div>
               

    						<div class="card-body">



	
		



			<div class="bg-transparent" style="width: 100%;">
    	<!-- <div class="col-md-12 d-flex justify-content-center"> -->
				

			
			<form  class="form" method="post" autocomplete="off">
    					    
    			
    			

             <div class="col-md-12">
		     	<?php 
    if (isset($_GET['msgtimein'])=="time_in") {
	     echo "<div class='fw-bold alert alert-danger py-2 px-2 text-center'><a href='attendance.php' class='btn-close  float-end'></a>You Must Time in First</div>";
    // echo '<script>swal("ERROR !", "You Must Time in First", "warning")</script>';
}



     ?>
	<?php 
    if (isset($_GET['msgtime_out'])=="time_out") {
	     echo "<div class='alert alert-success py-2 px-2 fw-bold text-center text-dark'><a href='attendance.php' class='btn-close float-end'></a>TIME OUT!</div>";
    // echo '<script>swal("TIME OUT!", "Employee Attendance", "success")</script>';
}


     ?>
	<?php 
    if (isset($_GET['donetime_in'])=="donetime_in") {
	     echo "<div class='alert alert-danger fw-bold py-2 px-2 text-center'><a href='attendance.php' class='btn-close float-end'></a>The Employee ID is already Time in</div>";
    // echo '<script>swal("ERROR !", "The Employee ID is already Time in", "warning")</script>';
}



     ?>
	<?php 
    if (isset($_GET['msginsert'])=="inserted") {
	     echo "<div class='fw-bold alert alert-success py-2 px-2 text-center text-dark'><a href='attendance.php' class='btn-close float-end'></a>TIME IN!</div>";
    // echo '<script>swal("TIME IN!", "Employee Attendance", "success")</script>';
}



     ?>
     <?php 
    if (isset($_GET['timeinvalid'])=="invalid") {
 echo "<div class='alert alert-danger fw-bold py-2 px-2 text-center'><a href='attendance.php' class='btn-close float-end'></a>Invalid Employee ID</div>";
	    
    // echo '<script>swal("ERROR !", "Invalid Employee ID", "warning")</script>';
}



     ?>
       <?php 
    if (isset($_GET['msgempty_in'])=="empty_in") {
	    echo "<div class='alert alert-danger fw-bold py-2 px-2 text-center'><a href='attendance.php' class=' btn-close float-end'></a>Please Enter Employee ID</div>";
    // echo '<script>swal("ERROR !", "Please Enter Employee ID", "warning")</script>';
}



     ?>
	<div class="row">
		<div class="col-md-4"></div><div class="col-md-4"><strong class="fs-6">Employee ID</strong></div> <div class="col-md-4"></div>
                      <div class="col-md-1"></div><div class="col-md-10"><input  type="text" name="inputid" placeholder="Enter Employee ID" class="form-control" style="background: #fff; border-radius: 7px;"></div><div class="col-md-1"></div>
                      <div class="col-md-1"></div>
                      <div class="col-md-5">
                      	 <div class="text-center py-3">
    			<button  type="submit" name="timein" class="btn text-light" style="width: 100%; background: blue; border-radius: 7px;"><i class="fas fa-sign-in-alt me-1" ></i><strong>Time In</strong></button>
    		</div>
                      </div>  
                      <div class="col-md-5">
                      	 <div class="text-center py-3">
    			<button type="submit" name="timeout" class="btn text-light btn-success" style="width: 100%; border-radius: 7px;"><i class="fas fa-sign-out-alt me-1" ></i><strong>Time Out</strong></button>
    		</div>
                      </div>
                      <div class="col-md-1"></div>
                     
		
	</div>
	
</div>
				 

                       
                         	
    		
    		
                                    </form>
                                
    	
    
    			
    		

    		


    	</div>
    	</div>
    	
    

					

				<!-- </div> -->


				

			</div>
	   		

	   	</div>
	   	<div class="col-md-4"></div>



		</div>

	</div>
	<!-- </div> -->
<!--  -->
	 
	  
	



	</main>










  <script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.bundle.js"></script>
<script src="./assets/js/mdb.js"></script>
 <script>
                            function updateTime(){
                            	var time = new Date();
                                const now = new Date();
                                const timeElement = document.getElementById('time');
                                timeElement.textContent = now.toLocaleTimeString();
                            }
                            setInterval(updateTime, 1000);
                        </script>




</body>
</html>
