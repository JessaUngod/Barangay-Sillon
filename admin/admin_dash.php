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
            max-width: 98%;
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
                <h1><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong>Barangay Sillon</strong></h1>
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
        <div class="content" style="margin-left: 240px;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light topbar shadow">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                        <strong style="font-size:22px;">Admin</strong>
                    </div>
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
                <h1 class="fw-bold mb-4 text-gray-800 fs-3" style="color: #000;">Dashboard</h1>
                
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
                                        $sql33 = "SELECT * FROM `staff`";
                                        $oks33 = mysqli_query($con, $sql33);
                                        $res33 = mysqli_num_rows($oks33);
                                        ?>
                                        <div class="h5 mb-0 fs-5"> <strong><?php echo $res33; ?></strong> </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users card-icon bg-light"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End row -->
            </div> <!-- End container-fluid -->

        </div> <!-- End content -->
    </div> <!-- End main-container-fluid -->

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
</body>
</html>
