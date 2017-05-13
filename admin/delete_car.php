<?php
	include ('../models/admin.php');
	$id = $_GET['id'];
	$i = Products::delete($id);
	header("location:car_category.php");
?>