

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
    echo '<script>swal("SAVE SUCCESSFULLY !", "Employee Save", "success")</script>';
}



     ?>
     <?php 
    if (isset($_GET['msgok'])=="delete") {
    echo '<script>swal("DELETED SUCCESSFULLY !", "Employee Deleted", "success")</script>';
}



     ?>


    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>

                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
            </div>

   


           <ul class="list-unstyled px-3">
                <li class=""><a href="../staff/staff_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
                <li class=""><a href="../staff/employee.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
                <li class="active"><a href="../staff/attendance_rec.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-book"></i> Attendance</a></li>
                
             

            </ul>
            <hr class="h-color mx-2">

         
        </div>


        <div class="content">


        <!-- <div class="content"> -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2" style="background-color: #000;"><i class="fas fa-bars" style="width: 30px; color: #fff;"></i></button>
                       <strong style="font-size:22px;"><strong style="font-size: 28px;">s</strong>taff</strong></a>
                        

                    </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

            </button>
        
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                   <?php 

        if(!empty($_SESSION['idstaff'])){
           $id = $_SESSION['idstaff'];
           $result = mysqli_query($con, "SELECT * FROM staff WHERE id = $id");
           $row = mysqli_fetch_assoc($result);
         }else{
           header("Location: ./index.php");
         }



?> 
<?php 

if(!empty($_SESSION['idstaff'])){


         $onlyone = "SELECT * FROM `attendance`";
                 $result = mysqli_query($con, $onlyone);
      if(mysqli_num_rows($result) > 0){
         

          }else{
            $all ="DELETE FROM `countofdays`";
            mysqli_query($con, $all);


          }
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
                                 <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user-alt fa-sm fa-fw mr-2 fw-bold" style="color: #000;"></i>
                                    <strong class="fw-bold">Profile</strong>
                                </a>
                                 
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

                           <h1 class=" fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Attendance Record</strong></h1>
                             
                
                <div class="row">
 
                       <div class="card shadow mb-3 p-1">
                        <div class="card-header">
                            <h6 class="m-0  fw-bold" style="color: #000;"><strong style="font-size: 28px;">Employee Attendance</strong></h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="myTable" width="100%" cellspacing="0">
                                    <thead style="font-size: 1em; color: #fff;">

                                        <tr>
                                            <th class="fw-bold bg-primary ">Time In</th>
                                            <th class="fw-bold bg-primary ">Time Out</th>
                                             <th class="fw-bold bg-primary">Employee ID</th>
                                            <th class="fw-bold bg-primary">First Name</th>
                                            <th class="fw-bold bg-primary">Middle Name</th>
                                            <th class="fw-bold bg-primary">Last Name</th>
                                            <th class="fw-bold bg-primary ">Status</th>

                                                    
                                                                                  

                                        </tr>
                                    </thead>
                                   
                                
                                    <tbody style="color: #000;">
                                             <?php 
                                        $qry = "SELECT * FROM attendance, employee_info WHERE attendance.emp_id=employee_info.emp_id";
                                        $qry_run = mysqli_query($con, $qry);

                                        while($row1 = mysqli_fetch_array($qry_run)){

                                         ?>
                                        <tr>

                                           
                                            
                                            <td><?php echo  date("F d, Y",strtotime($row1['time_in'])); ?> <?php echo date("h:i:A",strtotime($row1['hour_in'])); ?></td>
                                            <td><?php if ($row1['time_out']== null) {
                                                echo "<p class = 'text-danger fw-bold'>This Employee has not Time Out yet</p>";
                                            }else{
                                                echo $row1['time_out'];
                                            } ?></td>
                                            <td><?php echo $row1['emp_id'];?></td>
                                            <td><?php echo $row1['fname'];?></td>
                                            <td><?php echo $row1['mname'];?></td>
                                            <td><?php echo $row1['lname'];?></td>
                                             <td><?php if ($row1['status'] == 'Late Time In') {
                                                echo "<p class = 'text-danger fw-bold'>".$row1['status']."</p>";
                                            }else{
                                                echo "<p class = 'text-success fw-bold'>".$row1['status']."</p>";
                                                 
                                            };?></td>
                                            
                                            
                                        </tr>

                                        

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

 <script>
    let table = new DataTable('#myTable', {
    // options
});

    $(".sidebar ul li").on('click' , function(){
        $(".sidebar ul li.active").removeClass('active');
        $(this).addClass('active');


    });

    $('.open-btn').on('click' , function(){
        $('.sidebar').addClass('active');
    });
    $('.close-btn').on('click' , function(){
        $('.sidebar').removeClass('active');
    });
   </script> 


</body>
</html>