<?php 
require_once'../db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Accounts</title>
    <link rel="stylesheet" href="../assets/css/mdb.min.css">
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/de.css">
    <link rel="shortcut icon" href="../assets/img/sillon.jpg">
    <link rel="stylesheet" href="../assets/css/datatables.css">
    <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
</head>
<body>
    <?php 
        if (isset($_GET['msginsert']) && $_GET['msginsert'] == "inserted") {
            echo '<script>swal("Staff", "Save Successfully !!","success")</script>';
        }
    ?>
    <?php 
        if (isset($_GET['mgstaff']) && $_GET['mgstaff'] == "staffupdated") {
            echo '<script>swal("Staff", "Update Successfully !!","success")</script>';
        }
    ?>
    <?php 
        if (isset($_GET['msgok']) && $_GET['msgok'] == "delete") {
            echo '<script>swal("DELETED SUCCESSFULLY !", "Staff Deleted", "success")</script>';
        }
    ?>
    <div class="d-flex">
        <div class="sidebar" id="side_nav" style="background-color: #240750;"> 
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5 text-white">
                    <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
                    <strong>Barangay Sillon</strong>
                </h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <ul class="list-unstyled px-3">
                <li class="active"><a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-users"></i> Employees</a></li>
                <li><a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-pencil"></i> Payroll</a></li>
                <li><a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-book-open"></i> Reports</a></li>
                <li><a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-bar-chart"></i> Positions</a></li>
                <li><a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-user"></i> Accounts</a></li>
                <li><a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block text-white"><i class="fas fa-clock"></i> Login / Logout</a></li>
            </ul>
        </div>
        <div class="content flex-grow-1">
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="color: #fff;"></i></button>
                        <strong class="fs-4">Admin</strong>
                    </div>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php 
                            if(!empty($_SESSION['idadmins'])){
                               $id = $_SESSION['idadmins'];
                               $result = mysqli_query($con, "SELECT * FROM admin WHERE id = $id");
                               $row = mysqli_fetch_assoc($result);
                            }else{
                               header("Location: ./index.php");
                            }
                        ?>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline small text-dark">Hello,</span>
                                <span class="mr-2 d-lg-inline small fw-bold text-dark"><?php echo $row['fname']; ?></span>
                                <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" alt="Profile Image">
                            </a>
                            <div class="dropdown-menu shadow animated-grow-in" aria-labelledby="userDropdown"> 
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h1 class="fw-bold fs-3 mb-4 text-dark"><strong>Accounts</strong></h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="staff.php" class="btn btn-outline-primary w-100 fw-bold mb-1">Staff</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="admin.php" class="btn btn-outline-secondary w-100 fw-bold mb-1">Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-dark" style="font-size: 1.25rem;"><strong>Staff</strong></h6>
                        <a class="btn btn-primary" href="add_staff.php"><i class="fas fa-plus-circle"></i> Add Staff</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Contact no.</th>
                                        <th>Username</th>
                                        <th>Profile Picture</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    <?php 
                                        $qry = "SELECT * FROM staff";
                                        $qry_run = mysqli_query($con, $qry);
                                        while($row1 = mysqli_fetch_array($qry_run)){
                                    ?>
                                    <tr>
                                        <td><?php echo $row1['fname']; ?></td>
                                        <td><?php echo $row1['mname']; ?></td>
                                        <td><?php echo $row1['lname']; ?></td>
                                        <td><?php echo $row1['age']; ?></td>
                                        <td><?php echo $row1['gender']; ?></td>
                                        <td><?php echo $row1['c_number']; ?></td>
                                        <td><?php echo $row1['uname']; ?></td>
                                        <td><img height="70" width="70" style="border-radius: 50%;" src="../uploads/<?php echo $row1['img']; ?>"></td>
                                        <td>
                                            <a class="ms-2" data-toggle="modal" data-target="#deleteq-<?php echo $row1['id']; ?>"><i class="fa fa-trash text-danger"></i></a>
                                            <a class="ms-2" href="update_staff.php?staff_id=<?php echo $row1['id'];?>"><i class="fa fa-edit text-primary"></i></a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteq-<?php echo $row1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel"><strong>Delete Staff</strong></h5>
                                                    <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center"><strong>Are you sure you want to Delete?</strong></div>
                                                <div class="modal-footer">
                                                    <form method="post" action="delete.php">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-danger" name="delete12" value="<?php echo $row1['id'];?>">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logout Modal -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel"><strong>Logout</strong></h5>
                            <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center"><strong>Are you sure you want to Logout?</strong></div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-warning" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.js"></script>
    <script src="../assets/js/mdb.min.js"></script>
    <script>
        $('.open-btn').on('click', function() {
            $('#side_nav').addClass('active');
            $('.content').addClass('shift');
        });

        $('.close-btn').on('click', function() {
            $('#side_nav').removeClass('active');
            $('.content').removeClass('shift');
        });
    </script>
</body>
</html>
