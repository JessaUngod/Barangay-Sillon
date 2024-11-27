<?php 
session_start();
// $con = mysqli_connect('localhost','root','','u510162695_sillon');

$con = mysqli_connect('127.0.0.1','u510162695_sillon','1Sillon_pass','u510162695_sillon');
if(!$con){
	die('Conection failed!' . mysqli_connect_error());


}



 ?>
