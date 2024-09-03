<?php
require_once("../db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login Form</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
</head>

<body style="background-size: cover; background-repeat: no-repeat; background-position: center; background: #09111d;">

    <main class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card rounded">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- <div class="col-md-6" style="background: url(../assets/img/sillon.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 500px; width: 500px; margin-left: 200px;"></div> -->
                            <div class="col-md-12 py-5 px-3 bg-light">
                            <img src="../assets/img/sillon.jpg" alt="logo" class="w-100">
                                <center>
                                    <p class="fw-bold" style="color: #09111d; font-size:30px;"><strong>Welcome Staff</strong></p>
                                    <p style="font-size:12px; color: #09111d;">Workers of Brgy.Sillon proves as the role models within the community.</p>
                                </center>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <form method="post">
                                                <?php
                                                error_reporting(0);
                                                $try = "SELECT * FROM loginrec ORDER BY login_id DESC LIMIT 1";
                                                $result00 = mysqli_query($con, $try);
                                                if ($result00) {
                                                    $fetch = mysqli_fetch_assoc($result00);
                                                    $rollnumber = $fetch['login_id'];
                                                    if ($rollnumber == null) {
                                                        $rael = "S24000000";
                                                    } else {
                                                        $rael = str_replace("S24", "", $rollnumber);
                                                        $rael = str_pad($rael + 1, 6, 0, STR_PAD_LEFT);
                                                        $rael = "S24" . $rael;
                                                    }
                                                } else {
                                                    echo "<script>alert('Server Error') </script>";
                                                }
                                                ?>
                                                <?php
                                                if (isset($_POST['login'])) {
                                                    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
                                                    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
                                                    $query = $con->prepare("SELECT * FROM staff WHERE uname = ?");
                                                    $query->bind_param('s', $email);
                                                    $query->execute();
                                                    $result = $query->get_result();
                                                    // $result = mysqli_query($con, $query);


                                                    if (!empty($email) && !empty($password)) {
                                                        if ($result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            if (password_verify($password, $row['pass'])) {
                                                                $_SESSION['idstaff'] = $row['id'];
                                                                $namegid = $row['fname'];
                                                                $insert_sql = "INSERT INTO `loginrec`(`login_id`,`fname`) VALUES ('$rael','$namegid')";
                                                                $omg = mysqli_query($con, $insert_sql);
                                                                if ($omg) {
                                                                    $sqlhh = "SELECT * FROM loginrec WHERE login_id ='$rael'";
                                                                    $resulthh = mysqli_query($con, $sqlhh);
                                                                    $rowh = mysqli_fetch_assoc($resulthh);
                                                                    $_SESSION['idstaffs'] = $rowh['login_id'];
                                                                    header("location:./staff_dash.php?msg=login");
                                                                }
                                                            } else {
                                                                echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
                                                            }
                                                        } else {
                                                            echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
                                                        }
                                                    } else {
                                                        echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>You must fill all fields</div>";
                                                    }
                                                }
                                                ?>
                                                <label class="mt-2"><i class="fa fa-envelope me-2"></i>Username</label>
                                                <input class="form-control" type="text" name="email" placeholder="Enter username" autocomplete="off">
                                                <label class="mt-2"><i class="fa fa-lock me-2"></i>Password</label>
                                                <div class="position-relative">
                                                    <input class="form-control" type="password" name="password" id="pass" placeholder="Enter password" autocomplete="off">
                                                    <i class="fa fa-eye-slash" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility()" id="password-toggle"></i>
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" name="login" class="btn btn-primary mt-1 form-control text-light"><i class="fa fa-sign-in me-1"></i>LOGIN</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript">
        function togglePasswordVisibility() {
            var passField = document.getElementById("pass");
            var icon = document.getElementById("password-toggle");

            if (passField.type === "password") {
                passField.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                passField.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>

</html>
