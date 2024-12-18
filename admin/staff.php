

<?php 
require_once'../db.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/fontawesome6/css/all.min.css">
     <link rel="stylesheet" href="../assets/css/de.css">
     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
     <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
     <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
</head>
<body>
      <?php 
    if (isset($_GET['msginsert'])=="inserted") {
    echo '<script>swal("Staff", "Save Successfully !!","success")</script>';
}
     ?>
            <?php 
    if (isset($_GET['mgstaff'])=="staffupdated") {
    echo '<script>swal("Staff", "Update Successfully !!","success")</script>';
}
     ?>
     <?php 
    if (isset($_GET['msgok'])=="delete") {
    echo '<script>swal("DELETED SUCCESSFULLY !", "Staff Deleted", "success")</script>';
}
     ?>
    <div class="main-container-fluid d-flex">
    <div class="sidebar" id="side_nav" style="background-color: #240750;"> 
    <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
        <h1 class="fs-5">
            <img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> 
            <strong style="color: #fff;">Barangay Sillon</strong>
        </h1>
        <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <ul class="list-unstyled px-3">
        <li class="active">
            <a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block" style="color: black;"> 
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-users"></i> Employees
            </a>
        </li>
        <li>
            <a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-pencil"></i> Payroll
            </a>
        </li>
        <li>
            <a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-book-open"></i> Reports
            </a>
        </li>
        <li>
            <a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-bar-chart"></i> Positions
            </a>
        </li>
        <li>
            <a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-user"></i> Accounts
            </a>
        </li>
        <li>
            <a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block" style="color: #fff;">
                <i class="fas fa-clock"></i> Login / Logout
            </a>
        </li>
    </ul>
    
        </div>
        <div class="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                       <strong style="font-size:22px;"><strong style="font-size: 28px;">a</strong>dmin</strong></a>
                    </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-mdb-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-lg-inline  small " style="color: #000;">
                               Hello,</span>
                               <span class="mr-2 d-lg-inline  small ">
                                <img src="../uploads/<?php echo $row['img']; ?>" style="height: 40px; width:40px; border-radius:50%;" >
                               </span>
                                <span class="mr-2 d-lg-inline  small fw-bold"  style="color: #000;">
                                    <?php echo $row['fname']; ?>                                
                                         </span>
                            </a>
                              <div class="dropdown-menu  shadow animated-grow-in px-4"
                                aria-labelledby="userDropdown"> 
                                 <div class="dropdown-divider"></div>
                                 
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Logout</strong>
                                </a>
                               <div class="dropdown-divider"></div>
                            </div>
                        </li>
        </ul>
                </div>
            </nav>
   <div class="container-fluid">
               <h1 class=" fw-bold mb-0  fs-3 mb-4" style="color: #000;"><strong>Accounts</strong></h1>
              <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2 py-2 px-2">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="staff.php" class="btn form-control fw-bold btn-primary mb-1 mt-1 text-light">Staff</a>
                            </div>
                            <div class="col-md-2">
                                <a href="admin.php" class="btn form-control fw-bold btn-secondary mb-1 mt-1 text-dark">Admin</a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
                 <div class="container-fluid">
                 <div class="row">
                       <div class="card shadow mb-3 p-1">
                        <div class="card-header">
                            <h6 class="m-0  fw-bold" style="color: #000;"><strong style="font-size: 30px;"> Staff  </strong><a class="btn btn-primary" href="add_staff.php" style="color: #fff;"><i class="fas fa-add fs-7" style="color: #fff;"></i><strong class="fs-7">  Add Staff</strong></a></h6>
                        </div>
                        </div>
                        <div class="card-body" style="background-color: #f8f9fa; border-radius: 8px; padding: 20px;">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="myTable" width="100%" cellspacing="0">
            <thead style="font-size: 1.1em; color: #fff; background-color: #8e44ad;">
                <tr>
                    <th class="fw-bold text-center" style="border-radius: 8px 0 0 0;">First Name</th>
                    <th class="fw-bold text-center">Middle Name</th>
                    <th class="fw-bold text-center">Last Name</th>
                    <th class="fw-bold text-center">Age</th>
                    <th class="fw-bold text-center">Gender</th>
                    <th class="fw-bold text-center">Contact No.</th>
                    <th class="fw-bold text-center">Username</th>
                    <th class="fw-bold text-center">Profile Picture</th>
                    <th class="fw-bold text-center" style="border-radius: 0 8px 0 0;">Action</th>
                </tr>
            </thead>
            <tbody style="color: #555;">
                                             <?php 
                                        $qry = "SELECT * FROM staff";
                                        $qry_run = mysqli_query($con, $qry);
                                        while($row1 = mysqli_fetch_array($qry_run)){
                                         ?>
                                        <tr>
                                            <td><?php echo $row1['fname'];?>
                                               </td>
                                            <td><?php echo $row1['mname']; ?></td>
                                             <td><?php echo $row1['lname']; ?></td>
                                            <td><?php echo $row1['age']; ?></td>
                                            <td><?php echo $row1['gender']; ?></td>
                                            <td><?php echo $row1['c_number']; ?></td>
                                            <td><?php echo $row1['uname']; ?></td>
                                            <td>
                                                <center><img height="70" width="70" style="border-radius: 50px;" src="../uploads/<?php  echo $row1['img']; ?>">  </center>
                                                </td>
                                            <td><a  class="ms-2 float-end" data-toggle ="modal" data-target ="#deleteq-<?php echo $row1['id']; ?>"><i class="fa fa-trash text-danger fs-6"></i></a>
                                                <a class="ms-2 float-end" href="update_staff.php?staff_id=<?php echo $row1['id'];?>"><i class="fa fa-edit text-primary fs-6"></i></a></td>
                                        </tr>
                                         <div class="modal fade " id="deleteq-<?php echo $row1['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Delete Staff</strong></h5>
                  <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body text-center"><strong>Are you sure you want to Delete ?</strong></div>
                <div class="modal-footer">
                    <form method="post" action="delete.php">
                         <button class="btn btn-secondary" type="button" data-dismiss="modal" style="color: #000;">Cancel</button>
                    <button class="btn btn-danger " style="color: #fff;" name="delete12" value="<?php echo $row1['id'];?>">Delete</button>
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
            </div>
    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel"><strong>Logout</strong></h5>
                  <button class="close btn-close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body text-center"><strong>Are you sure you want to Logout ?</strong></div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" style="color: #000;">Cancel</button>
                    <a class="btn " style="color: #000; background: skyblue;" href="logout.php" name="logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
   <script src="../assets/js/jquery.min.js"></script>
   <script src="../assets/js/bootstrap.bundle.js"></script>
 <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/mdb.js"></script>

<script src="../vendor/datatables/dataTable.js"></script>
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
<style>
       .table th, .table td {
        vertical-align: middle;
    }

    .table th {
        text-align: center;
        font-weight: bold;
        background-color: #8e44ad;
    }

    .table td {
        text-align: center;
        font-size: 0.95em;
        color: #333;
    }

    .table-hover tbody tr:hover {
        background-color:  #8e44ad;
    }

    .btn-sm {
        font-size: 0.85rem;
    }

    .btn-warning {
        background-color: #f39c12;
        border-color: #e67e22;
    }

    .btn-danger {
        background-color: #e74c3c;
        border-color: #c0392b;
    }

    .btn {
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .table th, .table td {
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #8e44ad;
        color: white;
    }

    .table td {
        color: #333;
    }

    .card-body {
        padding: 15px;
    }
</style>
</body>
</html>
