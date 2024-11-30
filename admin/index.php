<?php
require_once("../db.php");

$maxAttempts = 5;
$lockoutTime = 15 * 60; 

$error_message = ''; 

if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

if ($_SESSION['failed_attempts'] >= $maxAttempts) {
    if (time() - $_SESSION['lockout_time'] < $lockoutTime) {
        $remainingTime = ceil(($lockoutTime - (time() - $_SESSION['lockout_time'])) / 60);
        $error_message = "Too many login attempts. Please try again after $remainingTime minute(s).";
    } else {
        $_SESSION['failed_attempts'] = 0;
        $_SESSION['lockout_time'] = 0;
    }
}

if (isset($_POST['login']) && $_SESSION['failed_attempts'] < $maxAttempts) {
    $user = htmlspecialchars(stripslashes(trim($_POST['user'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));

    if (empty($user) || empty($password)) {
        $error_message = 'You must fill all fields';
    } else {
        $query = $con->prepare("SELECT * FROM admin WHERE email = ?");
        $query->bind_param('s', $user);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['pass'])) {
                $_SESSION['idadmins'] = $row['id'];
                $_SESSION['failed_attempts'] = 0;
                header("Location: ./admin_dash.php?msg=login");
                exit; 
            } else {
                $_SESSION['failed_attempts'] += 1;
                $error_message = 'Incorrect username or password';
            }
        } else {
            $_SESSION['failed_attempts'] += 1; 
            $error_message = 'Incorrect username or password';
        }
    }

    if ($_SESSION['failed_attempts'] >= $maxAttempts) {
        $_SESSION['lockout_time'] = time();
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
    <script src="https://www.google.com/recaptcha/api.js?render=6Lc95IwqAAAAAAqgeTiHvRIFCgIE4LsQortunSBT"></script> 
    <script type="text/javascript">
        grecaptcha.ready(function() {
            grecaptcha.execute('6Lc95IwqAAAAADyRaUf6N7uobXWvSIC-10Ja-Qnd', { action: 'login' }).then(function(token) {
                document.getElementById('recaptchaToken').value = token;
            });
        });
    </script>
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

                                    <div class="mt-3">
                                        <input type="checkbox" id="termsCheckbox" name="terms" required>
                                        <label for="termsCheckbox" class="ms-3">I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a></label>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <button type="submit" name="login" class="btn btn-primary mt-1 form-control text-light" id="loginButton" disabled>
                                                    <i class="fa fa-sign-in me-1"></i>LOGIN
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

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

    <!-- Modal for Terms and Conditions -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">TERMS & CONDITIONS (Barangay Sillon Workforce Attendance System)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Information We Hold About You</h5>
                    <p>* Your name (firstname,lastname and middlename).</p>
                    <p>* Your age, birthdate, gender and contact information number</p>
                    <p>Any additional data that you choose to share as information on your profile such as images. 
                    And we collect some or all this information that depeds in the following access of our platform:</p>
                    <p>* Your registered username and password</p>
                    <p>* You fill out our contact form</p>
                   
                    <h5>How Your Personal Infromation Is Used To</h5>
                    <p>We might use your information in the following terms:</p>
                    <p>* To register your employee accounts, enable you to get your employee ID for your everyday attendance.</p>
                    <p>* To let you access your information (update or delete)</p>
                    <p>* To record your IP Address when you perform certain actions, ensuring that it's never publicly visible but privately seen on your perspective.</p>
                    <h5>Additional</h5>
                    <p>Administrator can reset your password in terms you forget or you want to address on getting your password new to your accountability.</p>
                  
                    <h5>Keeping Your Data Secured</h5>
                    <p>We as a team are committed to ensures everyone of you that any information you provided to us is secured.
                    We have implemented suitable measures and procedures to prevent an authorized access or disclosure to your account and personal information.</p>
                    <h5>Users Rights</h5>
                    <p>Administrator of this platform will access the rights of every workers to legally access their personal data that an admins hold and they can obtain to copy it especially their username and password.
You may also as workers have the right to request or reasure of your personal data. Please contact te admin if you wish for having your data or removed it.
</p>
<h5>
Acceptance of the Policy</h5>
<p>Continue to use our platform will signifies your acceptance of this policy. If you may not like to accept our policy, please do not use our platform. 
	Upon engaging to add your account we further request your wholeheartedly acceptance of this privacy policy.
</p>
<h5>Changes of Policy</h5>
<p>As a team we may update this policy at any time of the year. It may change depending on the statements of Barangay that will take the official responsibility for the new holder of every positions.
You may be asked to review those current and old account information and re-accept the policy if changes occur in the time ahead.</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

  
    <script type="text/javascript">
        // Toggle password visibility
        function myfunction() {
            var passField = document.getElementById('pass');
            var iconic = document.getElementById('iconic');
            if (passField.type === "password") {
                passField.type = "text";
                iconic.classList.remove("fa-eye-slash");
                iconic.classList.add("fa-eye");
            } else {
                passField.type = "password";
                iconic.classList.remove("fa-eye");
                iconic.classList.add("fa-eye-slash");
            }
        }

        // Enable login button when terms checkbox is checked
        const termsCheckbox = document.getElementById('termsCheckbox');
        const loginButton = document.getElementById('loginButton');

        termsCheckbox.addEventListener('change', function() {
            loginButton.disabled = !termsCheckbox.checked;
        });
    </script>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
