
<?php 

require_once'../db.php';


 ?>


  <?php 



                                

                                if (isset($_POST['re_pass'])) {
  $id = $_POST['id'];
  $user_reg = $_POST['email'];
  $pass_reg = $_POST['pass'];
  $cpass = $_POST['rpass'];
  $newpass = $_POST['newpass'];
  $len = strlen($cpass);

  $sql = "SELECT * FROM staff WHERE uname = '$user_reg' && pass = '$pass_reg'";
  $result = mysqli_query($con,$sql);
  $row =mysqli_fetch_assoc($result);
  if ($newpass == $cpass ){
     if (mysqli_num_rows($result)>0) {
                if ($user_reg == $row['uname'] && $pass_reg == $row['pass']) {
                  if ($len > 7) {
                    $psql="UPDATE `staff` SET `pass`='$cpass' WHERE id ='$id'";
                   mysqli_query($con,$psql);
                       ?>
        <script>
                                         window.location = "./profile.php?msg1=updatedpass";
                                       </script>
        <?php   
                  }else{
                        ?>
        <script>
                                         window.location = "./profile.php?msgmore=morecharacter";
                                       </script>
        <?php 
                  }
                 

                  
                }
              }else{
                  ?>
        <script>
                                         window.location = "./profile.php?msg3=wrongpass";
                                       </script>
        <?php   
                           


              }
   
  }else{
                      ?>
        <script>
                                         window.location = "./profile.php?msg2=xpass";
                                       </script>
        <?php  

              

  }

  

             
             
             
           
         }


                               

                                 
                                


                                 ?>
