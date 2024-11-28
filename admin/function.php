<?php

require_once("../mailer.php");
require_once("../db.php");

if (isset($_POST["btn-forgotpass"])) {
    // Get email from the form
    $email = $_POST["email"];
    $reset_code = random_int(100000, 999999); // Generate a random OTP for password reset
    
    // Update the reset code in the database for the corresponding email
    $sql = "UPDATE `admin` SET `code`='$reset_code' WHERE email='$email'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        // Prepare and send the email with the reset link
        $mail->SetFrom("jessaungud@gmail.com");
        $mail->AddAddress($email);
        $mail->Subject = "Reset Password OTP";
        $mail->Body = "Use this OTP Code to reset your password: " . $reset_code . "<br/>" .
                      "Click the link to reset your password: http://localhost/Barangay-Sillon/admin/reset_password.php?reset&email=$email"; // Provide the reset link
        
        // Send the email
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message has been sent"; // Success message
        }

        // Notify the user and redirect back to the forgot password page
        $_SESSION["notify"] = "success";
        header("location: ../admin/forgot_password.php");
    } else {
        // If the query fails, notify and redirect
        $_SESSION["notify"] = "failed";
        header("location: ../admin/forgot_password.php");
    }
}

// New password submission (after OTP validation)
if (isset($_POST["btn-new-password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $otp = $_POST["otp"]; // OTP from the form

    // Query the database to get the stored OTP for the email
    $sql = "SELECT `code` FROM `admin` WHERE email='$email'";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        while ($res = mysqli_fetch_assoc($query)) {
            $get_code = $res["code"];
        }

        // Verify if the provided OTP matches the one stored in the database
        if ($otp === $get_code) {
            // Hash the new password using bcrypt (password_hash automatically uses bcrypt)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Generate a new reset code
            $reset = random_int(100000, 999999);

            // Update the password and reset code in the database
            $sql = "UPDATE `admin` SET `pass`='$hashed_password', `code`=$reset WHERE email='$email'";

            $query = mysqli_query($con, $sql);

            if ($query) {
                $_SESSION["notify"] = "success";
                header("location: ../admin/index.php");
            } else {
                $_SESSION["notify"] = "failed";
                header("location: ../admin/forgot_password.php");
            }
        } else {
            // Invalid OTP
            $_SESSION["notify"] = "invalid";
            header("location: ../admin/forgot_password.php");
        }
    } else {
        // Email not found
        $_SESSION["notify"] = "invalid";
        header("location: ../admin/forgot_password.php");
    }
}
?>
