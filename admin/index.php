<?php
// Start the session at the beginning of the script

require_once("../db.php");

// Max login attempts before lockout
$maxAttempts = 5;
$lockoutTime = 15 * 60; // 15 minutes

$error_message = ''; // Initialize error message

// Initialize failed attempts and lockout time in session if not set
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
    $_SESSION['lockout_time'] = 0;
}

// Check if user is currently locked out
if ($_SESSION['failed_attempts'] >= $maxAttempts) {
    // Check if lockout period has passed
    if (time() - $_SESSION['lockout_time'] < $lockoutTime) {
        // Convert lockout time to minutes
        $remainingTime = ceil(($lockoutTime - (time() - $_SESSION['lockout_time'])) / 60);
        $error_message = "Too many login attempts. Please try again after $remainingTime minute(s).";
    } else {
        // Reset failed attempts after lockout time has passed
        $_SESSION['failed_attempts'] = 0;
        $_SESSION['lockout_time'] = 0;
    }
}

if (isset($_POST['login']) && $_SESSION['failed_attempts'] < $maxAttempts) {
    $user = htmlspecialchars(stripslashes(trim($_POST['user'])));
    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));

    // Check if the user and password fields are empty
    if (empty($user) || empty($password)) {
        $error_message = 'You must fill all fields';
    } else {
        // Query the database for the admin with the provided email
        $query = $con->prepare("SELECT * FROM admin WHERE email = ?");
        $query->bind_param('s', $user);
        $query->execute();
        $result = $query->get_result();

        // If a matching user is found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['pass'])) {
                // Successful login: Set the session variable and redirect
                $_SESSION['idadmins'] = $row['id'];
                $_SESSION['failed_attempts'] = 0; // Reset failed attempts on success
                header("Location: ./admin_dash.php?msg=login");
                exit; // Ensure no further code execution after redirection
            } else {
                // Incorrect password
                $_SESSION['failed_attempts'] += 1; // Increment failed attempts
                $error_message = 'Incorrect username or password';
            }
        } else {
            // No matching user
            $_SESSION['failed_attempts'] += 1; // Increment failed attempts
            $error_message = 'Incorrect username or password';
        }
    }

    // If too many failed attempts, set lockout time
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
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
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

        // Show SweetAlert if there's an error message
        <?php if ($error_message): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $error_message; ?>',
            });
        <?php endif; ?>
    </script>
</body>

</html>
