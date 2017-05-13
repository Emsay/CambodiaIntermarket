<?php
    include ("../include/functions.php");
    class Shop {
        public static function getShops(){
            return runQuery("SELECT * FROM shop ORDER BY create_date DESC LIMIT 12");
        }
        public static function getShopImages($id){
            return runQuery("SELECT * FROM shop WHERE shop_id = ".$id);
        }
    }
?>