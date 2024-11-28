<?php
require_once("../db.php");

// reCAPTCHA settings
$secretKey = "6LeljIkqAAAAAEmFzLysnn0Df4pRtnAQ3ocLrQSE";

// Max login attempts before lockout
$maxAttempts = 3;
$lockoutTime = 15 * 60; // 15 minutes

// Start session to track failed login attempts
session_start();

if (isset($_POST['login'])) {
    $user = htmlspecialchars(stripslashes(trim($_POST['user'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // reCAPTCHA verification
    $recaptchaVerifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaVerifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys['success']) !== 1) {
        echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>reCAPTCHA verification failed, please try again</div>";
    } else {
        // Check if the user has exceeded the maximum login attempts
        if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= $maxAttempts) {
            // Check if the lockout period has expired
            if (isset($_SESSION['lockout_time']) && time() - $_SESSION['lockout_time'] < $lockoutTime) {
                $remainingTime = $lockoutTime - (time() - $_SESSION['lockout_time']);
                echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Too many failed attempts. Please try again in " . gmdate("H:i:s", $remainingTime) . ".</div>";
                exit;
            } else {
                // Reset login attempts after lockout period
                unset($_SESSION['login_attempts']);
                unset($_SESSION['lockout_time']);
            }
        }

        // Check if the user and password fields are empty
        if (empty($user) || empty($password)) {
            echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>You must fill all fields</div>";
        } else {
            $query = $con->prepare("SELECT * FROM admin WHERE email = ?");
            $query->bind_param('s', $user);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['pass'])) {
                    $_SESSION['idadmins'] = $row['id'];
                    header("location:./admin_dash.php?msg=login");
                } else {
                    // Failed login attempt
                    $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;

                    // Lock user out after exceeding max attempts
                    if ($_SESSION['login_attempts'] >= $maxAttempts) {
                        $_SESSION['lockout_time'] = time(); // Lockout time starts
                    }

                    echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
                }
            } else {
                // Failed login attempt
                $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;

                // Lock user out after exceeding max attempts
                if ($_SESSION['login_attempts'] >= $maxAttempts) {
                    $_SESSION['lockout_time'] = time(); // Lockout time starts
                }

                echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login Form</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
</head>

<body style="background-size: cover; background-repeat: no-repeat; background-position: center; background: #09111d;">

    <main class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card rounded">
                    <div class="row">
                        <div class="col-md-12 py-5 px-3 bg-light">
                            <img src="../assets/img/sillon.jpg" alt="logo" class="w-100">
                            <center>
                                <p class="fw-bold" style="color: #09111d; font-size: 30px;"><strong>Welcome Admin</strong></p>
                                <p style="font-size: 12px; color: #09111d;">Workers of Brgy.Sillon prove as the role models within the community.</p>
                            </center>
                            <div class="col-md-12">
                                <form method="post">
                                    <label class="mt-2"><i class="fa fa-envelope me-2"></i>Username</label>
                                    <input class="form-control" type="text" name="user" placeholder="Enter username" autocomplete="off">
                                    <label class="mt-2"><i class="fa fa-lock me-2"></i>Password</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" id="pass" placeholder="Enter password" autocomplete="off">
                                        <button type="button" class="btn btn-outline-secondary" onclick="myfunction()">
                                            <i class="fa fa-eye-slash" id="iconic"></i>
                                        </button>
                                    </div>

                                    <!-- reCAPTCHA -->
                                    <div class="g-recaptcha" data-sitekey="6LeljIkqAAAAANJmJqqmRipY4QJ9e8J29iIYuh9w"></div>
                                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <button type="submit" name="login" class="btn btn-primary mt-1 form-control text-light">
                                                    <i class="fa fa-sign-in me-1"></i>LOGIN
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!--forgot password -->
                                <div class="forgot-password"> 
                                    <a href="forgot_password.php">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        function myfunction() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById("iconic").classList = "fa fa-eye";
            } else {
                x.type = "password";
                document.getElementById("iconic").classList = "fa fa-eye-slash";
            }
        }
    </script>
</body>

</html>
