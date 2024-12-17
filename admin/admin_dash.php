<?php 
require_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
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
        <!-- Sidebar code unchanged -->
        
        <div class="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Navbar code unchanged -->
            </nav>
            <div class="container-fluid">
                <h1 class="fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Dashboard</strong></h1>
                <div class="row">
                    <!-- Cards with count data unchanged -->
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header fw-bold" style="font-size: 30px;">
                                <form method="post">
                                    <div class="row">
                                        <!-- Form content unchanged -->
                                    </div>
                                </form>
                            </div>
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
                                            date_default_timezone_set("Asia/manila");  
                                            $datein = date('y-m-d');
                                            $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";
                                            $oks22 = mysqli_query($con, $sql22);
                                            $res226 = mysqli_num_rows($oks22);
                                            echo $res226;
                                            ?>,
                                            <?php 
                                            $total = $res22 - $res226;
                                            echo $total;
                                            ?>
                                        ]
                                    }],
                                    xaxis: {
                                        categories: ['Admin','Staff','Total Empoyee', 'Total Time In', 'Total Absent']
                                    }
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

    <!-- Location Modal Code -->
    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Logout</strong></h5>
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body text-center"><strong>Are you sure you want to Logout ?</strong></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="color: #000;">Cancel</button>
                    <a class="btn" style="color: #000; background: skyblue;" href="logout.php" name="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Set Location Modal -->
    <div class="modal fade " id="setModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Set Location</strong></h5>
                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <form action="admin_dash.php" method="POST">
                    <div class="modal-body text-center">
                        <?php
                        $lon;
                        $lan;
                        list($lon, $lan) = explode(',', $currLoc["location"]);
                        ?>
                        <strong>
                            <label>Default location</label>
                        </strong>
                        <p><?php echo "Latitude: ".$lon." Longitude: ".$lan ; ?></p>
                        <strong>
                            <label>Current location</label>
                        </strong>
                        <p id="status">na</p>
                    </div>
                    <div class="modal-footer">
                        <input type="text" name="latitude" id="latitude" hidden>
                        <input type="text" name="longitude" id="longitude" hidden>
                        <input class="btn btn-information" type="submit" value="Update Default Location To Current Location">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Handle Location Update -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $location = $latitude . "," . $longitude;
        $update = $con->prepare("UPDATE `admin` SET `location` = ? WHERE `admin`.`id` = 1;");
        $update->bind_param("s", $location);
        if ($update->execute()) { 
            echo "<script>alert('Location updated successfully.')</script>"; 
        } else { 
            echo "<script>alert('Error updating location: " . $update->error . "')</script>";
        }
    }
    ?>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../assets/js/mdb.js"></script>
    <script src="../vendor/datatables/dataTable.js"></script>
    
    <script>
        let table = new DataTable('#myTable', {});
        
        $(".sidebar ul li").on('click', function(){
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });
        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });
        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });

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
</body>
</html>
