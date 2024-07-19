<?php 
require_once'../db.php';



 ?>
 <?php 

if (isset($_POST['delete1'])) {
	$id1 = $_POST['delete1'];


	$delete_sql = "DELETE FROM `employee_info` WHERE emp_id = '$id1'";
	 $ok=mysqli_query($con, $delete_sql);
	 if ($ok) {
	 	$delete_sqls = "DELETE FROM `attendance` WHERE emp_id = '$id1'";
	 mysqli_query($con, $delete_sqls);
	 ?>
		<script>
                                         window.location = "./employee.php?msgok=delete";
                                       </script>
		<?php
	 }


		

	}
if (isset($_POST['delete12'])) {
	$id1 = $_POST['delete12'];


	$delete_sql = "DELETE FROM `staff` WHERE id = '$id1'";
	 mysqli_query($con, $delete_sql);


		?>
		<script>
                                         window.location = "./staff.php?msgok=delete";
                                       </script>
		<?php

	}






  ?>