<?php
require_once("../db.php");
$secretKey = "6LeljIkqAAAAAEmFzLysnn0Df4pRtnAQ3ocLrQSE";

$error_message = '';  // Initialize an error message variable

if (isset($_POST['login'])) {
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $recaptchaVerifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaVerifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    // If reCAPTCHA failed
    if (intval($responseKeys['success']) !== 1) {
        $error_message = 'reCAPTCHA verification failed. Please try again.';
    } else {
        // Check if the user and password fields are empty
        if (empty($email) || empty($password)) {
            $error_message = 'Missing Fields. You must fill all fields.';
        } else {
            // Prepare query to fetch user from database using mysqli
            $stmt = $con->prepare("SELECT * FROM admin WHERE email = ?");
            if ($stmt === false) {
                die('MySQL prepare error: ' . $con->error);
            }

            // Bind parameters
            $stmt->bind_param('s', $email); // 's' stands for string type

            // Execute the query
            $stmt->execute();

            // Fetch the result
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // If user found and password is correct
            if ($user && password_verify($password, $user['pass'])) {
                // Successful login, redirect or set session
                header("Location: ./admin_dash.php?msg=login");
                exit();
            } else {
                // User not found or password incorrect
                $error_message = 'Incorrect username or password. Please try again.';
            }

            // Close the statement
            $stmt->close();
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
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                            <?php
                            // Show SweetAlert if there's an error message
                            if ($error_message) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: '$error_message'
                                        });
                                      </script>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
