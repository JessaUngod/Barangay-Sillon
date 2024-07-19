<?php 
require_once'../db.php';



 ?>
 <?php 

if (isset($_POST['delete1'])) {
	$id1 = $_POST['delete1'];


	$delete_sql = "DELETE FROM `admin` WHERE id = '$id1'";
	 mysqli_query($con, $delete_sql);


		?>
		<script>
                                         window.location = "./admin.php?msgok=delete";
                                       </script>
		<?php

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
if (isset($_POST['delete123'])) {
	$id1 = $_POST['delete123'];


	$delete_sql = "DELETE FROM `products` WHERE id = '$id1'";
	 mysqli_query($con, $delete_sql);


		?>
		<script>
                                         window.location = "./products.php?msgok=delete";
                                       </script>
		<?php

	}





  ?>