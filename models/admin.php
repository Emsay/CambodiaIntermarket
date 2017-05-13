<?php
include ("../include/functions.php");
// Product class is used instead of above four get product by category functions
class Products {
    public static function insert($pname,$pprice,$pdis,$total,$pcode,$pcat,$stock,$pimage,$deskh,$desen,$pinfor,$date,$paddress,$pfacebook,$pphone,$pgmail,$plocation){
        $sql = "INSERT INTO products (pro_name,pro_price,pro_discount,total_price,pro_code,cat_id,pro_stock,pro_image,pro_descriptionKh,pro_descriptionEn,pro_information,address,create_date) values ('{$pname}','{$pprice}','{$pdis}','{$total}','{$pcode}','{$pcat}','{$stock}','{$pimage}','{$deskh}','{$desen}','{$pinfor}','{$paddress}','{$pfacebook}','{$pphone}','{$pgmail}','{$plocation}')";
        return runNonQuery($sql);
    }
   
    public static function edit($id,$pname,$pprice,$pdis,$total,$pcode,$pcat,$stock,$pimage,$deskh,$desen,$pinfor,$paddress,$pfacebook,$pphone,$pgmail,$plocation){
        $sql = "UPDATE products SET pro_name='$pname',pro_price='$pprice',pro_discount='$pdis',total_price='$total',pro_code='$pcode',cat_id='$pcat',pro_stock='$stock',pro_image='$pimage',pro_descriptionKh='$deskh',pro_descriptionEn='$desen',pro_information='$pinfor',address='$paddress',facebook='$pfacebook',phone='$pphone',gmail='$pgmail',location='$plocation' where pro_id='$id'";
        return runNonQuery($sql);
    }
    //manage products
    public static function delect($id){
        return runNonQuery("DELETE from products where pro_id=".$id);
    }

    public static function getProducts(){
       return runQuery("SELECT products.*, category.cat_name from products inner join category on products.cat_id=category.cat_id ORDER BY create_date DESC");
    }
    public static function getProductByid($id){
        //return runQuery("SELECT * from products where pro_id = ".$id);
        $sql = "SELECT products.*, category.cat_name from products inner join category on products.cat_id=category.cat_id where pro_id=".$id;
        return runQuery($sql);
    }
    public static function getCategory(){
        return runQuery("SELECT * from category");
    }
    public static function getCategoryId($id){
        return runQuery("SELECT * from category where cat_id=".$id);
    }
    public static function checkCode($pcode){
        $select_code = "SELECT pro_code from products where pro_code = '".$pcode."'";
        $query = runQuery($select_code);        
        $a = mysqli_num_rows($query);
        while($row = mysqli_fetch_array($query)){
            if($row['pro_code'] == $pcode){
                return "already";
            }
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////

    //manage slideshow
    public static function insertslide($description,$image,$date,$location){
        $sql = "INSERT INTO slides (description,image,date_add,location) 
                values ('{$description}','{$image}','{$date}','{$location}')";
        return runNonQuery($sql);
    }
    public static function delectslide($id){
        $sql = "DELETE from slides where id=".$id;
        return runQuery($sql);
    }
    public static function editslide($id,$img, $descrip,$location){
        $sql = "UPDATE slides SET image ='$img',description = '$descrip',location = '$location' where id='$id'";
        return runNonQuery($sql);
    }
    public static function getSlide(){
        $sql = "SELECT * from slides ORDER BY date_add DESC";
        return runQuery($sql);
    }
    public static function getSlideid($id){
        $sql = "SELECT * from slides where id=".$id;
        return runQuery($sql);
    }
    /////////////////////////////////////////////////////////////////////////////////////////

    //manage shop category
    public static function getShopCategory(){
        return runQuery("SELECT * from shop_category");
    }
    //manage shop 

    public static function insertShop($scat,$sname,$sdesen,$simage,$saddress,$sphone,$sfacebook,$sgmail,$slocation,$sdate){
        $sql = "INSERT INTO shop (shop_cat_id, shop_name, shop_desen, images, address, phone, facebook, google, map,date_time) values ('{$scat}','{$sname}','{$sdesen}','{$simage}','{$saddress}','{$sphone}','{$sfacebook}','{$sgmail}','{$slocation}','{$sdate}')";
        return runNonQuery($sql);
    }
    //manage car category
    public static function getCarCategory(){
        return runQuery("SELECT * from car");
    }
    //manage color category
    public static function getColorCategory(){
        return runQuery("SELECT * from color");
    }
    public static function insertCarAndColor($car_id,$color_id,$price){
        $sql = "INSERT INTO car_color (car_id, color_id, prices) 
                            values ('{$car_id}','{$color_id}','{$price}')";
        return runNonQuery($sql);
    }
    //list car with color
    public static function getCarAndColor(){
        $mysql = "SELECT car.car_name,
                   color.colors,
                   car_color.*
                FROM car_color
                INNER JOIN car ON car.id = car_color.car_id
                INNER JOIN color ON color.id = car_color.color_id";
        return runQuery($mysql);
    }
    //edit car color while id
    public static function getCarColorId($id){
           $mysql = "SELECT car.car_name,color.colors,car_color.*
                    FROM car_color
                    INNER JOIN car ON car.id = car_color.car_id
                    INNER JOIN color ON color.id = car_color.color_id 
                    where car_color.id=".$id;
            return runQuery($mysql);
        }
    //delete car category
    public static function delete($id){
        return runNonQuery("DELETE from car where id=".$id);
    }
    //delete color
    public static function deleted($id){
        return runNonQuery("DELETE from color where color_id=".$id);
    }

}
