<?php
require_once("../db.php");

if (isset($_GET["reset"])) {
    $email = $_GET["email"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color:  #e06666;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-size: 16px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
            display: block;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #722b2b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #722b2b;
        }

        p {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 10px;
        }

        a {
            color: #722b2b;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .timer {
            font-size: 14px;
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script>
        // Add a countdown timer for OTP expiration
        var expiryTime = <?php echo isset($_SESSION['otp_expiry']) ? $_SESSION['otp_expiry'] : '0'; ?>;
        if (expiryTime) {
            var countdown = setInterval(function() {
                var currentTime = Math.floor(Date.now() / 1000);  // Get current time in seconds
                var remainingTime = expiryTime - currentTime;

                if (remainingTime <= 0) {
                    clearInterval(countdown);
                    document.getElementById("timer").innerHTML = "OTP has expired.";
                } else {
                    var minutes = Math.floor(remainingTime / 60);
                    var seconds = remainingTime % 60;
                    document.getElementById("timer").innerHTML = "Time remaining: " + minutes + "m " + seconds + "s";
                }
            }, 1000);
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Reset Password</h2>
    <form action="../admin/function.php" method="post">
        <div class="form-group">
            <input type="hidden" name="email" class="form-control" value="<?php echo $email ?>" required readonly>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="OTP Code" name="otp" required>
        </div>
        <!-- Timer will appear here if OTP expiry is set -->
        <div id="timer" class="timer">
            <!-- Countdown Timer will be displayed here -->
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Set new password" name="password" required 
                   pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" 
                   title="Password must be at least 8 characters long, include at least one number and one special character.">
        </div>
        <button type="submit" name="btn-new-password">Set Password</button>
    </form>
</div>

</body>
</html>
