

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
   


    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>

                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
            </div>

   


           <ul class="list-unstyled px-3">
                <li class=""><a href="../staff/staff_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
                <li class="active"><a href="../staff/emp_info.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
                <li class=""><a href="../staff/attendance_rec.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-book"></i> Attendance</a></li>
               
             

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
        
            <div class="col-md-12">
            
                <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 mb-3">
                            <div class="card py-1 px-1 cb1 " style="color: #000;">
                                <div class="card-header bg-primary">
                                    <a href="attendance_rec.php" class="btn-close float-end py-1" ></a>
                                        <span aria-hidden="true"></span>
                                    <h5 style=" color: #fff;"> <i class="fas fa-user" style="color: #000;"> </i>&nbsp;<strong >      Employee</strong></h5>
                                    
                                </div>
                                            <?php 
                            if (isset($_GET['employee_id'])) {
                            $getemployee_id = $_GET['employee_id'];

                                $sql = "SELECT * FROM employee_info WHERE emp_id ='$getemployee_id'";
                                $res = mysqli_query($con,$sql);
                                $rower = mysqli_fetch_assoc($res);
                            }

                                $e_id = $rower['emp_id'];
                                if(!empty($e_id)){
                                    $sql = "SELECT * FROM attendance_proof WHERE employee_id = '$getemployee_id' AND DATE(date)";
                                    $res = mysqli_query($con,$sql);
                                    $rows = mysqli_fetch_assoc($res);
                                }

                                $em_id = $rows['employee_id'];
                                if(!empty($em_id)){
                                    $sql = "SELECT * FROM attendance WHERE emp_id = '$getemployee_id' AND DATE(time_in)";
                                    $res = mysqli_query($con,$sql);
                                    $rows1 = mysqli_fetch_assoc($res);
                                }

                             ?>
                            <div class="card-body" >
            
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="row">


                                        <div class="col-md-6">
                                        <label>Time-In Photo</label>
                                        <a href="../uploads/<?php echo $rows['image_in']; ?>" target="_blank">
                                        <img  class="form-control mb-1" src="<?php echo "../uploads/".$rows['image_in'] ?>" alt="" style="height: 250px; width: 100%;">       
                                        </a>
                                        </div>     
                                        <div class="col-md-6">
                                        <label>Time-Out Photo</label>
                                        <a href="../uploads/<?php echo $rows['image_out']; ?>" target="_blank">
                                        <img  class="form-control mb-1" src="<?php echo "../uploads/".$rows['image_out'] ?>" alt="" style="height: 250px; width: 100%;">       
                                        </a>
                                        </div>                            

                                   
                                            
                                        <div class="col-md-6">
                                             <input class="form-control mb-1 text-primary" type="hidden" value="<?php echo  $rower['emp_id']; ?>" name="empid"style="font-size :15px;">
                                             <label>First Name</label>
                                        <input readonly class="form-control mb-1" type="text" name="first" placeholder="Enter First Name" value="<?php echo  $rower['fname']; ?>" style="font-size :15px;"required>
                                        
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <label>Middle Name</label>
                                        <input readonly class="form-control mb-1" type="text" name="mid" placeholder="Enter Middle Name" value="<?php echo  $rower['mname']; ?>" style="font-size :15px;"required>
                                    </div> -->
                                    <div class="col-md-6">
                                        
                                        <label>Last Name</label>
                                        <input readonly class="form-control mb-1" type="text" name="last" placeholder="Enter Last Name" value="<?php echo  $rower['lname']; ?>" style="font-size :15px;" required >
                                    </div>
                                   
                                    
                                    <!-- <div class="col-md-6">
                                        <label>Select Gender</label>
                                     <input readonly class="form-control mb-1" type="text" name="last" placeholder="Enter Last Name" value="<?php echo  $rower['gender']; ?>" style="font-size :15px;" required >
    
                                        
                                    </div> -->
                                    

                                    <?php
                                    if(!empty($rows['location'])){
                                        list($latitude, $longitude) = explode(',', $rows['location']);
                                        function convertToDMS($decimal, $isLatitude) {

                                            $degrees = intval($decimal);
                                            $tempMinutes = ($decimal - $degrees) * 60;
                                            $minutes = intval($tempMinutes);
                                            $seconds = ($tempMinutes - $minutes) * 60;

                                            // Determine the direction
                                            if ($isLatitude) {
                                                $direction = ($decimal >= 0) ? 'N' : 'S';
                                            } else {
                                                $direction = ($decimal >= 0) ? 'E' : 'W';
                                            }
                                            return sprintf("%d°%d'%.1f\"%s", abs($degrees), abs($minutes), abs($seconds), $direction);

                                            if(empty($locate)){
                                                $locate = "no location";
                                            }
                                        }

                                    $latitudeDMS = convertToDMS($latitude, true);
                                    $longitudeDMS = convertToDMS($longitude, false);

                                    $locate =  htmlspecialchars($latitudeDMS . "+" . $longitudeDMS, ENT_QUOTES, 'UTF-8');
                                        $err_locate = "<b>Click to view location</b>";
                                    }else{
                                        $err_locate = "Geolocation not detected";
                                    }
                                    // Given date and time string
                                    $dateString = ($rows1['time_in']." ".$rows1['hour_in']);
                                    // Create a DateTime object from the given string
                                    $dateTime = DateTime::createFromFormat("y-m-d H:i:s", $dateString);
                                    // Format the DateTime object to the desired format
                                    $formattedDate = $dateTime->format("F d, Y h:i A");
                                    ?>
                                    <div class="col-md-6">
                                        <label>Time-In</label>
                                         <input  readonly class="form-control mb-1" type="text" name="first" placeholder="This Employee has not Time In yet" value="<?php echo $formattedDate  ?>" style="font-size :15px;"required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Time-Out</label>
                                         <input  readonly class="form-control mb-1" type="text" name="first" placeholder="This Employee has not Time Out yet" value="<?php echo $rows1['time_out'];  ?>" style="font-size :15px;"required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Position</label>
                                         <input  readonly class="form-control mb-1" type="text" name="first" placeholder="Position" value="<?php echo $rower['posistion'];  ?>" style="font-size :15px;"required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Track Location</label>
                                        <a class="form-control mb-1" href="https://www.google.com/maps/place/<?php echo $locate;?>/" target="no_target"><?php echo $err_locate; ?></a>
                                    </div>
                                                                                        
                                    </div>                       
                                   
                                    

                                    <!-- <div class=" modal-footer mt-3 w-100">
                                        <button onmousemove="FindAge()" class="btn bg-success ms-auto text-light" name="update" type="submit"> <label>Update</label></button>
                                    </div> -->
                                        </div>
                                    </form>
        
    
       
            


        <!-- </div> -->
        </div>
        
    

                    

   


                

            </div>
            

        </div>
        <div class="col-md-2"></div>



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

