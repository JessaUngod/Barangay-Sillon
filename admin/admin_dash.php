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
            background-color: #f8f9fa;
            color: #333;
        }

        .container-fluid {
            max-width: 100%;
            margin-top: 20px;
        }

        h1 {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #343a40;
            color: white;
            height: 100vh;
            width: 240px;
            position: fixed;
            transition: all 0.3s ease-in-out;
            padding-top: 40px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            border-bottom: 1px solid #494e54;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            display: block;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #007bff;
            padding-left: 30px;
        }

        .sidebar ul li.active a {
            background-color: #007bff;
            padding-left: 30px;
        }

        /* Card Styles */
        .card {
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 25px;
            background: linear-gradient(to bottom right, #007bff, #6c757d);
            border-radius: 10px;
            color: white;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 15px;
            border-top: 1px solid #ddd;
            border-radius: 0 0 10px 10px;
        }

        .card-icon {
            font-size: 2.5em;
            color: #ffffff;
            padding: 15px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card-icon.bg-primary { background-color: #3498db; }
        .card-icon.bg-warning { background-color: #f39c12; }
        .card-icon.bg-danger { background-color: #e74c3c; }
        .card-icon.bg-success { background-color: #2ecc71; }

        /* Navbar Styles */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .navbar .nav-item {
            margin-right: 20px;
        }

        .navbar .nav-item a {
            color: #007bff;
            font-weight: bold;
        }

        .navbar .nav-item a:hover {
            color: #0056b3;
        }

        /* Hover Effects on Cards */
        .card-body:hover {
            background: linear-gradient(to bottom right, #2980b9, #8e44ad);
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .row {
            margin-top: 30px;
        }

        .col-md-3, .col-md-2 {
            padding: 10px;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        /* Modal Styles */
        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn {
            background-color: #6c757d;
            color: white;
        }

        .modal-footer .btn:hover {
            background-color: #5a6268;
        }

        .modal-body {
            text-align: center;
        }

        /* DataTable Styles */
        .dataTable {
            width: 100% !important;
        }

        .dataTable td {
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            
            .sidebar ul li {
                padding: 10px;
            }

            .card {
                margin-bottom: 20px;
            }

            .col-md-2, .col-md-3, .col-xl-2 {
                flex: 1 1 100%;
                max-width: 100%;
                margin-bottom: 10px;
            }
            
            .navbar {
                font-size: 14px;
            }
            
            .navbar-nav {
                margin-top: 10px;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                margin-top: 10px;
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="../assets/img/<?php echo $row['admin_img']; ?>" style="width: 35px; height: 35px;">
                                <span class="d-none d-lg-inline text-gray-600 small"><?php echo strtoupper($row['fname']); ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../admin/profile.php">
                                    <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../admin/logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Cards Section -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Card for Admins -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-primary mb-3"><i class="fas fa-user-shield"></i></div>
                                <h5 class="card-title">Admins</h5>
                                <p class="fw-bold"><?php
                                    $adminCount = mysqli_query($con, "SELECT COUNT(*) FROM admin");
                                    $adminResult = mysqli_fetch_assoc($adminCount);
                                    echo $adminResult['COUNT(*)'];
                                    ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card for Staff -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-success mb-3"><i class="fas fa-users-cog"></i></div>
                                <h5 class="card-title">Staff</h5>
                                <p class="fw-bold"><?php
                                    $staffCount = mysqli_query($con, "SELECT COUNT(*) FROM staff");
                                    $staffResult = mysqli_fetch_assoc($staffCount);
                                    echo $staffResult['COUNT(*)'];
                                    ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Card for Employees -->
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-body text-center">
                                <div class="card-icon bg-warning mb-3"><i class="fas fa-users"></i></div>
                                <h5 class="card-title">Employees</h5>
                                <p class="fw-bold"><?php
                                    $employeeCount = mysqli_query($con, "SELECT COUNT(*) FROM employees");
                                    $employeeResult = mysqli_fetch_assoc($employeeCount);
                                    echo $employeeResult['COUNT(*)'];
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
</body>
</html>
