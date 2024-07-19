
<?php 

require_once'../db.php';


 ?>


  <?php 


                                if (isset($_POST['submit'])) {

                                  $posistion = $_POST['posis'];
                                  $perday = $_POST['amount'];
                                  $onlyone = "SELECT * FROM pos_and_amount WHERE posistion = '$posistion'";
                                      $result = mysqli_query($con, $onlyone);
                                      if(mysqli_num_rows($result) > 0){
                                           ?>
        <script>
                                         window.location = "./posistion.php?msgallready=allready";
                                       </script>
        <?php  

                                      }else{
                                         if ($perday > 0) {
                                      $in ="INSERT INTO `pos_and_amount`(`posistion`, `amount`) VALUES ('$posistion','$perday')";
                                                 mysqli_query($con,$in);
                                                 ?>
        <script>
                                         window.location = "./posistion.php?msgsubmit=submitposistion";
                                       </script>
        <?php   
                                      
                                  }else{
                                                ?>
        <script>
                                         window.location = "./posistion.php?msgnegative=negative";
                                       </script>
        <?php   

                                  }

                                      }
                                 

                                 
                                          
                                            
                            
                                 
                                }

                                         if (isset($_POST['submits'])) {
                                  $id = $_POST['idid'];


                                  $posistion = $_POST['posis'];
                                  $editposis = $_POST['editposis'];
                                  $perday = $_POST['amount'];
                                 
                                         if ($perday > 0) {
                                      $in ="UPDATE `pos_and_amount` SET `posistion`='$posistion', `amount`='$perday' WHERE id = '$id'";
                                                $qry= mysqli_query($con,$in);
                                                if ($qry) {

                                                    $updateperday ="UPDATE `employee_info` SET`money`='$perday' WHERE posistion ='$editposis'";
                                                   $monee= mysqli_query($con,$updateperday);
                                                   if ($monee) {
                                                    $updateposis ="UPDATE `employee_info` SET`posistion`='$posistion' WHERE posistion ='$editposis'";
                                                   mysqli_query($con,$updateposis);
                                                      ?>
        <script>
                                         window.location = "./posistion.php?msgupdate=submitupdate";
                                       </script>
        <?php   
                                                   }
                                                 
                                                    
                                                }
                                                 
                                      
                                  }else{
                                                ?>
        <script>
                                         window.location = "./posistion.php?msgnegative=negative";
                                       </script>
        <?php   

                                  }

                                      }
                                 

                                 
                                          
                                            
                            
                                 
                            

                                

                                

                               

                                 
                                


                                 ?>
