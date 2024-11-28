<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <title>Forgot Password</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #a31414;
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
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 10px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="../admin/function.php" method="post">
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
            <button type="submit" name="btn-forgotpass">Send Reset Link</button>
        </form>
        <p>We'll send a link to reset your password.</p>
    </div>
    <script>
    <?php
    // Check if there's a session message to displays
    if (isset($_SESSION['notify'])) {
        $message = addslashes($_SESSION['notify']);
        if (strpos($message, 'success') !== false) {
            echo "Swal.fire({
                title: 'Success',
                text: '$message',
                icon: 'success',
                confirmButtonText: 'OK'
            });";
        } else {
            echo "Swal.fire({
                title: 'Error',
                text: '$message',
                icon: 'error',
                confirmButtonText: 'OK'
            });";
        }
        unset($_SESSION['notify']);
    }
    ?>
</script>
</body>
</html>
