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
     <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
     <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>
     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
</head>
<body>
    <?php 
    if (isset($_GET['msgmore'])=="morecharacter") {
    echo '<script>swal("ERROR!", "Password must 8 or more characters","warning")</script>';
}



     ?>
    <?php 
    if (isset($_GET['msg'])=="updatedpic") {
    echo '<script>swal("UPDATE SUCCESSFULLY!", "Profile Updated","success")</script>';
}



     ?>

      <?php 
    if (isset($_GET['msg1'])=="updatedpass") {
    echo '<script>swal("UPDATE SUCCESSFULLY!", "Password Updated","success")</script>';
}



     ?>


       <?php 
    if (isset($_GET['msg2'])=="xpass") {
    echo '<script>swal("ERROR!", "Password  does not Match","warning")</script>';
}



     ?>

      <?php 
    if (isset($_GET['msg3'])=="wrongpass") {
    echo '<script>swal("ERROR !", "Wrong Password","warning")</script>';
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
            <div class=" container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            
        <div class="card position-relative border border-2 border-light" style="background:linear-gradient( rgba(0,0,0,0.5), rgba(0,0,0,0.5))">

            <div class=" rounded-circle border border-5 border-dark position-absolute" 
            style="height: 200px; width:200px; background:url(../uploads/<?php echo $row['img']; ?>); background-size: cover; background-position:center    ; background-repeat:no-repeat   ; top: -150px; left: 37%; " >
                
            </div>
            
            <div class=" card-body text-center d-flex justify-content-center align-items-center bg-primary fw-bold border border-3 border-dark" style="color: #000;">
                <!-- start form -->
                <?php  

    if(isset($_POST['update'])){
                                    $getid = $_POST['id'];
                                    
                                    $profile = $_FILES['profile']['name'];

                                       
                                            move_uploaded_file($_FILES['profile']['tmp_name'], '../uploads/'.$_FILES['profile']['name']);

                                    $query = "UPDATE staff SET img='$profile' WHERE id = '$getid'";

                                            mysqli_query($con, $query);

                                       ?>
                                       <script >
                                           window.location = "./profile.php?msg=updatedpic";
                                       </script>
                                       <?php

                                       
                                         

                                         

                                        
                                     }

  ?>
                 <div class="col-md-2"></div>
                                 <div class="col-md-8">
                
                <form  method="post" enctype="multipart/form-data">

                                
                                            <div class="row">


                                   
                                            
                                        <div class="col-md-6">
                                             <input class="fw-bold text-center" value="<?php echo $row['id']; ?>" class="form-control mb-1" type="hidden" name="id"  style="font-size :15px;" >
                                        <label>Last Name</label>
                                        <input class="fw-bold text-center" value="<?php echo $row['lname']; ?>" class="form-control mb-1" type="text" name="last" placeholder="Enter Last Name" style="font-size :15px;" required readonly >
                                    </div>
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input class="fw-bold text-center" value="<?php echo $row['fname']; ?>" class="form-control mb-1" type="text" name="first"  style="font-size :15px;"required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Middle Name</label>
                                        <input class="fw-bold text-center" value="<?php echo $row['mname']; ?>" class="form-control mb-1" type="text" name="mid"  style="font-size :15px;"required readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Select Gender</label>
                                        <input class="fw-bold text-center" value="<?php echo $row['gender']; ?>" class="form-control mb-1" type="text" style="font-size :15px;"required readonly>
                                        
                                    </div>
                                      <div class="col-md-6">
                                        <label>Staff Age</label>
                                         <input class="fw-bold text-center" value="<?php echo $row['age']; ?>" class="form-control mb-1" type="text" style="font-size :15px;"required readonly>
                                        
                                    </div>
                                
                                    
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input class="fw-bold text-center" value="<?php echo $row['uname']; ?>" class="form-control mb-1" type="text" name="mail" placeholder="Enter Email or Username" style="font-size :15px;" required readonly>
                                    </div>
                                    <center> <div class="col-md-8" >
                                        <label class="mt-1">Profile Picture</label>
                                        <input class="fw-bold text-center" class="form-control mb-1 " type="file" name="profile" style="font-size :15px;" required>
                                    </div></center> 
                                    <div class="col-md-4"></div>
                                     
                                                                
                                    <div class="col-md-12 mt-3">
                                        <div class="row">
                                            <!-- <div class=" mt-3 "> -->
                                        <div class="col-md-3"></div>

                                        <div class="col-md-6">
                                            <button style="color:#000;" class="btn btn-white fw-bold form-control" name="update" type="submit">Change Profile</button>
                                            
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-md-3"></div>

                                        <div class="col-md-6">
                                            <a  data-mdb-toggle="modal" data-mdb-target="#pastor" href="" style="color:#000;" class="fw-bold ">Change Password</a>
                                        </div>
                                                                                <div class="col-md-3"></div>


                                        
                                    <!-- </div> -->
                                            
                                        </div>
                                        
                                    </div>
                                   
                                    

                                    
                                        </div>
                                 
                                    </form>

                                    </div>
                                 <div class="col-md-2"></div>

            <!-- end form -->
        </div>

    </div>
                        </div>
                        <div class="col-md-2"></div>
                        
                    </div>
                    
                </div>

    </div>

     <div class="modal fade" id="pastor">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                <div class="modal-header bg-primary">
                  <h5 class="modal-title" style=" color: #fff;"> <strong>Change Password</strong> </h5>
                    <button class="close btn-close fs-6 mb-3" type="button" data-mdb-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <!-- <center><strong class="fw-bold fs-5" style="color:#000;">SCSIT</strong></center> -->

                <div class="modal-body col-md-12 fw-bold"  style="color: #000;">
                     
                  
                               
                                        <form class="fw-bold" method="post" action="insert_lang.php">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                        <div class="col-md-8" style="border: 23px;">
                                        <input value="<?php echo $row['uname']; ?>" class="form-control mb-1" type="hidden" name="email">
                                        <input value="<?php echo $row['id']; ?>" class="form-control mb-1" type="hidden" name="id">

                                        <label>Password</label>
                                        <input class="form-control mb-1" type="password" id="pass" name="pass" placeholder="Enter Password" required><i class="fa fa-eye-slash" style="position: absolute; top: 19%; right: 21%; color: lightgray;"  onclick="myfunction()" id="iconic"></i>
                                    </div>
                                            <div class="col-md-2"></div>
                                            
                                             <div class="col-md-2"></div>


                                     <div class="col-md-8">
                                        <label>New Password</label>

                                        <input class="form-control mb-1" type="password" id="newpass" name="newpass" placeholder="Enter New Password" required><i class="fa fa-eye-slash" style="position: absolute; top: 42%; right: 21%; color: lightgray;"  onclick="myfunction1()" id="iconic1"></i>

                                    
                                    </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-2"></div>


                                     <div class="col-md-8">
                                        <label>Confirm Password</label>

                                        <input class="form-control mb-1" type="password" id="rpass" name="rpass" placeholder="Enter Confirm Password" required><i class="fa fa-eye-slash" style="position: absolute; top: 65%; right: 21%; color: lightgray;"  onclick="myfunction2()" id="iconic2"></i>

                                    
                                    </div>
                                            <div class="col-md-2"></div>


                                   
                                

                                 
                                    </div>
                                      <center><div class="mt-3">
                                        <button class="btn bg-primary text-light" name="re_pass" >Submit</button>
                                    </div> </center> 
                                    </form>
                                    <script type="text/javascript">
                                function myfunction(){
                                    var x = document.getElementById("pass");
                                    var y = document.getElementById("iconic");
                                    

                                    if(x.type === "password"){
                                        x.type = "text";
                                    y.classList = "fa fa-eye"
                                        

                                        
                                        
                                        
                                    }else{
                                        x.type = "password";
                                        
                                    y.classList = "fa fa-eye-slash"

                                        


                                    }

                                }
                            </script>
                            <script type="text/javascript">
                                function myfunction1(){
                                    var x = document.getElementById("newpass");
                                    var y = document.getElementById("iconic1");
                                    

                                    if(x.type === "password"){
                                        x.type = "text";
                                    y.classList = "fa fa-eye"
                                        

                                        
                                        
                                        
                                    }else{
                                        x.type = "password";
                                        
                                    y.classList = "fa fa-eye-slash"

                                        


                                    }

                                }
                            </script>
                            <script type="text/javascript">
                                function myfunction2(){
                                    var x = document.getElementById("rpass");
                                    var y = document.getElementById("iconic2");
                                    

                                    if(x.type === "password"){
                                        x.type = "text";
                                    y.classList = "fa fa-eye"
                                        

                                        
                                        
                                        
                                    }else{
                                        x.type = "password";
                                        
                                    y.classList = "fa fa-eye-slash"

                                        


                                    }

                                }
                            </script>
             

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