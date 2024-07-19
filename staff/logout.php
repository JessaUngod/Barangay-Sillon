<?php 

require_once'../db.php';

if(!empty($_SESSION['idstaffs'])){

           $id = $_SESSION['idstaffs'];

           $result = mysqli_query($con, "SELECT * FROM loginrec WHERE login_id = '$id'");
           $row = mysqli_fetch_assoc($result);
          
           
           
         }else{
           header("Location: ./index.php");
         }
         date_default_timezone_set("Asia/manila");
         $time = date('M d, Y h:i A');
         $insert_sql ="UPDATE `loginrec` SET `logout`='$time' WHERE login_id = '$id'";
mysqli_query($con, $insert_sql);

unset($_SESSION['idstaff']);
unset($_SESSION['idstaffs']);
// session_destroy();
header("Location: index.php");

 ?>