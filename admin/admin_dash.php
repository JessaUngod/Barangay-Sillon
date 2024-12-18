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
        .col-xl-2, .col-md-6 {
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
</head>
<body>
    <!-- Content -->
    <div class="content">
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
    </div>
</body>
</html>
