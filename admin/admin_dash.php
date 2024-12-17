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
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/de.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
    <script type="text/javascript" src="../assets/js/apexchart.js"></script>
    <style>
    /* General Layout Enhancements */
    body {
        background-color: #f4f6f9;
        font-family: 'Arial', sans-serif;
    }

    .main-container-fluid {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    /* Sidebar Styling */
    .sidebar {
        background-color: #2c3e50;
        color: #fff;
        width: 250px;
        transition: all 0.3s ease-in-out;
        position: fixed;
        height: 100%;
        padding-top: 20px;
    }

    .sidebar.active {
        transform: translateX(0);
    }

    .sidebar ul li {
        list-style: none;
        margin: 10px 0;
    }

    .sidebar ul li a {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        display: block;
        transition: background-color 0.3s;
        border-radius: 5px;
    }

    .sidebar ul li a:hover, .sidebar ul li.active a {
        background-color: #1abc9c;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    .sidebar .header-box h1 {
        color: #fff;
        font-size: 20px;
        font-weight: bold;
    }

    .sidebar .header-box button {
        background-color: transparent;
        color: #fff;
    }

    /* Content Area Styling */
    .content {
        margin-left: 250px;
        transition: all 0.3s;
        padding: 30px;
        flex: 1;
    }

    .content.shift {
        margin-left: 0;
    }

    /* Navbar Enhancements */
    .navbar {
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-nav .nav-item .nav-link {
        color: #2c3e50;
        padding: 10px;
    }

    .navbar-nav .nav-item .nav-link:hover {
        background-color: #ecf0f1;
        border-radius: 5px;
    }

    .navbar-toggler {
        background-color: #2c3e50;
    }

    .navbar-toggler-icon {
        background-color: #fff;
    }

    .dropdown-menu {
        min-width: 180px;
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 10px rgba(0, 0, 0, 0.08);
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

    /* Button Styling */
    .btn {
        border-radius: 5px;
        padding: 10px 20px;
        text-align: center;
    }

    .btn:hover {
        opacity: 0.8;
    }

    .btn-secondary {
        background-color: #bdc3c7;
        color: #2c3e50;
    }

    .btn-information {
        background-color: #3498db;
        color: white;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: #3498db;
        color: white;
    }

    .modal-footer button {
        border-radius: 5px;
    }
</style>

</head>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon</strong></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
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

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
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
                                <span class="mr-2 d-lg-inline small" style="color: #000;">Hello,</span>
                                <span class="mr-2 d-lg-inline small">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" >
                                </span>
                                <span class="mr-2 d-lg-inline small fw-bold" style="color: #000;"><?php echo $row['fname']; ?></span>
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
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body bg-primary">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold mb-1" style="font-size: 0.9em;">Admin</div>
                                        <?php
                                        $sql22 = "SELECT * FROM `admin`";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res22 = mysqli_num_rows($oks22);
                                        ?>
                                        <div class="h5 mb-0 fs-5"> <strong><?php echo $res22; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Staff Card -->
                    <div class="col-xl-2 col-md-6 mb-4">
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
                                        <i class="fas fa-user card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Employees Card -->
                    <div class="col-md-3 mb-4">
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
                                        <i class="fas fa-users card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time In Card -->
                    <div class="col-md-2 mb-4">
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
                                        <i class="fas fa-clock card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Absent Card -->
                    <div class="col-md-3 mb-4">
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
                                        <i class="fas fa-users card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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