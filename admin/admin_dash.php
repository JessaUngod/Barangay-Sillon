<?php  
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/CSS/style1.css">
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/de.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/apexchart.js"></script>
</head>
<style>
    .card {
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
}

.card-body {
    padding: 25px;
    background: linear-gradient(to bottom right, #3498db, #8e44ad, #f39c12);
    background-size: 200% 200%;
    background-position: 0% 50%;
    border-radius: 15px;
    color: white;
    position: relative;
}

.card-body:before {
    content: '';
    position: absolute;
    top: 10px;
    left: 10px;
    right: 10px;
    bottom: 10px;
    background: rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    z-index: -1;
}

.card-title {
    font-size: 1.4em;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.card-footer {
    background-color: #f8f9fa;
    padding: 15px;
    border-top: 1px solid #ddd;
    border-radius: 0 0 15px 15px;
}

.card-icon {
    font-size: 3.5em;
    color: #ffffff;
    padding: 15px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.card-icon.bg-primary { background-color: #3498db; }
.card-icon.bg-warning { background-color: #f39c12; }
.card-icon.bg-danger { background-color: #e74c3c; }
.card-icon.bg-success { background-color: #2ecc71; }

.text-white {
    color: white !important;
}

.fw-bold {
    font-weight: 600 !important;
}

.h5 {
    font-size: 1.4rem;
}

.row {
    margin-top: 25px;
}

/* Responsive adjustments */
.col-xl-2, .col-md-3 {
    padding: 10px;
}


@media (max-width: 1200px) {
    .col-xl-2 {
        width: 25%;
    }
}

@media (max-width: 992px) {
    .col-xl-2 {
        width: 33.33%;
    }
    .col-md-2 {
        width: 50%;
    }
}

@media (max-width: 768px) {
    .col-xl-2, .col-md-2, .col-md-3 {
        width: 100%;
    }
    
    
}
</style>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="side_nav" style="background-color: #240750;"> 
    <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
        <h1 class="fs-5">
            <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
            <strong style="color: #fff;">Barangay Sillon</strong>
        </h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="list-unstyled px-3">
        <li class="active">
            <a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block" style="color: black;"> 
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-users"></i> Employees
            </a>
        </li>
        <li>
            <a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-pencil"></i> Payroll
            </a>
        </li>
        <li>
            <a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-book-open"></i> Reports
            </a>
        </li>
        <li>
            <a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-bar-chart"></i> Positions
            </a>
        </li>
        <li>
            <a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-user"></i> Accounts
            </a>
        </li>
        <li>
            <a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-clock"></i> Login / Logout
            </a>
        </li>
    </ul>
    
</div>


        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light" style="background-color: #240750;" topbar mb-4 static-top shadow>
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                        <strong style="font-size:22px;">Admin</strong>
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-lg-inline small" style="color: #fff; font-family: 'Poppins', sans-serif; font-size: 30px;">Hello</span>

                                <span class="mr-2 d-lg-inline small">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" >
                                </span>
                                <span class="mr-2 d-lg-inline small" style="color: #fff; font-family: 'Poppins', sans-serif; font-size: 20px;;"><?php echo $row['fname']; ?></span>
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in px-4" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"  data-target="#setModal" data-toggle="modal">
                                    <i class="fas fa-solid fa-location-dot fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Set Location</strong>
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Logout</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 class="fw-bold mb-4 text-gray-800 fs-3" style="color: #000;"><strong>Dashboard</strong></h1>
                
                <!-- Dashboard Stats Cards -->
                <div class="row">
                    <!-- Admin Card -->
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body bg-primary">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Admin</div>
                                        <?php
                                        $sql22 = "SELECT * FROM `admin`";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res22 = mysqli_num_rows($oks22);
                                        $currLoc = mysqli_fetch_assoc($oks22);
                                        ?>
                                        <div class="h5 mb-0 fs-5"> <strong><?php echo $res22; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Card -->
                    <div class="col-xl-2 col-md-6 mb-4">
                    <a href="employee.php" style="text-decoration: none;">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Staff</div>
                                        <?php
                                        $sql22 = "SELECT * FROM `staff`";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res22 = mysqli_num_rows($oks22);
                                        ?>
                                        <div class="h5 mb-0 fs-5"> <strong><?php echo $res22; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Employees Card -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-success">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Total Employee</div>
                                        <?php
                                        $sql22 = "SELECT * FROM `employee_info`";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res22 = mysqli_num_rows($oks22);
                                        ?>
                                        <div class="h5 mb-0"> <strong><?php echo $res22; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time In Card -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-danger">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Time In</div>
                                        <?php
                                        date_default_timezone_set("Asia/manila");
                                        $datein = date('y-m-d');
                                        $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res226 = mysqli_num_rows($oks22);
                                        ?>
                                        <div class="h5 mb-0 fs-5"> <strong><?php echo $res226; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Absent Card -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-info">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Total Absent</div>
                                        <?php 
                                        $total = $res22 - $res226;
                                        ?>
                                        <div class="h5 mb-0"> <strong><?php echo $total; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users card-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 <!-- Chart Container (Below the cards) -->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-body bg-light">
                <h5 class="card-title text-center">Employee Attendance Overview</h5>
                <!-- ApexChart div container -->
                <div id="attendance-chart"></div>
            </div>
        </div>
    </div>
</div>

<script>
    // Prepare the chart data and options
    var options = {
        series: [{
            name: 'Employees',
            data: [
                <?php echo $res22; ?>, // Admin count
                <?php echo $res22; ?>, // Staff count
                <?php echo $res22; ?>, // Total Employee count
                <?php echo $res226; ?>, // Time In count
                <?php echo $total; ?>  // Total Absent count// Example for each day of the week
            ]
        }, {
            name: 'Absent',
            data: [
               <?php echo $res22; ?>, // Admin count
                <?php echo $res22; ?>, // Staff count
                <?php echo $res22; ?>, // Total Employee count
                <?php echo $res226; ?>, // Time In count
                <?php echo $total; ?>  // Total Absent count
            ]
        }],
        chart: {
            height: 350,
            type: 'line',
        },
        xaxis: {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        },
        title: {
            text: 'Employee Attendance by Day',
            align: 'center',
            style: {
                fontSize: '18px',
                fontWeight: 'bold',
                color: '#333'
            }
        },
        stroke: {
            width: 2,
        },
        markers: {
            size: 6,
            colors: ["#ffffff"],
            strokeColor: "#ff4560",
            strokeWidth: 3
        },
        colors: ["#00E396", "#FF4560"], // Colors for the two series
        grid: {
            borderColor: '#f1f1f1',
        }
    };

    var chart = new ApexCharts(document.querySelector("#attendance-chart"), options);
    chart.render();
</script>
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
    <script>
        if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('status').textContent = `Latitude: ${position.coords.latitude} Longitude: ${position.coords.longitude}`;
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        }, function() {
            document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
        });
        } else {
            document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
        }
    </script>
    <div class="modal fade " id="setModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"><strong>Set Location</strong></h5>
                  <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                  </button>
                </div>
                <form action="admin_dash.php" method="POST">
                <div class="modal-body text-center">
                    <?php
                    $lon;
                    $lan;
                    list($lon, $lan) = explode(',', $currLoc["location"]);
                    ?>
                    <strong>
                        <label>Default location</label>
                    </strong>
                    <p><?php echo "Latitude: ".$lon." Longitude: ".$lan ; ?></p>
                    <strong>
                        <label>Current location</label>
                    </strong>
                    <p id="status">na</p></div>
                <div class="modal-footer">
                    <input type="text" name="latitude" id="latitude"  hidden>
                    <input type="text" name="longitude" id="longitude"  hidden>
                     <input class="btn btn-information" type="submit"  value="Update Default Location To Current Location">
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $location = $latitude.",".$longitude;
        $update = $con->prepare("UPDATE `admin` SET `location` = ? WHERE `admin`.`id` = 1;");
        $update->bind_param("s", $location);
        if ($update->execute()) { 
            echo "<script>alert('Location updated successfully.')</script>"; 
        } 
        else { 
            echo "<script>alert('Error updating location: " . $update->error."')</script>";
        }
    }
    ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>
 <script>
    let table = new DataTable('#myTable', {
});

    $(".sidebar ul li").on('click' , function(){
        $(".sidebar ul li.active").removeClass('active');
        $(this).addClass('active');
    });
    $('.open-btn').on('click' , function(){
        $('.sidebar').addClass('active');
    });
    $('.close-btn').on('click' , function(){
        $('.sidebar').removeClass('active');
    });

   </script> 
   <script>
    $('.open-btn').on('click', function()  {
        $('#side_nav').addClass('active');
        $('.content').addClass('shift');
    });

    $('.close-btn').on('click', function()  {
        $('#side_nav').removeClass('active');
        $('.content').removeClass('shift');

    });


   </script>


</body>
</html>

        </div>
    </div>
    <!-- Add your scripts here -->
</body>
</html>
