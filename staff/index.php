<?php
require_once("../db.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login Form</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/mdb.css">
    <link rel="stylesheet" type="text/css" href="../assets/fontawesome6/css/all.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body style="background-size: cover; background-repeat: no-repeat; background-position: center; background: #09111d;">

    <main class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card rounded">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 py-5 px-3 bg-light">
                            <img src="../assets/img/sillon.jpg" alt="logo" class="w-100">
                                <center>
                                    <p class="fw-bold" style="color: #09111d; font-size:30px;"><strong>Welcome Staff</strong></p>
                                    <p style="font-size:12px; color: #09111d;">Workers of Brgy.Sillon prove as the role models within the community.</p>
                                </center>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8">
                                            <form method="post">
                                                <?php
                                                error_reporting(0);
                                                $try = "SELECT * FROM loginrec ORDER BY login_id DESC LIMIT 1";
                                                $result00 = mysqli_query($con, $try);
                                                if ($result00) {
                                                    $fetch = mysqli_fetch_assoc($result00);
                                                    $rollnumber = $fetch['login_id'];
                                                    if ($rollnumber == null) {
                                                        $rael = "S24000000";
                                                    } else {
                                                        $rael = str_replace("S24", "", $rollnumber);
                                                        $rael = str_pad($rael + 1, 6, 0, STR_PAD_LEFT);
                                                        $rael = "S24" . $rael;
                                                    }
                                                } else {
                                                    echo "<script>alert('Server Error') </script>";
                                                }
                                                ?>
                                                <?php
                                                if (isset($_POST['login'])) {
                                                    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
                                                    $password = htmlspecialchars(stripslashes(trim($_POST['password'])));
                                                    $query = $con->prepare("SELECT * FROM staff WHERE uname = ?");
                                                    $query->bind_param('s', $email);
                                                    $query->execute();
                                                    $result = $query->get_result();

                                                    if (!empty($email) && !empty($password)) {
                                                        if ($result->num_rows > 0) {
                                                            $row = $result->fetch_assoc();
                                                            if (password_verify($password, $row['pass'])) {
                                                                $_SESSION['idstaff'] = $row['id'];
                                                                $namegid = $row['fname'];
                                                                $insert_sql = "INSERT INTO `loginrec`(`login_id`,`fname`) VALUES ('$rael','$namegid')";
                                                                $omg = mysqli_query($con, $insert_sql);
                                                                if ($omg) {
                                                                    $sqlhh = "SELECT * FROM loginrec WHERE login_id ='$rael'";
                                                                    $resulthh = mysqli_query($con, $sqlhh);
                                                                    $rowh = mysqli_fetch_assoc($resulthh);
                                                                    $_SESSION['idstaffs'] = $rowh['login_id'];
                                                                    header("location:./staff_dash.php?msg=login");
                                                                }
                                                            } else {
                                                                echo "<div class='alert alert-danger py-2 px-2 text-center'><a href='' class='btn-close float-end'></a>Incorrect username or password</div>";
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
                                                <input class="form-control" type="text" name="email" placeholder="Enter username" autocomplete="off">
                                                <label class="mt-2"><i class="fa fa-lock me-2"></i>Password</label>
                                                <div class="position-relative">
                                                    <input class="form-control" type="password" name="password" id="pass" placeholder="Enter password" autocomplete="off">
                                                    <i class="fa fa-eye-slash" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;" onclick="togglePasswordVisibility()" id="password-toggle"></i>
                                                </div>

                                                <div class="mt-3">
                                                    <input type="checkbox" id="termsCheckbox" name="terms" required>
                                                    <label for="termsCheckbox" class="ms-3">I accept the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a></label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" name="login" class="btn btn-primary mt-1 form-control text-light" id="loginButton" disabled><i class="fa fa-sign-in me-1"></i>LOGIN</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="termsModalLabel">TERMS & CONDITIONS (Sillon Barangay Workforce Attendance System)</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div style="color: black; text-align: justify;" class="modal-body">
                                                        <ul>
                                                        <li>Information We Hold About You</li>
                                                        <p>Your name (firstname, lastname, and middlename).</p>
                                                        <p>Your age, birthdate, gender, and contact information number.</p>
                                                        <p>Any additional data that you choose to share, such as images.
                                                        And we collect some or all this information that depeds in the following access of our platform:</p>
                                                        <p>Your registered username and password</p>
                                                        <p>You fill out our contact form</p>
                                                        <li>How Your Personal Information Is Used</li>
                                                        <p>We might use your information in the following terms:</p>
                                                        <p>To register your employee accounts, enable you to get your employee ID for your everyday attendance.</p>
                                                        <p>To let you access your information (update or delete)</p>
                                                        <p>To record your IP Address when you perform certain actions, ensuring that it's never publicly visible but privately seen on your perspective.</p>
                                                        <p>We use your information for registering employee accounts and enabling daily attendance tracking.</p>
                                                        <li>Additional</li>
                                                        <p>Administrator can reset your password in terms you forget or you want to address on getting your password new to your accountability.</p>
                                                        <li>Keeping Your Data Secured</li>
                                                        <p>We as a team are committed to ensures everyone of you that any information you provided to us is secured.</p>
                                                        <p>We have implemented suitable measures and procedures to prevent an authorized access or disclosure to your account and personal information.</p>
                                                        <li>Users Rights</li>
                                                        <p>Administrator of this platform will access the rights of every workers to legally access their personal data that an admins hold and they can obtain to copy it especially their username and password.</p>
                                                        <p>You may also as workers have the right to request or reasure of your personal data. Please contact te admin if you wish for having your data or removed it.</p>
                                                        <li>Acceptance of the Policy</li>
                                                        <p>Continue to use our platform will signifies your acceptance of this policy. If you may not like to accept our policy, please do not use our platform. 
	                                                       Upon engaging to add your account we further request your wholeheartedly acceptance of this privacy policy.</p>
                                                        <li>Changes of Policy</li>
                                                        <p>As a team we may update this policy at any time of the year. It may change depending on the statements of Barangay that will take the official responsibility for the new holder of every positions.
                                                           You may be asked to review those current and old account information and re-accept the policy if changes occur in the time ahead.</p>
                                                        
                                            </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        function togglePasswordVisibility() {
            var passField = document.getElementById("pass");
            var icon = document.getElementById("password-toggle");

            if (passField.type === "password") {
                passField.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                passField.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }

        const termsCheckbox = document.getElementById('termsCheckbox');
        const loginButton = document.getElementById('loginButton');

        termsCheckbox.addEventListener('change', function() {
            loginButton.disabled = !termsCheckbox.checked;
        });
    </script>

    <script type="text/javascript">
        <?php if (isset($error_message) && $error_message): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $error_message; ?>',
            });
        <?php endif; ?>
    </script>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
