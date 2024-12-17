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
        /* Add your styles here */
    </style>
</head>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
        echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Admin", "success")</script>';
    }
    ?>
    <div class="main-container-fluid d-flex">
        <!-- Sidebar and Content here -->

        <div class="content">
            <!-- Navbar and content -->

            <?php
            // Fetching current admin's location (Assuming location is stored in admin table)
            if (!empty($_SESSION['idadmins'])) {
                $id = $_SESSION['idadmins'];
                $result = mysqli_query($con, "SELECT * FROM admin WHERE id = $id");
                $row = mysqli_fetch_assoc($result);

                // Assuming 'location' field exists in the admin table and contains 'latitude,longitude'
                $currLoc = $row['location'];  // This will get the location from the database
            } else {
                header("Location: ./index.php");
            }
            ?>

            <div class="container-fluid">
                <h1 class="fw-bold mb-4 text-gray-800 fs-3" style="color: #000;"><strong>Dashboard</strong></h1>
                
                <!-- Dashboard Stats Cards -->

                <div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
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
                                    // Handling the location string
                                    if (!empty($currLoc)) {
                                        list($lon, $lat) = explode(',', $currLoc);
                                    } else {
                                        $lon = $lat = 'Not Set';
                                    }
                                    ?>
                                    <strong>
                                        <label>Default location</label>
                                    </strong>
                                    <p><?php echo "Latitude: ".$lon." Longitude: ".$lat; ?></p>
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
                        echo "<script>alert('Error updating location: " . $update->error."')</script>";
                    }
                }
                ?>
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
