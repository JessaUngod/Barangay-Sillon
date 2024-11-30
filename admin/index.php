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
            // No matching user
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
    
      <script src="https://www.google.com/recaptcha/api.js?render=6Lc95IwqAAAAAAqgeTiHvRIFCgIE4LsQortunSBT"></script> <!-- Replace with your Site Key -->
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
                                        <label for ="termsCheckbox" class="ms-3">I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditons</a>
    </label>

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
    <!-- Modal for Terms and Conditions -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Introduction</h5>
                <p>Please read these Terms and Conditions carefully before using our service.</p>
                <h5>Use of Service</h5>
                <p>By using this service, you agree to abide by the rules and regulations set forth.</p>
                <h5>Privacy Policy</h5>
                <p>We are committed to protecting your privacy. Please review our Privacy Policy for more details.</p>
                <!-- Add more terms here as necessary -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

 
        <?php if ($error_message): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $error_message; ?>',
            });
        <?php endif; ?>
    </script>
    <script>
    // Function to toggle the password visibility
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

    // Enable login button if terms checkbox is checked
    const termsCheckbox = document.getElementById('termsCheckbox');
    const loginButton = document.getElementById('loginButton');

    termsCheckbox.addEventListener('change', function() {
        loginButton.disabled = !termsCheckbox.checked;
    });
</script>
</body>

</html>
