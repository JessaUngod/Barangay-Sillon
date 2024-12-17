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
        /* Base Card Styling */
        .card {
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            overflow: hidden;
            background-color: #fff;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 20px;
            text-align: center;
        }

        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.5em;
            font-weight: bold;
        }

        .card-icon {
            font-size: 2.5em;
            color: #fff;
            background: rgba(0, 0, 0, 0.15);
            border-radius: 50%;
            padding: 15px;
            margin-bottom: 15px;
        }

        /* Card Specific Background Colors */
        .bg-primary {
            background-color: #007bff;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: white;
        }

        .bg-warning {
            background-color: #ffc107;
            background: linear-gradient(45deg, #ffc107, #ff9f00);
            color: black;
        }

        .bg-success {
            background-color: #28a745;
            background: linear-gradient(45deg, #28a745, #2bba72);
            color: white;
        }

        .bg-danger {
            background-color: #dc3545;
            background: linear-gradient(45deg, #dc3545, #ff4c6a);
            color: white;
        }

        .bg-info {
            background-color: #17a2b8;
            background: linear-gradient(45deg, #17a2b8, #65c0d3);
            color: white;
        }

        /* Text Color Styling */
        .text-white {
            color: #fff;
        }

        .h5 {
            font-size: 2.5em;
            font-weight: bold;
        }

        /* Additional Style for Dashboard Header */
        h1 {
            font-size: 2.5em;
            font-weight: 600;
            color: #333;
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
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="card-title">Admin</div>
                                <?php
                                $sql22 = "SELECT * FROM `admin`";
                                $oks22 = mysqli_query($con, $sql22);
                                $res22 = mysqli_num_rows($oks22);
                                ?>
                                <div class="card-text"> <strong><?php echo $res22; ?></strong> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-title">Staff</div>
                                <?php
                                $sql22 = "SELECT * FROM `staff`";
                                $oks22 = mysqli_query($con, $sql22);
                                $res22 = mysqli_num_rows($oks22);
                                ?>
                                <div class="card-text"> <strong><?php echo $res22; ?></strong> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-title">Total Employee</div>
                                <?php
                                $sql22 = "SELECT * FROM `employee_info`";
                                $oks22 = mysqli_query($con, $sql22);
                                $res22 = mysqli_num_rows($oks22);
                                ?>
                                <div class="card-text"> <strong><?php echo $res22; ?></strong> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-4">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="card-title">Time In</div>
                                <?php
                                date_default_timezone_set("Asia/manila");
                                $datein = date('y-m-d');
                                $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";
                                $oks22 = mysqli_query($con, $sql22);
                                $res226 = mysqli_num_rows($oks22);
                                ?>
                                <div class="card-text"> <strong><?php echo $res226; ?></strong> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 mb-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-title">Total Absent</div>
                                <?php 
                                $total = $res22 - $res226;
                                ?>
                                <div class="card-text"> <strong><?php echo $total; ?></strong> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
