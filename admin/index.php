<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Set session timeout limit (in seconds)
$timeout_duration = 15 * 60; // 15 minutes

// Check if the session is already started and the user is logged in
if (isset($_SESSION['idadmins'])) {
    // Check if the session timeout has passed
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
        // Session has timed out, destroy the session and redirect to login page
        session_unset();
        session_destroy();
        header("Location: login.php?msg=timeout");
        exit;
    }
    
    // Update last activity timestamp
    $_SESSION['last_activity'] = time();
}

require_once("../db.php");

$secretKey = "6LeljIkqAAAAAEmFzLysnn0Df4pRtnAQ3ocLrQSE";

// Initialize failed login attempts counter if not already in session
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
    $_SESSION['last_failed_time'] = 0;
}

// Define the maximum number of attempts and the lockout duration
$max_attempts = 3;
$lockout_duration = 5 * 60; // 5 minutes

if (isset($_POST['login'])) {
    // Check if the account is locked due to too many failed attempts
    if ($_SESSION['failed_attempts'] >= $max_attempts) {
        $time_since_last_failed = time() - $_SESSION['last_failed_time'];
        if ($time_since_last_failed < $lockout_duration) {
            $remaining_time = $lockout_duration - $time_since_last_failed;
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Too many login attempts',
                        text: 'Please try again after $remaining_time seconds.'
                    });
                  </script>";
            exit;
        } else {
            // Reset failed attempts after lockout period
            $_SESSION['failed_attempts'] = 0;
        }
    }

    // Sanitize input to prevent XSS and SQL injection
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $recaptchaVerifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaVerifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    // If reCAPTCHA failed
    if (intval($responseKeys['success']) !== 1) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'reCAPTCHA verification failed',
                    text: 'Please try again'
                });
              </script>";
    } else {
        // Check if the user and password fields are empty
        if (empty($email) || empty($password)) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'You must fill all fields'
                    });
                  </script>";
        } else {
            $query = $con->prepare("SELECT * FROM admin WHERE email = ?");
            $query->bind_param('s', $email);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Verify password
                if (password_verify($password, $row['pass'])) {
                    $_SESSION['idadmins'] = $row['id'];
                    $_SESSION['last_activity'] = time(); // Set session last activity time
                    // Reset failed attempts on successful login
                    $_SESSION['failed_attempts'] = 0;
                    header("location:./admin_dash.php?msg=login");
                    exit; // Always exit after a header redirect to prevent further code execution
                } else {
                    // Increment failed attempts and set last failed attempt time
                    $_SESSION['failed_attempts']++;
                    $_SESSION['last_failed_time'] = time();
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Incorrect username or password',
                                text: 'Please try again'
                            });
                          </script>";
                }
            } else {
                // Increment failed attempts and set last failed attempt time
                $_SESSION['failed_attempts']++;
                $_SESSION['last_failed_time'] = time();
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Incorrect username or password',
                            text: 'Please try again'
                        });
                      </script>";
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
    
    <!-- Include SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
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
                            <form method="post">
                                <label class="mt-2"><i class="fa fa-envelope me-2"></i>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Enter your email" autocomplete="off" required>

                                <label class="mt-2"><i class="fa fa-lock me-2"></i>Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" name="password" id="pass" placeholder="Enter password" autocomplete="off" required>
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
                                <a href="../admin/forgot_password.php">Forgot Password</a>
                            </div>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
