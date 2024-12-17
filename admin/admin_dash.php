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
            font-family: Arial, sans-serif;
            background-color: #f8f9fc;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #8e44ad, #6f42c1); /* Purple gradient */
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 30px;
            color: white;
            position: relative;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            color: white;
            margin-bottom: 15px;
        }

        .card-footer {
            background-color: #5e3370; /* Darker shade for footer */
            padding: 10px;
            border-top: 1px solid #4b1d5f;
            border-radius: 0 0 12px 12px;
        }

        .card-icon {
            font-size: 2.5em;
            color: white;
            padding: 15px;
            border-radius: 50%;
            background-color: #9b59b6;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Custom Color Specific Icons */
        .bg-primary { background-color: #8e44ad; }
        .bg-warning { background-color: #e67e22; }
        .bg-danger { background-color: #e74c3c; }
        .bg-success { background-color: #2ecc71; }
        .bg-info { background-color: #1abc9c; }

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
                padding: 20px;
            }

            .card-title {
                font-size: 1rem;
            }

            .card-icon {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <!-- Sidebar content -->
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
                        <!-- User dropdown -->
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
                                        <i class="fas fa-users card-icon bg-light"></i>
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

            <!-- Modal for logout and setting location-->
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>

    <script>
        // Modal script and functionality here
    </script>

</body>
</html>
