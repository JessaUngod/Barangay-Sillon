<?php 
require_once("../db.php");
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
</head>
<body style="background-size: cover; background-repeat: no-repeat; background-position: center; background: #09111d;">

<main class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">

    <div class="col-8">
        <div class="card rounded">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="background: url(../assets/img/sillon.jpg); background-size: cover; background-repeat: no-repeat; background-position: center; height: 500px; width: 500px; margin-left: 200px;"></div>

                    <div class="col-md-6 py-5 px-3 bg-light" style="margin-left: 200px">
                        <center>
                            <p class="fw-bold" style="color: #09111d; font-size: 30px;"><strong>Welcome Admin</strong></p>
                            <p style="font-size: 12px; color: #09111d;">Workers of Brgy.Sillon prove as the role models within the community.</p>
                        </center>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <form method="post">
                                        <?php 
                                        if(isset($_POST['login'])){
                                            $user = $_POST['user'];
                                            $password = $_POST['password'];
                                            $query = "SELECT * FROM admin WHERE uname = '$user'";
                                            $result = mysqli_query($con, $query);
                                            $row = mysqli_fetch_array($result);

                                            if(!empty($user) && !empty($password)){
                                                if(mysqli_num_rows($result)>0){
                                                    if($user == $row['uname'] && $password == $row['pass']){
                                                        $_SESSION['idadmins'] = $row['id'];
                                                        header("location:./admin_dash.php?msg=login");
                                                    } else {
                                                        // Handle incorrect password case if needed
                                                    }
                                                } else {
                                                    echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
                                                }
                                            } else {
                                                echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>You must fill all fields</div>";
                                            }
                                        }
                                        ?>
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
                                                    <button type="submit" name="login" class="btn btn-primary mt-1 form-control text-light"><i class="fa fa-sign-in me-1"></i>LOGIN</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <script type="text/javascript">
                                        function myfunction(){
                                            var x = document.getElementById("pass");

                                            if(x.type === "password"){
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
