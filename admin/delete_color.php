<?php
	include ('../models/admin.php');
	$id = $_GET['id'];
	$i = Products::deleted($id);
	header("location:car_color.php");
?>