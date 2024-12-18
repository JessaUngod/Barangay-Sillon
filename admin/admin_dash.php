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
        /* Enhanced Card Styles */
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

        /* Sidebar Styles */
        .sidebar {
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 40px;
            transition: all 0.3s ease-in-out;
        }

        .sidebar h1 {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar-link {
            color: #ecf0f1;
            font-size: 16px;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out, padding-left 0.3s ease-in-out;
        }

        .sidebar-link:hover {
            background-color: #34495e;
            padding-left: 20px;
        }

        .sidebar .active a {
            background-color: #3498db; /* Active link color */
            color: white;
            padding-left: 20px;
        }

        .sidebar .sidebar-link i {
            margin-right: 10px;
        }

        .sidebar hr {
            border-color: #7f8c8d;
        }

        /* Responsive Sidebar Toggle */
        .close-btn {
            border: none;
            background-color: transparent;
            font-size: 20px;
        }

        /* Toggle Sidebar for Mobile */
        .sidebar.active {
            transform: translateX(-250px);
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
                <h1 class="fs-5">
                    <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
                    <strong style="color: #fff;">Barangay Sillon</strong>
                </h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <ul class="list-unstyled px-3">
                <li class="active">
                    <a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-users"></i> Employees
                    </a>
                </li>
                <li>
                    <a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-pencil"></i> Payroll
                    </a>
                </li>
                <li>
                    <a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-book-open"></i> Reports
                    </a>
                </li>
                <li>
                    <a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-bar-chart"></i> Positions
                    </a>
                </li>
                <li>
                    <a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-user"></i> Accounts
                    </a>
                </li>
                <li>
                    <a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block sidebar-link">
                        <i class="fas fa-clock"></i> Login / Logout
                    </a>
                </li>
            </ul>
            <hr class="h-color mx-2" style="border-color: #7f8c8d;">
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;">
                            <i class="fas fa-bars" style="width: 30px; color: #fff;"></i>
                        </button>
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

            <!-- Content goes here -->
        </div>
    </div>

    <!-- Scripts for Sidebar Toggle -->
    <script>
        document.getElementById("sidebar-toggle").addEventListener("click", function() {
            document.getElementById("side_nav").classList.toggle("active");
        });
    </script>
</body>
</html>
