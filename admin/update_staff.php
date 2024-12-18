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
</head>
<body>
    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
            </div>
            <ul class="list-unstyled px-3">
                <li class=""><a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
                <li class=""><a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
                <li class=""><a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-pencil"></i> Payroll</a></li>
                <li class=""><a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-book-open"></i> Reports</a></li>
                <li class=""><a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-bar-chart"></i> Positions</a></li>
                <li class="active"><a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-user"></i> Accounts</a></li>
                <li class=""><a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-clock"></i> Login / Logout</a></li>
            </ul>
            <hr class="h-color mx-2">
        </div>
        <div class="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
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
                                <span class="mr-2 d-lg-inline  small " style="color: #000;">
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
                                  <form method="post" enctype="multipart/form-data" class="container mt-5">
  <div class="row g-3">
    <div class="col-md-6">
      <label for="firstName" class="form-label">First Name</label>
      <input class="form-control" type="text" name="first" id="firstName" placeholder="Enter First Name" style="font-size :15px;" required value="<?php echo $rower['fname']; ?>">
    </div>

    <div class="col-md-6">
      <label for="lastName" class="form-label">Last Name</label>
      <input class="form-control" type="text" name="last" id="lastName" placeholder="Enter Last Name" style="font-size :15px;" required value="<?php echo $rower['lname']; ?>">
    </div>

    <div class="col-md-6">
      <label for="middleName" class="form-label">Middle Name</label>
      <input class="form-control" type="text" name="mid" id="middleName" placeholder="Enter Middle Name" style="font-size :15px;" required value="<?php echo $rower['mname']; ?>">
    </div>

    <div class="col-md-3">
      <label for="dob" class="form-label">Birthdate</label>
      <input class="form-control" type="date" name="dob" id="dob" style="font-size :15px;" required value="<?php echo $rower['dob']; ?>" onchange="FindAge()" onmousemove="FindAge()">
    </div>

    <div class="col-md-3">
      <label for="age" class="form-label">Age</label>
      <input class="form-control" type="number" name="age" id="age" placeholder="Enter Age" style="font-size :15px;" required value="<?php echo $rower['age']; ?>">
    </div>

    <div class="col-md-3">
      <label for="gender" class="form-label">Select Gender</label>
      <select name="gender" id="gender" class="form-select" style="font-size :15px;" required>
        <option><?php echo $rower['gender']; ?></option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>

    <div class="col-md-6">
      <label for="contactNo" class="form-label">Contact No.</label>
      <input class="form-control" type="text" name="cnum" id="contactNo" placeholder="Enter Contact No." style="font-size :15px;" maxlength="11" required value="<?php echo $rower['c_number']; ?>">
    </div>

    <div class="col-md-6">
      <label for="username" class="form-label">Username</label>
      <input class="form-control" type="text" name="mail" id="username" placeholder="Enter Email or Username" style="font-size :15px;" required value="<?php echo $rower['uname']; ?>">
    </div>

    <div class="col-md-6 position-relative">
      <label for="pass" class="form-label">Password</label>
      <input class="form-control" type="password" name="pass" id="pass" placeholder="Enter Password" style="font-size :15px;" required value="<?php echo $rower['pass']; ?>">
      <i class="fa fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePasswordVisibility('pass')" id="iconPassword"></i>
    </div>

    <div class="col-md-6 position-relative">
      <label for="rpass" class="form-label">Re-password</label>
      <input class="form-control" type="password" name="cpass" id="rpass" placeholder="Re-enter Password" style="font-size :15px;" required>
      <i class="fa fa-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePasswordVisibility('rpass')" id="iconRePassword"></i>
    </div>

    <div class="col-md-8 text-center">
      <label for="profile" class="form-label">Profile Image</label>
      <input class="form-control" type="file" name="profile" id="profile" placeholder="Select Profile Image" style="font-size :15px;">
    </div>

    <div class="col-12 text-center mt-3">
      <button type="submit" class="btn btn-success text-light" name="update">Update</button>
    </div>
  </div>
</form>

<script>
  // Function to calculate age based on DOB
  function FindAge() {
    const day = document.getElementById("dob").value;
    const DOB = new Date(day);
    const today = new Date();
    let age = today.getTime() - DOB.getTime();
    age = Math.floor(age / (1000 * 60 * 60 * 24 * 365.25));
    document.getElementById("age").value = age;
  }

  // Function to toggle password visibility
  function togglePasswordVisibility(id) {
    const passwordField = document.getElementById(id);
    const icon = id === 'pass' ? document.getElementById('iconPassword') : document.getElementById('iconRePassword');
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

  // Ensures the phone number is correctly formatted (max 11 digits)
  document.getElementById('contactNo').addEventListener('input', function(event) {
    let input = event.target;
    let value = input.value.replace(/\D/g, '');  // Removes non-numeric characters
    if (value.length > 11) {
      input.value = value.slice(0, 11);  // Limits to 11 characters
    } else {
      input.value = value;
    }
  });
</script>

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