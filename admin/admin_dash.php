

<?php 

require_once'../db.php';


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
     <link rel="stylesheet" href="../assets/css/de.css">
     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
     <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
     <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
     <script type="text/javascript" src="../assets/js/apexchart.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px; /* Sidebar hidden initially */
            height: 100%;
            background-color: #333;
            color: white;
            transition: 0.3s;
        }

        /* Sidebar active (visible) */
        .sidebar.active {
            left: 0; /* When active, move sidebar into view */
        }

        .sidebar ul {
            list-style-type: none;
            padding-left: 0;
        }

        .sidebar ul li {
            padding: 15px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li:hover {
            background-color: #444;
        }

        .sidebar ul li.active {
            background-color: #555;
        }

        /* Navbar styling */
        .navbar-toggler {
            background-color: #000;
        }

        /* Mobile View Styling */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }

            /* When sidebar is active, shift content */
            .sidebar.active + .content {
                margin-left: 250px;
            }

            .navbar-toggler {
                display: block;
            }

            .close-btn {
                display: block;
                background-color: #000;
                color: white;
                border: none;
                font-size: 24px;
                cursor: pointer;
            }

            .d-md-none {
                display: block;
            }

            .d-md-block {
                display: none;
            }
        }
    </style>

</head>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
    echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
}



     ?>


div class="sidebar" id="side_nav">
        <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
            <h1 class="fs-5">
                <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
                <strong style="color: #fff;">Barangay Sillon</strong>
            </h1>

            <!-- Hamburger button to toggle sidebar -->
            <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <ul class="list-unstyled px-3">
            <li class="active"><a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
            <li><a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-pencil"></i> Payroll</a></li>
            <li><a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-book-open"></i> Reports</a></li>
            <li><a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-bar-chart"></i> Positions</a></li>
            <li><a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-user"></i> Accounts</a></li>
            <li><a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-clock"></i> Login / Logout</a></li>
        </ul>
        <hr class="h-color mx-2">
    </div>

    <!-- Content Area -->
    <div class="content" style="padding: 20px; flex-grow: 1;">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <div class="container-fluid">
                <!-- Mobile view navbar toggle button -->
                <div class="d-flex justify-content-between d-md-none d-block">
                    <button class="btn px-1 py-0 open-btn me-2" id="navbarToggle" style="background-color: #000;">
                        <i class="fas fa-bars" style="width: 30px; color: #fff;"></i>
                    </button>
                    <a href="#" class="text-decoration-none">
                        <strong style="font-size: 28px;">Admin</strong>
                    </a>
                </div>


                    </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
        
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                   <?php 

        if(!empty($_SESSION['idadmins'])){
           $id = $_SESSION['idadmins'];
           $result = mysqli_query($con, "SELECT * FROM admin WHERE id = $id");
           $row = mysqli_fetch_assoc($result);
         }else{
           header("Location: ./index.php");
         }



?> 
 <?php 

if(!empty($_SESSION['idadmins'])){


         $onlyone = "SELECT * FROM `attendance`";
                 $result = mysqli_query($con, $onlyone);
      if(mysqli_num_rows($result) > 0){
         

          }else{
            $all ="DELETE FROM `countofdays`";
            mysqli_query($con, $all);


          }
          }
         
      

                 ?>
 

                <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline  small " style="color: #000;">
                               Hello,</span>
                               <span class="mr-2 d-lg-inline  small ">
                                <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" >
                                   
                               </span>
                                <span class="mr-2 d-lg-inline  small fw-bold"  style="color: #000;">
                                    <?php echo $row['fname']; ?>                                
                                         </span>
                                
                            </a>

                              <div class="dropdown-menu  shadow animated-grow-in px-4"
                                aria-labelledby="userDropdown"> 
                                 <div class="dropdown-divider"></div>
                                 
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Logout</strong>
                                </a>
                               <div class="dropdown-divider"></div>
                            </div>




                        </li>
        </ul>

            
                </div>
                
            </nav>
   <div class="container-fluid">

                           <h1 class=" fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Dashboard</strong></h1>
<div class="row">
                 


                           <div class="col-xl-2 col-md-6 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                          
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a >Admin</a> </strong> </div>
                                               
                                               <?php error_reporting(0);

$sql22 = "SELECT * FROM `admin`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);
  

  

   
 




?>
                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res22; ?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                          <div class="col-xl-2 col-md-6 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a >Staff</a> </strong> </div>
                                                 <?php error_reporting(0);

$sql22 = "SELECT * FROM `staff`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);


  

   
 




?>
                                               
                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res22; ?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                          <div class="col-md-3 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">
                                  

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a>Total Employee</a> </strong> </div>
                                               <?php error_reporting(0);

$sql22 = "SELECT * FROM `employee_info`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);

  

   
 




?>
                                            <div class="h5 mb-0  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res22; ?> </strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2  mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a >Time In</a> </strong> </div>
                                              <?php error_reporting(0);
                                                date_default_timezone_set("Asia/manila");  
                                               
                                                $datein = date('y-m-d');

                                                 $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res226 = mysqli_num_rows($oks22);
                                                   



                                                 ?>
                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res226; ?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
               
                  <div class=" col-md-3 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">
                                  

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a>Total Absent</a> </strong> </div>
                                         <?php $total =0;
                                            $total = $res22 - $res226;
                                             ?> 
                                               
                                            <div class="h5 mb-0  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $total; ?> </strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
  </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            
                           
                           
                            <div class="card-header fw-bold" style="font-size: 30px;">  
                                  <form method="post" >
                                 <div class="row">
                            
                                     

                                     
                                 </div>

                                    
                                </form>
                            </div>
                            <div class="card-body">


                                <div  id="chart"> </div>

                            </div>
                              

                            <script type="text/javascript">
                                 var options = {
                                chart: {
                                    type: 'bar'
                                },
                                series:[{
                                    name: 'Count',
                                    data: [
                                        <?php error_reporting(0);

$sql22 = "SELECT * FROM `admin`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);
   echo $res22;

  

   
 




?>,
           <?php error_reporting(0);

$sql22 = "SELECT * FROM `staff`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);
   echo $res22;

  

   
 




?>,
<?php error_reporting(0);

$sql22 = "SELECT * FROM `employee_info`";

   $oks22 = mysqli_query($con, $sql22);

   $res22 = mysqli_num_rows($oks22);
   echo $res22;

  

   
 




?>,
<?php error_reporting(0);
                                                date_default_timezone_set("Asia/manila");  
                                               
                                                $datein = date('y-m-d');

                                                 $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res226 = mysqli_num_rows($oks22);
                                                    echo $res226;



                                                 ?>,
                                                 <?php $total =0;
                                            $total = $res22 - $res226;
                                            echo $total; ?>                                      
                                        
                                         
                                          ]
                                }],
                                xaxis: {
                                    categories: ['Admin','Staff','Total Empoyee', 'Total Time In', 'Total Absent']
                                }
                            }
                            var chart = new ApexCharts(document.querySelector("#chart"), options);

                            chart.render();
                            </script>
                        </div>
                    </div>
                <div class="col-md-2"></div>

                </div>
                </div>


            </div>
                
                    
        

   






    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Logout</strong></h5>
                  <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body text-center"><strong>Are you sure you want to Logout ?</strong></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="color: #000;">Cancel</button>
                    <a class="btn " style="color: #000; background: skyblue;" href="logout.php" name="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>


   <script src="../assets/js/jquery.min.js"></script>
   <script src="../assets/js/bootstrap.bundle.js"></script>
 <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="../vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
  <!-- <script src="../assets/js/jquery.min.js"></script> -->
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/mdb.js"></script>
<!-- <script src="../js/demo/datatables-demo.js"></script> -->
<script src="../vendor/datatables/dataTable.js"></script>

<script>
        // When the close button (hamburger) is clicked, toggle the sidebar
        document.querySelector('.close-btn').addEventListener('click', function() {
            document.getElementById('side_nav').classList.toggle('active');
        });

        // Optional: If you want to close the sidebar when a link is clicked
        document.querySelectorAll(".sidebar-menu li").forEach(function(item) {
            item.addEventListener('click', function() {
                document.querySelector(".sidebar-menu li.active")?.classList.remove('active');
                item.classList.add('active');
                document.getElementById('side_nav').classList.remove('active'); // Close the sidebar when a link is clicked
            });
        });
    </script>



</body>
</html>
