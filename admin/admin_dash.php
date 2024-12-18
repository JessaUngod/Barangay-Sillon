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
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding: 25px;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #2c3e50;
            color: #fff;
            width: 250px;
            position: fixed;
            height: 100%;
            top: 0;
            left: -250px;
            transition: 0.3s;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar ul {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .sidebar ul li {
            padding: 15px;
            border-bottom: 1px solid #34495e;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li.active, .sidebar ul li:hover {
            background-color: #34495e;
        }

        .sidebar .header-box {
            padding: 15px;
            border-bottom: 2px solid #34495e;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-nav {
            display: flex;
            align-items: center;
        }

        .navbar .nav-item .nav-link {
            color: #000;
            font-weight: bold;
        }

        .navbar .nav-item .nav-link:hover {
            color: #3498db;
        }

        /* Card Styles */
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 20px;
            color: white;
            position: relative;
            text-align: center;
        }

        .card-body:before {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            z-index: -1;
        }

        .card-title {
            font-size: 1.2em;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
        }

        .card-icon {
            font-size: 3em;
            padding: 15px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card-icon.bg-primary { background-color: #3498db; }
        .card-icon.bg-warning { background-color: #f39c12; }
        .card-icon.bg-danger { background-color: #e74c3c; }
        .card-icon.bg-success { background-color: #2ecc71; }

        /* Responsive Design */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col-md-3 {
            flex: 1 1 22%;
            max-width: 22%;
        }

        .col-md-3 .card {
            margin-bottom: 20px;
        }

        @media (max-width: 992px) {
            .col-md-3 {
                flex: 1 1 45%;
                max-width: 45%;
            }
        }

        @media (max-width: 768px) {
            .col-md-3 {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }

    </style>
</head>
<body>
    <?php 
    if (isset($_GET['msg']) && $_GET['msg'] == "login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong>Barangay Sillon</strong></h1>
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
        </div>

        <!-- Content -->
        <div class="content" style="margin-left: 250px; flex-grow: 1;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                        <strong style="font-size:22px;">Admin</strong>
                    </div>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <img src="../uploads/<?php echo $row['img']; ?>" class="rounded-circle" style="height: 40px; width: 40px;">
                                <span class="small fw-bold"><?php echo $row['fname']; ?></span>
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in px-4" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-target="#setModal" data-toggle="modal"><i class="fas fa-location-dot"></i> Set Location</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <h1 class="text-gray-800 mb-4">Dashboard</h1>

            <!-- Dashboard Stats Cards -->
            <div class="row">
                <!-- Admin Card -->
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <?php
                            $sql22 = "SELECT * FROM `admin`";
                            $oks22 = mysqli_query($con, $sql22);
                            $res22 = mysqli_num_rows($oks22);
                            ?>
                            <h4><?php echo $res22; ?></h4>
                            <i class="fas fa-user card-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Staff Card -->
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Staff</h5>
                            <?php
                            $sql22 = "SELECT * FROM `staff`";
                            $oks22 = mysqli_query($con, $sql22);
                            $res22 = mysqli_num_rows($oks22);
                            ?>
                            <h4><?php echo $res22; ?></h4>
                            <i class="fas fa-users card-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Employees Card -->
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Employees</h5>
                            <?php
                            $sql22 = "SELECT * FROM `employee_info`";
                            $oks22 = mysqli_query($con, $sql22);
                            $res22 = mysqli_num_rows($oks22);
                            ?>
                            <h4><?php echo $res22; ?></h4>
                            <i class="fas fa-users card-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Payrolls Card -->
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h5 class="card-title">Payrolls</h5>
                            <?php
                            $sql22 = "SELECT * FROM `payroll`";
                            $oks22 = mysqli_query($con, $sql22);
                            $res22 = mysqli_num_rows($oks22);
                            ?>
                            <h4><?php echo $res22; ?></h4>
                            <i class="fas fa-money-bill-alt card-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
