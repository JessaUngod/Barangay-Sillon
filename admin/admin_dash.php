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
        <div class="sidebar" id="side_nav">
            <!-- Sidebar Content (Unchanged) -->
        </div>
        <div class="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Navbar Content (Unchanged) -->
            </nav>
            <div class="container-fluid">
                <h1 class="fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;">Dashboard</h1>
                <div class="row">
                    <div class="col-xl-12 col-md-12 mb-4"> <!-- Full width for chart -->
                        <div class="card shadow">
                            <div class="card-body">
                                <div id="chart" style="width: 100%; height: 500px;"></div> <!-- Full height for chart -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header fw-bold" style="font-size: 30px;">
                                <form method="post">
                                    <div class="row">
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div id="chart-container" style="width: 100%; height: 100%;"></div>
                            </div>
                            <script type="text/javascript">
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: '100%',
                                        width: '100%'
                                    },
                                    series: [{
                                        name: 'Count',
                                        data: [
                                            <?php echo $res22; ?>,
                                            <?php 
                                            $sql22 = "SELECT * FROM `staff`";
                                            $oks22 = mysqli_query($con, $sql22);
                                            echo mysqli_num_rows($oks22);
                                            ?>,
                                            <?php 
                                            $sql22 = "SELECT * FROM `employee_info`";
                                            $oks22 = mysqli_query($con, $sql22);
                                            echo mysqli_num_rows($oks22);
                                            ?>,
                                            <?php 
                                            date_default_timezone_set("Asia/manila");  
                                            $datein = date('y-m-d');
                                            $sql22 = "SELECT * FROM `attendance` WHERE time_in ='$datein'";
                                            $oks22 = mysqli_query($con, $sql22);
                                            echo mysqli_num_rows($oks22);
                                            ?>,
                                            <?php 
                                            $total = $res22 - mysqli_num_rows($oks22);
                                            echo $total;
                                            ?>
                                        ]
                                    }],
                                    xaxis: {
                                        categories: ['Admin','Staff','Total Employee', 'Total Time In', 'Total Absent']
                                    }
                                };
                                var chart = new ApexCharts(document.querySelector("#chart-container"), options);
                                chart.render();
                            </script>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
