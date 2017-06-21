<?php
    include ("../include/functions.php");
    // Product class is used instead of above four get product by category functions
    class Product {
        public static function getProducts(){
            return runQuery("SELECT * FROM products ORDER BY create_date DESC LIMIT 12");
        }

        public static function getAdvs(){
            return runQuery("SELECT * FROM advertise ORDER BY create_date DESC LIMIT 1");
        }

        public static function getProductImage($id){
            return runQuery("SELECT * FROM products WHERE pro_id = ".$id);
        }
        public static function getProductSubImage($id){
            return runQuery("SELECT * FROM productimage WHERE product_id = ".$id);
        }

        public static function getSearch($result){
            $sql = "SELECT * FROM products WHERE pro_name LIKE '%".$result."%' or pro_price LIKE '%".$result."%'";
            $rows =  runQuery($sql);
            if(@mysqli_num_rows($rows)>0){
                return $rows;
            }else{
                return "No";
            }
        }
        public static function getOrderName(){
            $sql = "SELECT * FROM products ORDER BY pro_name";
            return runQuery($sql);
        }
        // cart process
        public static function getcartID($userid){
            return runQuery("SELECT * from carts where userid = ".$userid);
        }
        public static function insertpro_cart($cartid,$productid,$qty){
            $sql = "INSERT INTO cartproducts (cart_id,pro_id,quantity) values ('{$cartid}','{$productid}','{$qty}')";
            return runNonQuery($sql);
        }
        public static function selectproductcart($code){
            $sql= "SELECT * FROM products WHERE pro_code='" . $code . "'";
            return runQuery($sql);
        }
        public static function getIdCart($uid){
            return runQuery("SELECT * from carts where userid = ".$uid);
        }
        public static function getCartProduct($cartid){
            $sql = "SELECT products.*, cartproducts.* from products 
                    JOIN cartproducts on products.pro_id = cartproducts.pro_id 
                    where cart_id=".$cartid;
            return runQuery($sql);
        }
        public static function delect($id){
            return runNonQuery("DELETE from cartproducts where id=".$id);
        }
        public static function countCart($cartid){
            return runQuery("SELECT count(*) from cartproducts where cart_id =".$cartid);
        }
        //slide show in home
        public static function showslide(){
            $sql = "SELECT * from slides where location=0 ORDER BY date_add DESC LIMIT 5";
            return runQuery($sql);
        }
        //slide show in product
        public static function showslideProduct(){
            $sql = "SELECT * from slides where location=1 ORDER BY date_add DESC LIMIT 5";
            return runQuery($sql);
        }
        //advertise backgrouund
        public static function advs(){
            $sqp = "SELECT * from advertise DESC LIMIT 1";
        }
        public static function getShopCategory(){
            $sql = "SELECT shop.*, shop_category.shop_category from shop 
                    INNER join shop_category 
                    WHERE shop.shop_cat_id = shop_category.id 
                    AND shop.id in ( select max(id) from shop GROUP by shop_cat_id order by id desc)";
            return runQuery($sql);
        }
        public static function getShop($id){
            return runQuery("SELECT * FROM shop WHERE id = ".$id);
        }
        public static function listShop($id){
            $sql = "SELECT * from shop WHERE shop_cat_id =".$id;
            return runQuery($sql);
        }
        //manage car category
        public static function getCarCategory(){
            return runQuery("SELECT * from car");
        }

        //get province
        public static function getProvince(){
            return runQuery("SELECT * from tbl_provinces");
        }

        //insert car detail
        public static function insertCarDetail($user_id,$car_id,$province_depart_id,$province_destination_id
            ,$date_departure,$date_destination){
            $sql = "INSERT INTO rentCarDetail (user_id,car_id,province_depart_id,province_destination_id,date_departure,date_destination) 
                values ('{$user_id}','{$car_id}','{$province_depart_id}','{$province_destination_id}','{$date_departure}','{$date_destination}')";
            return runNonQuery($sql);
        }

        public static function getCarDetail($user_id){
            $sql = "SELECT car.*,province.province_name,rentCarDetail.*
                    FROM rentCarDetail
                    INNER JOIN car ON car.id = rentCarDetail.car_id
                    INNER JOIN province ON province.id = rentCarDetail.province_destination_id
                    where rentCarDetail.user_id=".$user_id;
            return runQuery($sql);
        }

        public static function selectProvince(){
            $sql = "SELECT * from tbl_provinces ORDER BY province_name ";
            return runQuery($sql);
        }
        public static function selectDistrict($proID){
            $sql = "SELECT * from tbl_districts where province_id=".$proID;
            return runQuery($sql);
        }
        public static function selectCommune($dis){
            $sql = "SELECT * from tbl_communes where district_id=".$dis;
            return runQuery($sql);
        }

    }
    //manage client register
    if(isset($_GET['provinceID'])){
        $id=$_GET['provinceID'];

        $data=Product::selectDistrict($id);
        echo '<select id="txtDistrict" name="district" class="form-control">';
            echo '<option value="0">Select District</option>';
        foreach ($data as $v){
            echo '<option value="'.$v['id'].'">'.$v['district_name'].'</option>';
        }
        echo '<select>';
    }
    if(isset($_GET['districtID'])){
        $disID = $_GET['districtID'];
        $commune=Product::selectCommune($disID);
        echo '<select name="commune" class="form-control">';
        echo '<option value="0">Select Commune</option>';
        foreach ($commune as $com){
            echo '<option value="'.$com['id'].'">'.$com['communes_name'].'</option>';
        }
        echo '<select>';
    }

?>