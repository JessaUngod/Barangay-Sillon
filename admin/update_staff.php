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
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/de.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <div class="main-container-fluid d-flex">
    <div class="sidebar" id="side_nav" style="background-color: #240750;"> 
    <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
        <h1 class="fs-5">
            <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
            <strong style="color: #fff;">Barangay Sillon</strong>
        </h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="list-unstyled px-3">
        <li class="active">
            <a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block" style="color: black;"> 
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-users"></i> Employees
            </a>
        </li>
        <li>
            <a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-pencil"></i> Payroll
            </a>
        </li>
        <li>
            <a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-book-open"></i> Reports
            </a>
        </li>
        <li>
            <a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-bar-chart"></i> Positions
            </a>
        <li>
            <a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-user"></i> Accounts
            </a>
        </li>
        <li>
            <a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-clock"></i> Login / Logout
            </a>
        </li>
    </ul>
    
</div>
        <div class="content">
        <nav class="navbar navbar-expand navbar-light" style="background-color: #240750;" topbar mb-4 static-top shadow>
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                        <strong style="font-size:22px;"><strong style="font-size: 28px;">a</strong>dmin</strong></a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline  small " style="color: #fff; font-family: 'Poppins', sans-serif; font-size: 30px;">
                                    Hello,</span>
                                <span class="mr-2 d-lg-inline  small ">
                                    <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;">
                                </span>
                                <span class="mr-2 d-lg-inline  small fw-bold" style="color: #000;">
                                    <?php echo $row['fname']; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu  shadow animated-grow-in px-4"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Logout</strong>
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <h1 class=" fw-bold mb-0  fs-3 mb-4" style="color: #000;"><strong>Accounts</strong></h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-2 py-2 px-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="staff.php" class="btn form-control fw-bold btn-primary mb-1 mt-1 text-light">Staff</a>
                                </div>
                                <div class="col-md-2">
                                    <a href="admin.php" class="btn form-control fw-bold btn-secondary mb-1 mt-1 text-dark">Admin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 mb-3">
                            <div class="card py-1 px-1 cb1 fw-bold" style="color: #000;">
                                <div class="card-header bg-primary">
                                    <a href="staff.php" class="btn-close float-end py-1"></a>
                                    <span aria-hidden="true"></span>
                                    <h5 style=" color: #fff;"> <i class="fas fa-user" style="color: #000;"> </i>&nbsp;<strong> Staff</strong></h5>
                                </div>
                                <?php
                                if (isset($_GET['staff_id'])) {
                                    $getstaff_id = $_GET['staff_id'];

                                    $sql = "SELECT * FROM staff WHERE id ='$getstaff_id'";
                                    $res = mysqli_query($con, $sql);
                                    $rower = mysqli_fetch_assoc($res);
                                }
                                ?>
                                <div class="card-body">
                                    <?php
                                    if (isset($_POST['update'])) {
                                        $staffid = $_POST['idstaff'];
                                        $lname = $_POST['last'];
                                        $fname = $_POST['first'];
                                        $mid = $_POST['mid'];
                                        $cnum = $_POST['cnum'];
                                        $dob = $_POST['dob'];
                                        $gen = $_POST['gender'];
                                        $age = $_POST['age'];
                                        $len1 = strlen($cnum);
                                        $email = $_POST['mail'];
                                        $pass = $_POST['pass'];
                                        $len = strlen($pass);
                                        $cpass = $_POST['cpass'];
                                        $profile = $_FILES['profile']['name'];
                                        if ($profile == null) {
                                            if ($len1 == 11) {
                                                    if (empty($pass)) {
                                                            if ($age >= 18) {
                                                                $query = "UPDATE `staff` SET `fname`='$fname',`mname`='$mid',`lname`='$lname',`dob`='$dob',`age`='$age',`gender`='$gen',`c_number`='$cnum',`uname`='$email' WHERE id = '$staffid'";
                                                                mysqli_query($con, $query);
                                        ?>
                                                                <script>
                                                                    window.location = "./staff.php?mgstaff=staffupdated";
                                                                </script>
                                                            <?php
                                                            } else {
                                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Invalid Age<a  href='' class='btn-close float-end'></a></small>";
                                                            }
                                                    }else{
                                                        if ($len > 7) {
                                                        if ($pass == $cpass) {
                                                            if ($age >= 18) {
                                                                $hashed = password_hash($pass, PASSWORD_DEFAULT);
                                                                $query = "UPDATE `staff` SET `fname`='$fname',`mname`='$mid',`lname`='$lname',`dob`='$dob',`age`='$age',`gender`='$gen',`c_number`='$cnum',`uname`='$email',`pass`='$hashed' WHERE id = '$staffid'";
                                                                mysqli_query($con, $query);
                                        ?>
                                                                <script>
                                                                    window.location = "./staff.php?mgstaff=staffupdated";
                                                                </script>
                                                            <?php
                                                            } else {
                                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Invalid Age<a  href='' class='btn-close float-end'></a></small>";
                                                            }
                                                        } else {
                                                            echo "<small class ='form-control bg-danger  text-center' style ='color:#fff;'>Password does not match!<a href='' class='btn-close float-end'></a></small>";
                                                        }
                                                        } else {
                                                            echo "<small class ='form-control bg-danger  text-center' style ='color:#fff;'>Password must 8 or more characters<a href='' class='btn-close float-end'></a></small>";
                                                        }
                                                }
                                            } else {
                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Contact no. invalid<a  href='' class='btn-close float-end'></a></small>";
                                            }
                                        } else {
                                            if ($len1 == 11) {
                                                    if (empty($pass)) {
                                                            if ($age >= 18) {
                                                                move_uploaded_file($_FILES['profile']['tmp_name'], '../uploads/' . $_FILES['profile']['name']);
                                                                $query = "UPDATE `staff` SET `fname`='$fname',`mname`='$mid',`lname`='$lname',`dob`='$dob',`age`='$age',`gender`='$gen',`c_number`='$cnum',`uname`='$email',`img`='$profile' WHERE id = '$staffid'";
                                                                mysqli_query($con, $query);
                                                            ?>
                                                                <script>
                                                                    window.location = "./staff.php?mgstaff=staffupdated";
                                                                </script>
                                        <?php
                                                            } else {
                                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Invalid Age<a  href='' class='btn-close float-end'></a></small>";
                                                            }
                                                    }else{
                                                        if ($len > 7) {
                                                        $hashed = password_hash($pass, PASSWORD_DEFAULT);
                                                        if ($pass == $cpass) {
                                                            if ($age >= 18) {
                                                                move_uploaded_file($_FILES['profile']['tmp_name'], '../uploads/' . $_FILES['profile']['name']);
    
                                                                $query = "UPDATE `staff` SET `fname`='$fname',`mname`='$mid',`lname`='$lname',`dob`='$dob',`age`='$age',`gender`='$gen',`c_number`='$cnum',`uname`='$email',`pass`='$hashed',`img`='$profile' WHERE id = '$staffid'";
    
                                                                mysqli_query($con, $query);
                                                            ?>
                                                                <script>
                                                                    window.location = "./staff.php?mgstaff=staffupdated";
                                                                </script>
                                        <?php
                                                            } else {
                                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Invalid Age<a  href='' class='btn-close float-end'></a></small>";
                                                            }
                                                        } else {
                                                            echo "<small class ='form-control bg-danger  text-center' style ='color:#fff;'>Password does not match!<a href='' class='btn-close float-end'></a></small>";
                                                        }
                                                    } else {
                                                        echo "<small class ='form-control bg-danger  text-center' style ='color:#fff;'>Password must 8 or more characters<a href='' class='btn-close float-end'></a></small>";
                                                    }
                                                    }
                                            } else {
                                                echo "<small class='form-control bg-danger  text-center' style ='color:#fff;'>Contact no. invalid<a  href='' class='btn-close float-end'></a></small>";
                                            }
                                        }
                                    }
                                    ?>
                                  <form method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <!-- First Name -->
            <div class="col-md-6 col-12">
                <label>First Name</label>
                <input class="form-control mb-1" type="hidden" name="idstaff" style="font-size :15px;" required value="<?php echo $rower['id']; ?>">
                <input class="form-control mb-1" type="text" name="first" placeholder="Enter First Name" style="font-size :15px;" required value="<?php echo $rower['fname']; ?>">
            </div>

            <!-- Last Name -->
            <div class="col-md-6 col-12">
                <label>Last Name</label>
                <input class="form-control mb-1" type="text" name="last" placeholder="Enter Last Name" style="font-size :15px;" required value="<?php echo $rower['lname']; ?>">
            </div>

            <!-- Middle Name -->
            <div class="col-md-3 col-12">
                <label>Middle Name</label>
                <input class="form-control mb-1" type="text" name="mid" placeholder="Enter Middle Name" style="font-size :15px;" required value="<?php echo $rower['mname']; ?>">
            </div>

            <!-- Birthdate -->
            <div class="col-md-3 col-12">
                <label>Birthdate</label>
                <input onclick="FindAge()" onmousemove="FindAge()" class="form-control mb-1" type="date" id="dob" name="dob" style="font-size :15px;" required value="<?php echo $rower['dob']; ?>">
            </div>

            <!-- Age -->
            <div class="col-md-3 col-12">
                <label>Age</label>
                <input onclick="FindAge()" onmousemove="FindAge()" class="form-control mb-1" type="number" name="age" placeholder="Enter your Age" style="font-size :15px;" required value="<?php echo $rower['age']; ?>">
            </div>

            <!-- Gender -->
            <div class="col-md-3 col-12">
                <label>Select Gender</label>
                <select onclick="FindAge()" onmousemove="FindAge()" name="gender" class="form-control mb-1" style="font-size :15px;" required>
                    <option><?php echo $rower['gender']; ?></option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <!-- Contact No. -->
            <div class="col-md-6 col-12">
                <label>Contact No.</label>
                <input class="form-control mb-1" type="text" name="cnum" placeholder="Enter Contact no." style="font-size :15px;" maxlength="11" required value="<?php echo $rower['c_number']; ?>">
            </div>

            <!-- Username -->
            <div class="col-md-6 col-12">
                <label>Username</label>
                <input class="form-control mb-1" type="text" name="mail" placeholder="Enter Email or Username" style="font-size :15px;" required value="<?php echo $rower['uname']; ?>">
            </div>

            <!-- Password -->
            <div class="col-md-6 col-12 position-relative">
                <label>Password</label>
                <input class="form-control mb-1" type="password" id="pass" name="pass" placeholder="Enter Password" style="font-size :15px;" required value="<?php echo $rower['pass']; ?>">
            </div>

            <!-- Re-Password -->
            <div class="col-md-6 col-12 position-relative">
                <label>Re-Password</label>
                <input class="form-control mb-1" type="password" id="rpass" name="cpass" placeholder="Enter Re-Password" style="font-size :15px;" required value="<?php echo $rower['pass']; ?>">
               
            </div>

            <!-- Profile Image -->
            <div class="col-md-8 col-12 text-center">
                <label>Profile Image</label>
                <input class="form-control mb-1" type="file" name="profile" style="font-size :15px;">
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-3">
                <button onclick="FindAge()" onmousemove="FindAge()" class="btn bg-success text-light w-100" name="update" type="submit">
                    <label>Update</label>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    // Toggle password visibility function
    function togglePasswordVisibility(fieldId) {
        var passwordField = document.getElementById(fieldId);
        var icon = document.getElementById('icon-' + fieldId);
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    // Age calculation based on DOB
    function FindAge() {
        var day = document.getElementById("dob").value;
        var DOB = new Date(day);
        var today = new Date();
        var age = today.getTime() - DOB.getTime();
        age = Math.floor(age / (1000 * 60 * 60 * 24 * 365.25));
        document.getElementById("age").value = age;
    }
</script>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                aria-hidden="true">
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
                            <a class="btn " style="color: #000; background: skyblue;" href="logout.php" name="logout">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <script src="../assets/js/jquery.min.js"></script>
            <script src="../assets/js/bootstrap.bundle.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
            <script src="../assets/js/mdb.js"></script>
            <script src="../vendor/datatables/dataTable.js"></script>
            <script>
                let table = new DataTable('#myTable', {
                });
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