

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
     <script type="text/javascript" src="../assets/js/apexchart.js"></script>

     
</head>
<body>
    <?php 
    if (isset($_GET['msg'])=="login") {
    echo '<script>swal("LOGIN SUCCESSFULLY!", "Welcome Back Staff", "success")</script>';
}



     ?>


    <div class="main-container-fluid d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-3 pt-3 pb-2 d-flex justify-content-between">
                <h1 class="fs-5"><img src="../assets/img/sillon.jpg" style="width: 61px; height: 61px; border-radius: 50%;"> <strong style="color: #fff;">Barangay Sillon </strong></h1>

                <button class="btn d-md-none d-block close-btn px-1 py-0 pb-2 text-white"><i class="fas fa-bars"></i></button>
            </div>

   


           <ul class="list-unstyled px-3">
                <li class="active"><a href="../staff/staff_dash.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-home"></i> Dashboard</a></li>
                <li class=""><a href="../staff/employee.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fas fa-users"></i> Employees</a></li>
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
           $result = mysqli_query($con, "SELECT * FROM staff WHERE id = '$id'");
           $row = mysqli_fetch_assoc($result);
         $names= $row['fname'];
         $mid= $row['mname'];
         $laslas= $row['lname'];
         }else{
           header("Location: ./index.php");
         }



?> 
<?php
error_reporting(0);
$resulta = mysqli_query($con, "SELECT * FROM `employee_info` WHERE fname = '$names' AND mname = '$mid' AND lname = '$laslas'");
           $rows = mysqli_fetch_assoc($resulta);
           $idem = $rows['emp_id'];
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
                                    <?php echo $names; ?>                                
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

<h1 class=" fw-bold mb-0 text-gray-800 fs-3 mb-4" style="color: #000;"><strong>Dashboard</strong></h1>

<div class="row">
                 


      
                          <div class="col-xl-3 col-md-6 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a >Staff Name</a> </strong> </div>
                                               
                                               
                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $names; ?>  <?php echo $laslas; ?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-3  mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a >Present</a> </strong> </div>
                                              <?php
error_reporting(0);


                                               

                                                 $sql22 = "SELECT * FROM `attendance` WHERE emp_id = '$idem'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res226 = mysqli_num_rows($oks22);
                                                   



                                                 ?>
                              <?php

date_default_timezone_set("Asia/manila");
         $timem = date('y-m-d');
         // $timem = '2024-08-01';
$sql22ss = "SELECT * FROM `attendance` WHERE emp_id = '$idem' AND time_in='$timem'";
 $oks22s = mysqli_query($con, $sql22ss);
 $resta = mysqli_num_rows($oks22s);

?>
<?php
                                                
               

                                                 $sql2 = "SELECT * FROM `attendance` WHERE emp_id ='$idem' ORDER BY `time_in` ASC";
         $res2 = mysqli_query($con,$sql2);
         $rows2d = mysqli_fetch_assoc($res2); 
                                                 $started = $rows2d['time_in'];
     ?>
<?php 
                $sql2 = "SELECT * FROM `countofdays` ORDER BY `days` Desc";
         $res2 = mysqli_query($con,$sql2);
         $rows2day = mysqli_fetch_assoc($res2);
                                              $endays = $rows2day['days'];  ?>
                                      
                                              <?php $date1 = new DateTime($started);
$date2 = new DateTime($endays);

$interval = $date1->diff($date2);


$days = $interval->days; 

  ?><?php
   // echo $days+1;
   ?>
   <?php 
                                                 
                                                 
                                                 $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.time_out=''AND attendance.emp_id = '$idem'";
                        
                                                                            $oks22 = mysqli_query($con, $sql22);
                        
                                                                            $res226r = mysqli_num_rows($oks22);
                                                                          ?>
                                                                              <?php $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.emp_id = '$idem'";
                        
                                                                            $oks22 = mysqli_query($con, $sql22);
                        
                                                                            $res2261 = mysqli_num_rows($oks22); ?>
                                                                          <?php 
                        
                                                                          $absent = 0;
                                                                          $totals =0;
                                                                          $totals= $res2261-$res226r;
                                                                          $absent= $days+1-$totals; ?>

                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php $sanaoll = 0; $yay=0;
$sanaoll = $absent-$resta;  $yay=$res226r-$sanaoll; echo $yay;?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
               
                  <div class=" col-md-3 mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">
                                  

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a>Total Absent</a> </strong> </div>
                                         <?php

date_default_timezone_set("Asia/manila");
         $timem = date('y-m-d');
         // $timem = '2024-08-01';
$sql22ss = "SELECT * FROM `attendance` WHERE emp_id = '$idem' AND time_in='$timem'";
 $oks22s = mysqli_query($con, $sql22ss);
 $resta = mysqli_num_rows($oks22s);

?>
<?php
                                                
               

                                                 $sql2 = "SELECT * FROM `attendance` WHERE emp_id ='$idem' ORDER BY `time_in` ASC";
         $res2 = mysqli_query($con,$sql2);
         $rows2d = mysqli_fetch_assoc($res2); 
                                                 $started = $rows2d['time_in'];
     ?>
<?php 
                $sql2 = "SELECT * FROM `countofdays` ORDER BY `days` Desc";
         $res2 = mysqli_query($con,$sql2);
         $rows2day = mysqli_fetch_assoc($res2);
                                              $endays = $rows2day['days'];  ?>
                                      
                                              <?php $date1 = new DateTime($started);
$date2 = new DateTime($endays);

$interval = $date1->diff($date2);


$days = $interval->days; 

  ?><?php
   // echo $days+1;
   ?>
   <?php 
                                                 
                                                 
                                                 $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.time_out=''AND attendance.emp_id = '$idem'";
                        
                                                                            $oks22 = mysqli_query($con, $sql22);
                        
                                                                            $res226r = mysqli_num_rows($oks22);
                                                                          ?>
                                                                              <?php $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.emp_id = '$idem'";
                        
                                                                            $oks22 = mysqli_query($con, $sql22);
                        
                                                                            $res2261 = mysqli_num_rows($oks22); ?>
                                                                          <?php 
                        
                                                                          $absent = 0;
                                                                          $totals =0;
                                                                          $totals= $res2261-$res226r;
                                                                          $absent= $days+1-$totals; ?>
                                                                        

                             
                      
                                            <div class="h5 mb-0  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
$sanaoll = 0;
$sanaoll2 = 0;

$sanaoll = $absent-$resta;

echo $sanaoll.$absent; ?> </strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
  <div class="col-md-3  mb-4" style="color: #000;">
                            <div class="card  shadow h-60 py-1">
                                
                                <div class="card-body">

                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="fw-bold text-primary text-uppercase mb-1" style="font-size: 0.8em;">
                                                <strong><a > Total Late</a> </strong> </div>
                                              <?php   
               $sql22s = "SELECT * FROM `attendance` WHERE emp_id = '$idem' AND status = 'Late Time In'";

                                                    $oks22s = mysqli_query($con, $sql22s);

                                                    $resd = mysqli_num_rows($oks22s); ?>
                                            <div class="h5 mb-0 fs-5  "> <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $resd; ?></strong> </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
  </div>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<div class="card">
 


 <div class="card-header fw-bold" style="font-size: 30px;">  
       <form method="post" >
      <div class="row">
 
          

          
      </div>

         
     </form>
 </div>
 <div class="card-body">


     <div  id="chart"> </div>

 </div>
   

 <script type="text/javascript">
      var options = {
     chart: {
         type: 'bar'
     },
     series:[{
         name: 'Count',
         data: [
            

<?php

error_reporting(0);
   

                      $sql22 = "SELECT * FROM `attendance` WHERE emp_id= '$idem'";

                         $oks22 = mysqli_query($con, $sql22);

                         $res226 = mysqli_num_rows($oks22);
                         echo $res226;



                      ?>,
                    <?php  date_default_timezone_set("Asia/manila");
        $timem = date('y-m-d');
$sql22 = "SELECT * FROM `attendance` WHERE emp_id = '$idem' AND time_in = '$timem'";
 $oks22s = mysqli_query($con, $sql22);


                                                    $resta = mysqli_num_rows($oks22s);
?>
                                         <?php  $sql22 = "SELECT * FROM `countofdays`";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res = mysqli_num_rows($oks22); ?>
                               <?php 
                                                 
                                                 
                         $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.time_out=''AND attendance.emp_id = '$idem'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res226 = mysqli_num_rows($oks22);
                                                  ?>
                                                      <?php $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.emp_id = '$idem'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res2261 = mysqli_num_rows($oks22); ?>
                                                  <?php 
                                                  $absent = 0;
                                                  $totals =0;
$nowna =0;
                                                  $totals= $res2261-$res226;
if ($totals == 0){
 $minusi = $days+1;
}else{
 $minusi = $totals;
}
                                                  $absent=$days+1-$minusi;
                                               
$nowna = $absent-$resta;
 if ($nowna > 0){
 echo $nowna;
 
                                            }else{
 echo 0;
                                            }
?>,
          <?php   
               $sql22s = "SELECT * FROM `attendance` WHERE emp_id = '$idem' AND status = 'Late Time In'";

                                                    $oks22s = mysqli_query($con, $sql22s);

                                                    $resd = mysqli_num_rows($oks22s);
echo $resd;
?>
              
               ]
     }],
     xaxis: {
         categories: ['Total Present', 'Total Absent', 'Total Late']
     }
 }
 var chart = new ApexCharts(document.querySelector("#chart"), options);

 chart.render();
 </script>
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
