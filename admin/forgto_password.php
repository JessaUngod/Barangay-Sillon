<?php
require_once("../db.php");

if (isset($_POST['submit'])) {
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));

    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email exists in the database
        $query = $con->prepare("SELECT * FROM admin WHERE email = ?");
        $query->bind_param('s', $email);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            // Generate password reset token
            $token = bin2hex(random_bytes(50));

            // Save token in the database (you can save it with an expiration time)
            $updateQuery = $con->prepare("UPDATE admin SET reset_token = ? WHERE email = ?");
            $updateQuery->bind_param('ss', $token, $email);
            $updateQuery->execute();

            // Send email with reset link
            $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;
            $subject = "Password Reset Request";
            $message = "Click the link below to reset your password:\n" . $resetLink;
            mail($email, $subject, $message);

            echo "<div class='alert alert-success'>Password reset link has been sent to your email.</div>";
        } else {
            echo "<div class='alert alert-danger'>Email not found in the database.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please enter a valid email address.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
</head>
<body>
    <form method="post">
        <label for="email">Enter your email to reset your password:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>
