<?php
require_once("../db.php");
// echo password_hash("admin@@123", PASSWORD_DEFAULT);
$secretKey = "6LeljIkqAAAAAEmFzLysnn0Df4pRtnAQ3ocLrQSE";

if (isset($_POST['login'])) {
    $user = htmlspecialchars(stripslashes(trim($_POST['user'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $recaptchaVerifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($recaptchaVerifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    // If reCAPTCHA failed
    if (intval($responseKeys['success']) !== 1) {
        echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>reCAPTCHA verification failed, please try again</div>";
    } else {
        // Check if the user and password fields are empty
        if (empty($user) || empty($password)) {
            echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>You must fill all fields</div>";
        } else {
            $query = $con->prepare("SELECT * FROM admin WHERE uname = ?");
            $query->bind_param('s', $user);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['pass'])) {
                    $_SESSION['idadmins'] = $row['id'];
                    header("location:./admin_dash.php?msg=login");
                } else {
                    echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
                }
            } else {
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
    
    <style>
        /* Custom reCAPTCHA styling */
        .recaptcha-container {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .g-recaptcha {
            transform: scale(0.85);  /* Scale down reCAPTCHA */
            -webkit-transform: scale(0.85);
            transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
        }

        /* Center the login button */
        .btn-login {
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        /* Style for the input fields */
        .input-group .form-control {
            height: 45px;
            font-size: 1rem;
            border-radius: 8px;
            padding: 10px;
        }

        .form-control {
            font-size: 1rem;
        }

        /* Style the visibility toggle button */
        .input-group button {
            background-color: #f0f0f0;
            border-radius: 8px;
            height: 45px;
            padding: 10px;
            font-size: 1rem;
            cursor: pointer;
        }

        .input-group button:focus {
            outline: none;
            border: none;
        }

        /* Styling the password input field */
        .input-group .form-control {
            font-size: 1rem;
            border-radius: 8px;
            padding: 10px;
            height: 45px;
        }

        .input-group button i {
            font-size: 1.2rem;
            color: #09111d;
        }
    </style>
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
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
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
                                            <div class="recaptcha-container">
                                                <div class="g-recaptcha" data-sitekey="6LeljIkqAAAAANJmJqqmRipY4QJ9e8J29iIYuh9w"></div>
                                            </div>
                                            <script src="https://www.google.com/recaptcha/api.js" async defer></script>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12 mt-3">
                                                        <button type="submit" name="login" class="btn btn-primary btn-login text-light">
                                                            <i class="fa fa-sign-in me-1"></i>LOGIN
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
                                    <div class="col-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
