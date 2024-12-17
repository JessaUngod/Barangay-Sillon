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
<body class="bg-light">
    <?php 
    if (isset($_GET['msg']) == "login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="d-flex">
        <div class="sidebar bg-dark text-white" id="side_nav">
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
            <hr class="h-color mx-2">
        </div>

        <div class="content w-100">
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
                        if (!empty($_SESSION['idadmins'])) {
                            $id = $_SESSION['idadmins'];
                            $result = mysqli_query($con, "SELECT * FROM admin WHERE id = $id");
                            $row = mysqli_fetch_assoc($result);
                        } else {
                            header("Location: ./index.php");
                        }
                        ?> 
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline small text-dark">Hello,</span>
                                <span class="mr-2 d-lg-inline small">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width: 40px; border-radius: 50%;" />
                                </span>
                                <span class="mr-2 d-lg-inline small fw-bold" style="color: #000;"><?php echo $row['fname']; ?></span>
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in px-4" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-target="#setModal" data-toggle="modal">
                                    <i class="fas fa-solid fa-location-dot fa-sm fa-fw mr-2"></i><strong>Set Location</strong>
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i><strong>Logout</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 class="fw-bold mb-0 text-gray-800 fs-3 mb-4">Dashboard</h1>
                <div class="row">
                    <!-- Admin Stats -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary">Admin</h6>
                                        <h5><?php echo $res22; ?></h5>
                                    </div>
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Staff Stats -->
                    <div class="col-xl-2 col-md-6 mb-4">
                        <div class="card shadow-lg rounded-3 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary">Staff</h6>
                                        <h5><?php echo $res22; ?></h5>
                                    </div>
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Employee Stats -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-lg rounded-3 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary">Total Employee</h6>
                                        <h5><?php echo $res22; ?></h5>
                                    </div>
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Time In Stats -->
                    <div class="col-md-2 mb-4">
                        <div class="card shadow-lg rounded-3 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary">Time In</h6>
                                        <h5><?php echo $res226; ?></h5>
                                    </div>
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Absent Stats -->
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-lg rounded-3 p-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold text-primary">Total Absent</h6>
                                        <h5><?php echo $total; ?></h5>
                                    </div>
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header fw-bold" style="font-size: 30px;">Data Overview</div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                            <script type="text/javascript">
                                var options = {
                                    chart: {
                                        type: 'bar'
                                    },
                                    series: [{
                                        name: 'Count',
                                        data: [
                                            <?php echo $res22; ?>,
                                            <?php echo $res22; ?>,
                                            <?php echo $res22; ?>,
                                            <?php echo $res226; ?>,
                                            <?php echo $total; ?>
                                        ]
                                    }],
                                    xaxis: {
                                        categories: ['Admin', 'Staff', 'Total Employee', 'Time In', 'Absent']
                                    },
                                    colors: ['#0d6efd', '#ffc107', '#198754', '#dc3545', '#6c757d']
                                }
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

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Ready to Leave?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
