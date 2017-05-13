<?php
	include ("../include/functions.php");
	class Category {
		public static function getCat(){
	        $sql = "SELECT * from category";
	        return runQuery($sql);
	    }

	    public static function getCatID($id){
	        $sql = "SELECT * from category where cat_id=".$id;
	        return runQuery($sql);
	    }

	    public static function insertCat($catName,$description){
	        $sql = "INSERT INTO category (cat_name,description) VALUES ('{$catName}','{$description}')";
	        return runNonQuery($sql);
	    }

	    public static function editCat($id,$catName,$description){
	    	$sql = "UPDATE category SET cat_name='$catName',description='$description' where cat_id='$id'";
	    	return runNonQuery($sql);
	    }
	    //manage shop category
	    public static function insertShopCate($shop_cate){
	    	$sql = "INSERT into shop_category (shop_category) values('{$shop_cate}')";
	    	return runNonQuery($sql);
	    }
	    public static function getShopCat(){
	        $sql = "SELECT * from shop_category";
	        return runQuery($sql);
	    }
	    public static function getShopCatID($id){
	        $sql = "SELECT * from shop_category where id=".$id;
	        return runQuery($sql);
	    }
	    public static function updateShopCat($id,$catName){
	    	$sql = "UPDATE shop_category SET shop_category='$catName' where id='$id'";
	    	return runNonQuery($sql);
	    }
	    //manage car category
	    public static function insertCarCate($car_cate,$car_prices){
	    	$sql = "INSERT into car (car_name,prices) values('{$car_cate}','{$car_prices}')";
	    	return runNonQuery($sql);
	    }
	    public static function getCarCat(){
	        $sql = "SELECT * from car ORDER BY date_time DESC";
	        return runQuery($sql);
	    }
	    
	    public static function updateCarCat($id,$carName,$carPrice){
	    	$sql = "UPDATE car SET car_name='$carName', car_price='$carPrice' where id='$id'";
	    	return runNonQuery($sql);
	    }
	    //manage color
	     public static function insertColorCat($colors){
	    	$sql = "INSERT into color (colors) values('{$colors}')";
	    	return runNonQuery($sql);
	    }
	    public static function getColorCat(){
	        $sql = "SELECT * from color ORDER BY date_time DESC";
	        return runQuery($sql);
	    }
	    public static function getColorCatID($id){
	        $sql = "SELECT * from color where color_id=".$id;
	        return runQuery($sql);
	    }
	    public static function updateColorCat($id,$colorName){
	    	$sql = "UPDATE color SET colors='$colorName' where color_id='$id'";
	    	return runNonQuery($sql);
	    }

	}
?>