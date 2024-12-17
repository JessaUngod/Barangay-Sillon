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
</head>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>
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

        <div class="content">
            <!-- Header and Navbar code -->

            <div class="container-fluid">
                <h1 class="fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Dashboard</strong></h1>

                <!-- Dashboard Cards -->
                <div class="row">
                    <!-- Dynamic Cards for Admin, Staff, Total Employees, etc. -->
                    <!-- Code for the dynamic data display goes here as per your requirement -->
                </div>

                <!-- Apex Chart -->
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header fw-bold" style="font-size: 30px;">  
                                <form method="post">
                                    <div class="row"></div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                            <script type="text/javascript">
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: 350,
                                        toolbar: {
                                            show: false
                                        },
                                        zoom: {
                                            enabled: true
                                        },
                                    },
                                    series: [{
                                        name: 'Count',
                                        data: [
                                            <?php 
                                            $sql22 = "SELECT * FROM `admin`";
                                            $oks22 = mysqli_query($con, $sql22);
                                            $res22 = mysqli_num_rows($oks22);
                                            echo $res22;
                                            ?>,
                                            <?php 
                                            $sql22 = "SELECT * FROM `staff`";
                                            $oks22 = mysqli_query($con, $sql22);
                                            $res22 = mysqli_num_rows($oks22);
                                            echo $res22;
                                            ?>,
                                            <?php 
                                            $sql22 = "SELECT * FROM `employee_info`";
                                            $oks22 = mysqli_query($con, $sql22);
                                            $res22 = mysqli_num_rows($oks22);
                                            echo $res22;
                                            ?>,
                                            <?php 
                                            date_default_timezone_set("Asia/Manila");  
                                            $datein = date('y-m-d');
                                            $sql22 = "SELECT * FROM `attendance` WHERE time_in = '$datein'";
                                            $oks22 = mysqli_query($con, $sql22);
                                            $res226 = mysqli_num_rows($oks22);
                                            echo $res226;
                                            ?>,
                                            <?php 
                                            $total = 0;
                                            $total = $res22 - $res226;
                                            echo $total;
                                            ?>
                                        ]
                                    }],
                                    xaxis: {
                                        categories: ['Admin','Staff','Total Employees', 'Total Time In', 'Total Absent'],
                                        labels: {
                                            style: {
                                                fontSize: '14px',
                                                fontWeight: 'bold',
                                                fontFamily: 'Arial, sans-serif',
                                                colors: ['#5D5D5D']
                                            }
                                        },
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Count',
                                            style: {
                                                fontSize: '16px',
                                                fontWeight: 'bold',
                                                fontFamily: 'Arial, sans-serif'
                                            }
                                        }
                                    },
                                    plotOptions: {
                                        bar: {
                                            horizontal: false,
                                            endingShape: 'rounded',
                                            columnWidth: '55%'
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    fill: {
                                        colors: ['#007bff', '#28a745', '#dc3545', '#ffc107', '#17a2b8']
                                    },
                                    tooltip: {
                                        y: {
                                            formatter: function (val) {
                                                return val + " items";
                                            }
                                        }
                                    },
                                    grid: {
                                        borderColor: '#f1f1f1',
                                        strokeDashArray: 4
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#chart"), options);
                                chart.render();
                            </script>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modals and Other Scripts -->
    <!-- Logout and Location Update Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <!-- Modal Content for Logout -->
    </div>

    <!-- Set Location Modal -->
    <div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <!-- Modal Content for Set Location -->
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>
    
    <script>
        let table = new DataTable('#myTable');
        $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function() {
            $('#side_nav').addClass('active');
            $('.content').addClass('shift');
        });

        $('.close-btn').on('click', function() {
            $('#side_nav').removeClass('active');
            $('.content').removeClass('shift');
        });
    </script>
</body>
</html>
