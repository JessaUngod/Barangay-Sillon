

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
     <link rel="shortcut icon" type="image/x-icon" href="../assets/img/sillon.jpg">
     <style>
         body{

         }
         @media print{
            #gogo{
                display: none;
            }
            #cancel{
                display: none;
            }
         }
     </style>
     
     <script type="text/javascript" src="../sweet_alert/sweetalert.min.js"></script>


</head>
<body>
     

   
           <center> <div class="container-fluid py-5">
        
          

      <div class="col-md-12">
            

                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">

 <?php 
             if (isset($_GET['employeepay_id'])) {
               $getid = $_GET['employeepay_id'];



         $onlyone = "SELECT * FROM `attendance` WHERE emp_id ='$getid'";
                 $result = mysqli_query($con, $onlyone);
      if(mysqli_num_rows($result) > 0){
         

          }else{
             ?>
                                       <script>
                                           window.location = "employee_payroll.php?norecords=nopayroll";
                                       </script>
                                       <?php

          }
         
      

       
       }



                 ?>
 
                       <div class="card shadow">
                         <!-- <div class="card-header">
                            <h6 class="m-0  fw-bold" style="color: #000;"><strong style="font-size: 30px;"> Semester</strong></h6>
                        </div> -->
                                                  <?php 
             if (isset($_GET['employeepay_id'])) {
               $getid = $_GET['employeepay_id'];



         $sql2 = "SELECT * FROM `employee_info` WHERE emp_id ='$getid'";
         $res2 = mysqli_query($con,$sql2);
         $rows2 = mysqli_fetch_assoc($res2);
         $idid = $rows2['emp_id'];
         
      

       
       }



                 ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 class="m-0  fw-bold px-5" style="color: #000;"><strong style="font-size: 17px;"> &nbsp;&nbsp;PAYMENT FOR</strong></h6>
                                    <table class="border border-3 border-dark">
                                        <thead class="border border-3 border-dark  fw-bold" style="color:#000;">
                                            <tr>
                                                <th> &nbsp;&nbsp;&nbsp;&nbsp; EMPLOYEE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PESOS    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody  style=" color: #000;">
                                            <tr class="border border-2 border-dark">
                                                <td>&nbsp;&nbsp;Start Date : <?php
                                                if (isset($_GET['employeepay_id'])) {
               

                                                 $sql2 = "SELECT * FROM `attendance` WHERE emp_id ='$idid' ORDER BY `time_in` ASC";
         $res2 = mysqli_query($con,$sql2);
         $rows2d = mysqli_fetch_assoc($res2); 
                                                 $started = $rows2d['time_in'];
     }?><?php if (isset($_GET['employeepay_id'])) {
                $sql2 = "SELECT * FROM `countofdays` ORDER BY `days` Desc";
         $res2 = mysqli_query($con,$sql2);
         $rows2day = mysqli_fetch_assoc($res2);
                                              $endays = $rows2day['days'];  }?><?php echo date("F d, Y",strtotime($started)); ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp;End Date : <?php echo date("F d, Y",strtotime($endays)); ?></td>
                                                
                                            </tr>
                                           
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp;Total Days : <?php $date1 = new DateTime($started);
$date2 = new DateTime($endays);

$interval = $date1->diff($date2);


$days = $interval->days; 

  ?><?php if($days == 0){
    echo 1;
  }else{
   echo $days;
  }  ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp;Total Absent :   <?php 
                                                 
                                                 
                         $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.time_out=''AND attendance.emp_id = '$idid'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res226 = mysqli_num_rows($oks22);
                                                  ?>
                                                      <?php $sql22 = "SELECT * FROM `attendance`, employee_info WHERE attendance.emp_id = employee_info.emp_id AND attendance.emp_id = '$idid'";

                                                    $oks22 = mysqli_query($con, $sql22);

                                                    $res2261 = mysqli_num_rows($oks22); ?>
                                                  <?php 
                                                  $absent = 0;
                                                  $totals =0;
                                                  $totals= $res2261-$res226;
                                                  $absent= if($days == 0){
    1;
  }else{
    $days;
  }-$totals; echo $absent;?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp; Total Days Present : <?php $total =0;
                                                  $total= $res2261-$res226;
                                                  echo $total; ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Late :  <?php   if (isset($_GET['employeepay_id'])) {
               $getid = $_GET['employeepay_id']; $sql22s = "SELECT * FROM `attendance` WHERE emp_id = '$getid' AND status = 'Late Time In'";

                                                    $oks22s = mysqli_query($con, $sql22s);

                                                    $resd = mysqli_num_rows($oks22s); }?><?php echo $resd;?></td>
                                                
                                            </tr>
                                          
                                            <tr>
                                                <td class="border border-2 border-dark">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Deductions : <?php $totaldeduc =0; $absentdeduc =0;$latededuc =0;
                                                $absentdeduc = $absent * 100;
                                                $latededuc = $resd * 50;
                                                $totaldeduc = $absentdeduc + $latededuc;
                                                echo $totaldeduc;
                                                 ?></td>
                                                
                                            </tr>
                                              <tr>
                                                <td class=" fw-bold border border-2 border-dark" style="font-size: 23px;">&nbsp;&nbsp;TOTAL  &nbsp;  &#8369 <?php $kwarta=0; $sweldo=0; $sweldo=$rows2['money'] * $total; $kwarta=$sweldo-$totaldeduc;
                                                if ($kwarta < 0) {
                                                    echo"0";
                                                }else{
                                                    echo $kwarta;
                                                }
                                            ?></td>
                                                
                                            </tr>

                                        </tbody>
                                    </table>
                                    <div class="col-md-12">
                                         <p class="fw-bold" style="color:#000; font-size: 12px;">This system is an advanced version of an examination that can offer easy, convenient </p>
                                        
                                    </div>
                                   
                                
                            </div>
                            <div class="col-md-9">
                                            <?php 
             if (isset($_GET['employeepay_id'])) {
               $getid = $_GET['employeepay_id'];



         $sql2 = "SELECT * FROM `employee_info` WHERE emp_id ='$getid'";
         $res2 = mysqli_query($con,$sql2);
         $rows2 = mysqli_fetch_assoc($res2);
         
      

       
       }



                 ?>
                                <div class="row">
                                       <div class="col-md-2">
                                    <img src="../assets/img/sillon.jpg" style="width: 110px; height: 110px; border-radius: 50%;">
                                </div>
                                <div class="col-md-9">
                                    <h6 class="m-0  fw-bold" style="color: #000;"><strong style="font-size: 28px;"> EMPLOYEE ATTENDANCE OF BARANGAY SILLON BANTAYAN, CEBU  
                                       <center> <p style="font-size: 12px;">Sillon, 6052 Bantayan,Cebu, Philipines <br>NON-VAT REG.TIN: 000-951-513-020001</p> </center>
                                        </strong></h6>
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-8"></div>
                                <div class="col-md-4"><strong style="font-size:20px; color: #000; ">ID. <strong style="color: red"><?php echo $rows2['emp_id']; ?></strong></strong></div>
                                <div class="col-md-4"> <strong class="fw-bold" style="color: #000; font-size:18px;">OFFICIAL PAYSLIP</strong></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-3 "  style="color: #000; "><strong class="mt-5">Date</strong>
                                <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; max-width: 120px;" value="<?php echo date('F d, Y') ?>" readonly></div> 
                                 <script>
                            function updateTime(){
                                var time = new Date();
                                const now = new Date();
                                const timeElement = document.getElementById('time');
                                timeElement.textContent = now.toLocaleTimeString();
                            }
                            setInterval(updateTime, 1000);
                        </script>
                               
                                <div class="col-md-1"></div>
                                



                                    
                                </div>
                                <div class="col-md-12">
                                    
                                        <div class="col-md-12 mt-1"><strong class="mt-4">Received from</strong><input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 400px;" value="&nbsp;&nbsp;<?php echo $rows2['lname']; ?>, <?php echo $rows2['fname']; ?>  <?php echo $rows2['mname']; ?>" readonly>
                                            <strong class="mt-4">with TIN</strong><input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; max-width: 110px;" value="" readonly>
                                        </div>
                                       <div class="col-md-12 mt-1">
                                            <strong class="mt-4"> with address at</strong><input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 400px;" value="&nbsp;&nbsp;BARANGAY HALL OF SILLON " readonly>
                                        <strong class="mt-4">engaged in the</strong>
                                       </div>

                                       <div class="col-md-12 mt-1">
                                        <strong class="mt-4">Position </strong><input class="fw-bold text-center" style="border-top: none; border-left: none; border-right: none; width: 400px;" value="&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<?php echo $rows2['posistion']; ?> of Brgy. Sillon" readonly>
                                            <strong class="mt-4">and wages of</strong>
                                       </div>

                                       <div class="col-md-12">


                                            <?php
function convertNumber($num = false)
{
    $num = str_replace(array(',', ''), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : '' ) . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' and ' . $list1[$tens] . ' ' : '' );
        } elseif ($tens >= 20) {
            $tens = (int)($tens / 10);
            $tens = ' and ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    $words = implode(' ',  $words);
    $words = preg_replace('/^\s\b(and)/', '', $words );
    $words = trim($words);
    $words = ucfirst($words);
    $words = $words . "";
    return $words;
}



                                             ?>
                                        <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 580px;" value="&nbsp;&nbsp;<?php if ($kwarta <0) {
                                            echo "0";
                                             }else{
                                                echo convertNumber($kwarta);

                                             }  ?>" readonly>
                                        <strong class="mt-4">pesos</strong>

                                           
                                       </div>
                                       <div class="col-md-12">
                                       <strong class="mt-4 fw-bold" style="color:#000;"> (  &#8369</strong>  <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 100px;" value="<?php if ($kwarta <0) {
                                        echo "0";
                                       }else{
                                        echo $kwarta;
                                       }  ?>.00 " readonly><strong class="mt-4 fw-bold" style="color:#000;"> )</strong><strong class="mt-4 fw-bold" style="color:#000;"> in payment of</strong> <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 360px;" value="&nbsp;&nbsp;  PAYSLIP" readonly>
                                           
                                       </div>
                                       <div class="col-md-12">
                                            <div class="row mt-4">
                                           <div class="col-md-6">
                             
                                        <strong class="mt-4 fw-bold" style="color:#000;">Rate per Day. : <?php echo $rows2['money']; ?>.00</strong>
                                           
                                       </div>
                                       <div class="col-md-6">
                                     

       <?php 

        if(!empty($_SESSION['idadmins'])){
           $id = $_SESSION['idadmins'];
           $result = mysqli_query($con, "SELECT * FROM admin WHERE id = $id");
           $row = mysqli_fetch_assoc($result);
         }else{
           header("Location: ./index.php");
         }



?>
                                        <strong class="mt-4 fw-bold" style="color:#000;">BY:</strong> <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 200px;" value="<?php echo $row['fname']; ?>  <?php echo $row['lname']; ?>" readonly> <br>
                                      &nbsp;  <strong class="fw-bold" style="color:#000; font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;             Captain/Autorized Admin Representative</strong>
                                           
                                       </div>
                                       </div>
                                       </div>

                                       <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                    <p class="fw-bold" style="color:#000; font-size: 12px;">This system is an advanced version of an This system is an advanced version This system is an advanced version  </p>
                                                  
                                                </div>
                                                
                                            
                                            <div class="col-md-6" style="font-size: 12px;">
                                                 <strong class=" fw-bold" style="color:#000;">"THIS DOCUMENT IS <input class="text-center fw-bold " style="border-top: none; border-left: none; border-right: none; width: 80px;" value="NOT VALID" readonly> FOR <label class="px-5">CLAIM OF INPUT TAXES"</label></strong>
                                            </div>
                                           <!--  <div class="col-md-1">
                                                
                                            </div>
 -->                                            
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
                    <div class="col-md-1"></div>

                </div>

     <div class="container-fluid mt-3">
        <div class="col-md-12">
         <?php 
 if (isset($_GET['employeepay_id'])) {
               $getid = $_GET['employeepay_id'];
  $sql2 = "SELECT * FROM `employee_info` WHERE emp_id ='$getid'";
         $res2 = mysqli_query($con,$sql2);
         $rows2 = mysqli_fetch_assoc($res2);
  $fname = $rows2['fname'];
  $mname = $rows2['mname'];
  $lname = $rows2['lname'];
  $dob = $rows2['dob'];
  $age = $rows2['age'];
  $gender = $rows2['gender'];
  $position = $rows2['posistion'];

 }

?>
            <?php 
            if (isset($_POST['gogo'])) {
                $idko = $_POST['emp_id'];
                $emp_wage = $_POST['wage'];
               date_default_timezone_set("Asia/manila"); 
          $yearolday = date('Y');
              
                $delete_sql ="DELETE FROM `attendance` WHERE emp_id ='$getid'";
                $deleteka = mysqli_query($con,$delete_sql);
                if ($deleteka) {
                    $time = date('F');
                    $record_sql ="INSERT INTO `payroll_rec`(`emp_id`,`fname`, `mname`, `lname`, `dob`, `age`, `gender`, `position`, `wages`, `buwan`,`tuig`) VALUES ('$idko','$fname','$mname','$lname','$dob','$age','$gender','$position','$emp_wage','$time','$yearolday')";
                    mysqli_query($con,$record_sql);
                }
            }
             ?>
            <div class="row">
                <form method="post">
                    <input type="hidden" name="emp_id" value="<?php echo $rows2['emp_id']; ?>">
                    <input type="hidden" name="wage" value="<?php if ($kwarta <0) {
                                        echo "0";
                                       }else{
                                        echo $kwarta;
                                       }  ?>">

                    <center> <button class="btn bg-primary ms-auto text-light mb-2" name="gogo" id="gogo" type="submit"> <label><i class="fa fa-print"></i> Print</label></button> <a href="employee_payroll.php" class="btn bg-danger ms-auto text-light mb-2 mt-2" name="close" id="cancel"><label> <i class="fa fa-cancel"></i> Cancel</label></a></center>
                </form>
                
                
            </div>
            <script>
                const printbtn = document.getElementById('gogo');
                printbtn.addEventListener('click', function(){
                    window.print();
                });
            </script>
            
        </div>
        
    </div>


    


            </center>




   <!-- <script src="../assets/js/jquery.min.js"></script> -->
   <script type="text/javascript" src="../assets/js/jquery.js"></script>
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
        let table = new DataTable('#myTable', {
});
   </script> 


</body>
</html>
