<?php
// Start session
session_start();

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

