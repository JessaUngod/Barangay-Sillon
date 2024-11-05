

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
    if (isset($_GET['msgupdate'])=="submitupdate") {
    echo '<script>swal("UPDATE SUCCESSFULLY!", "Updated", "success")</script>';
}



     ?>
  <?php 
    if (isset($_GET['msgsubmit'])=="submitposistion") {
    echo '<script>swal("SAVE SUCCESSFULLY!", "Posisition Save", "success")</script>';
}



     ?>
     <?php 
    if (isset($_GET['msgnegative'])=="negative") {
    echo '<script>swal("ERROR!", "Dont user negative Number", "warning")</script>';
}



     ?>
       <?php 
    if (isset($_GET['msgallready'])=="allready") {
    echo '<script>swal("ERROR!", "Posisition is allready inserted", "warning")</script>';
}



     ?>


    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>

                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
            </div>

   


           <ul class="list-unstyled px-3">
                <li class=""><a href="../admin/admin_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
                <li class=""><a href="../admin/employee.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
                <li class=""><a href="../admin/employee_payroll.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-pencil"></i> Payroll</a></li>
                <li class=""><a href="../admin/payroll_rec.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-book-open"></i> Reports</a></li>
                <li class="active"><a href="../admin/posistion.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-bar-chart"></i> Positions</a></li>
                <li class=""><a href="../admin/accounts.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-user"></i> Accounts</a></li>
                <li class=""><a href="../admin/log_rec.php" class="text-decoration-none px-3 py-2 d-block"><i class="fas fa-clock"></i> Login / Logout</a></li>
             

            </ul>
            <hr class="h-color mx-2">

         
        </div>


        <div class="content">


        <!-- <div class="content"> -->
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

                           <h1 class=" fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Positions</strong></h1>
                             
                <div class="col-md-12">
                <div class="row">
                    
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                             <div class="card shadow mb-3 p-1">
                        <div class="card-header">
                            <h6 class="m-0  fw-bold" style="color: #000;"><strong style="font-size: 28px;">Posistion Record   </strong><button class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#posistions"> <i class="fas fa-add"></i><strong>  Add  Posistion</strong></button></h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="myTable" width="100%" cellspacing="0">
                                    <thead style="font-size: 1em; color: #fff;">

                                        <tr>
                                           
                                            <th class="fw-bold bg-primary" >Posistion</th>
                                           
                                            <th class="fw-bold bg-primary text-center" >Per Day</th>         
                                                                                  

                                        </tr>
                                    </thead>
                                   
                                
                                    <tbody style="color: #000;">
                                             <?php 
                                        $qry = "SELECT * FROM `pos_and_amount`";
                                        $qry_run = mysqli_query($con, $qry);

                                        while($row1 = mysqli_fetch_array($qry_run)){

                                         ?>
                                        <tr>

                                            <td class="fw-bold"><?php echo $row1['posistion'];?><a  class="ms-2 float-end" data-mdb-toggle ="modal" data-mdb-target ="#posistion-<?php echo $row1['id']; ?>"><i class="fa fa-edit text-primary fs-6"></i></a>


                                                </td>
                                            <td class="text-center fw-bold">&#8369 <?php echo $row1['amount']; ?></td>
                                          
                                            
                                        </tr>

                                         <div class="modal fade" id="posistion-<?php echo $row1['id']; ?>">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header bg-primary">
                  <h5 class="modal-title" style=" color: #fff;"> <strong> Posistion</strong> </h5>
                    <button class="close btn-close fs-6 mb-3" data-mdb-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
               

                <div class="modal-body col-md-12 fw-bold"  style="color: #000;">
                     
                                        <form method="post" action="insert_lang.php">
                                        <div class="row">
                                        <div class="col-md-6" style="border: 23px;">
                                        <label>Posistion</label>
                                        <input class="form-control mb-3" type="hidden" name="idid"value="<?php echo $row1['id'];?>" required>
                                        <input class="form-control mb-3" type="hidden" name="editposis"value="<?php echo $row1['posistion'];?>" required >
                                        <input class="form-control mb-3" type="text" name="posis"value="<?php echo $row1['posistion'];?>" required >
                                    </div>
                                     <div class="col-md-6">
                                        <label>Amount Per Day</label>
                                        <input class="form-control mb-3" type="number" name="amount" value="<?php echo $row1['amount'];?>" required>
                                        
                                    </div>

                                   
                                

                                 
                                    </div>
                                      <center><div class="mt-3">
                                        <button class="btn bg-success text-light" name="submits" >Update</button>
                                    </div> </center> 
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
                        <div class="col-md-2"></div>
                        
                    </div>
 
                      
                </div>
           


                
            </div>


             <div class="modal fade" id="posistions">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header bg-primary">
                  <h5 class="modal-title" style=" color: #fff;"> <strong> Posistion</strong> </h5>
                    <button class="close btn-close fs-6 mb-3" type="button" data-mdb-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
               

                <div class="modal-body col-md-12 fw-bold"  style="color: #000;">
                     
                  
                               
                                        <form method="post" action="insert_lang.php">
                                        <div class="row">
                                        <div class="col-md-6" style="border: 23px;">
                                        <label>Posistion</label>
                                        <input class="form-control mb-3" type="text" name="posis" placeholder="Enter Posistion" required>
                                    </div>
                                     <div class="col-md-6">
                                        <label>Amount Per Day</label>
                                        <input class="form-control mb-3" type="number" name="amount" placeholder="Enter Amount" required>
                                        
                                    </div>

                                   
                                

                                 
                                    </div>
                                      <center><div class="mt-3">
                                        <button class="btn bg-primary text-light" name="submit" >Submit</button>
                                    </div> </center> 
                                    </form>
             

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

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugins -->
    <!-- <script src="../vendor/datatables/jquery.dataTables.min.js"></script> -->
    <!-- <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script> -->
  <!-- <script src="../assets/js/jquery.min.js"></script> -->
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/mdb.js"></script>
<!-- <script src="../js/demo/datatables-demo.js"></script> -->
<script src="../vendor/datatables/dataTable.js"></script>

 <script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/mdb.js"></script>
 <script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.js"></script>
<script src="../assets/js/mdb.js"></script>
<script>
    // Sidebar toggle functionality
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
