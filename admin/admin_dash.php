<?php 
require_once '../db.php'; // Include the database connection
session_start();
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
    if (isset($_GET['msg']) && $_GET['msg'] == "login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar -->
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

        <!-- Content Section -->
        <div class="content">
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
                                <span class="mr-2 d-lg-inline small" style="color: #000;">Hello,</span>
                                <span class="mr-2 d-lg-inline small">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width: 40px; border-radius: 50%;">
                                </span>
                                <span class="mr-2 d-lg-inline small fw-bold" style="color: #000;"><?php echo $row['fname']; ?></span>
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in px-4" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#setModal">
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

            <!-- Dashboard Content -->
            <div class="container-fluid">
                <h1 class="fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Dashboard</strong></h1>
                <div class="row">
                    <div class="col-xl-2 col-md-6 mb-4" style="color: #000;">
                        <div class="card shadow h-60 py-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                            <strong><a>Admin</a> </strong>
                                        </div>
                                        <?php
                                        $sql22 = "SELECT * FROM `admin`";
                                        $oks22 = mysqli_query($con, $sql22);
                                        $res22 = mysqli_num_rows($oks22);
                                        ?>
                                        <div class="h5 mb-0 fs-5"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res22; ?></strong></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Additional cards can be added here as per the current layout -->

                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Logout</strong></h5>
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                <div class="modal-body text-center"><strong>Are you sure you want to logout?</strong></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="color: #000;">Cancel</button>
                    <a class="btn" style="color: #000; background: skyblue;" href="logout.php" name="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Set Location Modal -->
    <div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Set Location</strong></h5>
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
                </div>
                <form action="admin_dash.php" method="POST">
                    <div class="modal-body text-center">
                        <?php
                        $currLoc = mysqli_fetch_assoc($oks22);
                        list($lon, $lan) = explode(',', $currLoc["location"]);
                        ?>
                        <strong><label>Default Location:</label></strong>
                        <p><?php echo "Latitude: ".$lon." Longitude: ".$lan; ?></p>
                        <strong><label>Current Location:</label></strong>
                        <p id="status">na</p>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="latitude" id="latitude" hidden>
                        <input type="text" name="longitude" id="longitude" hidden>
                        <input class="btn btn-information" type="submit" value="Update Location">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('status').textContent = `Latitude: ${position.coords.latitude} Longitude: ${position.coords.longitude}`;
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function() {
                document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
            });
        } else {
            document.getElementById('status').textContent = 'Geolocation is not supported by this browser.';
        }
    </script>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>

    <script>
        let table = new DataTable('#myTable', {});
        $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function() {
            $('.sidebar').addClass('active');
        });

        $('.close-btn').on('click', function() {
            $('.sidebar').removeClass('active');
        });
    </script>
</body>
</html>
