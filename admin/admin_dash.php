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
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff; /* White background for cards */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 25px;
            color: #333;
            position: relative;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #333;
            margin-bottom: 10px;
        }

        .card-footer {
            background-color: #f1f1f1; /* Light gray for footer */
            padding: 10px;
            border-top: 1px solid #ddd;
            border-radius: 0 0 15px 15px;
        }

        .card-icon {
            font-size: 3em;
            color: #fff;
            padding: 20px;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .bg-primary { background-color: #007bff; }
        .bg-warning { background-color: #ffc107; }
        .bg-danger { background-color: #dc3545; }
        .bg-success { background-color: #28a745; }
        .bg-info { background-color: #17a2b8; }

        .text-white {
            color: white !important;
        }

        .fw-bold {
            font-weight: 600 !important;
        }

        .h5 {
            font-size: 1.5rem;
        }

        .row {
            margin-top: 20px;
        }

        /* Column Spacing */
        .col-md-3, .col-md-2 {
            padding: 15px;
        }

        .col-md-6 {
            padding: 20px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-body {
                padding: 15px;
            }

            .card-title {
                font-size: 1rem;
            }

            .card-icon {
                font-size: 2.5em;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <!-- Sidebar content -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user"></i>
                        <span>Users</span>
                    </a>
                </li>
                <!-- Add more sidebar items as needed -->
            </ul>
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">150</p>
                            </div>
                            <div class="card-footer">
                                <small>Updated just now</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h5 class="card-title">Sales</h5>
                                <p class="card-text">$2,500</p>
                            </div>
                            <div class="card-footer">
                                <small>Updated just now</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <h5 class="card-title">Feedback</h5>
                                <p class="card-text">45 new messages</p>
                            </div>
                            <div class="card-footer">
                                <small>Updated just now</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h5 class="card-title">Issues</h5>
                                <p class="card-text">3 critical issues</p>
                            </div>
                            <div class="card-footer">
                                <small>Updated just now</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/datatables.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#dataTable').DataTable();
        });
    </script>
</body>
</html>