<?php
    include ("../include/functions.php");
    // Product class is used instead of above four get product by category functions
    class Product {
        public static function getProducts(){
            return runQuery("SELECT * FROM products ORDER BY create_date DESC LIMIT 12");
        }

        public static function getProductImage($id){
            return runQuery("SELECT * FROM products WHERE pro_id = ".$id);
        }

        public static function getMsunglass(){
            return runQuery("SELECT * FROM products WHERE cat_id = 1");
        }
         public static function getWsunglass(){
            return runQuery("SELECT * FROM products WHERE cat_id = 14");
        }

        public static function getMwatch(){
            return runQuery("SELECT * FROM products WHERE cat_id = 2");
        }

        public static function getWwatch(){
            return runQuery("SELECT * FROM products WHERE cat_id = 3");
        }

        public static function getCosmetic(){
            return runQuery("SELECT * FROM products WHERE cat_id = 4");
        }

        public static function getHandbag(){
            return runQuery("SELECT * FROM products WHERE cat_id = 5");
        }

        public static function getWperfume(){
            return runQuery("SELECT * FROM products WHERE cat_id = 6");
        }

        public static function getMperfume(){
            return runQuery("SELECT * FROM products WHERE cat_id = 7");
        }

        public static function getSiren(){
            return runQuery("SELECT * FROM products WHERE cat_id = 8");
        }
        public static function getBelt(){
            return runQuery("SELECT * FROM products WHERE cat_id = 9");
        }
        public static function getBag(){
            return runQuery("SELECT * FROM products WHERE cat_id = 10");
        }
        public static function getWallet(){
            return runQuery("SELECT * FROM products WHERE cat_id = 13");
        }
        public static function getSportbag(){
            return runQuery("SELECT * FROM products WHERE cat_id = 11");
        }
        
        public static function getMnew(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('1','7','9','2') ORDER BY create_date DESC");
        }
         public static function getMan(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('1','7','9','2') ORDER BY cat_id");
        }
        public static function getWnew(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('6','5','4','3','1') ORDER BY create_date DESC");
        }
        public static function getWoman(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('6','5','4','3','1') ORDER BY cat_id");
        }
        public static function getHouse(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('8') ORDER BY cat_id");
        }
        public static function getHnew(){
            return runQuery("SELECT * FROM products WHERE cat_id IN ('8') ORDER BY create_date DESC");
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
            return runQuery("SELECT * from province");
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

        //register client
        public static function selectProvince(){
            $sql = "SELECT * from province ORDER BY id DESC ";
            return runQuery($sql);
        }

        public static function selectDistrict(){
            $sql = "SELECT * from district ORDER BY id DESC ";
            return runQuery($sql);
        }

        public static function selectCommune(){
            $sql = "SELECT * from commune ORDER BY id DESC ";
            return runQuery($sql);
        }

    }
?>