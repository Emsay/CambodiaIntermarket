<?php
    $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );


    include ('template/header.php');
    //include ('../models/products.php');
    require_once("../include/dbcontroller.php");
    $db_handle = new DBController();
    
    $id = $_GET['id'];
    $product =  Product::getProductImage($id);
    $row = mysqli_fetch_array($product);
    if($row){
        $pname = $row['pro_name'];
        $disc = $row['pro_discount'];
        $pimage = $row['pro_image'];
        $pdate = $row['date_discount'];
        $paddress = $row['address'];
        $pface = $row['facebook'];
        $pphone = $row['phone'];
    }


    // if(isset($_SESSION['login_user'])=='Undefined'){
    //     if(!empty($_GET["action"])) {
    //         switch($_GET["action"]) {
    //             case "add":
    //                 if(!empty($_POST["quantity"])) {
    //                     $quantity = $_POST["quantity"];
    //                     $userid = $_SESSION['uid'];
    //                     $cart = Product::getcartID($userid);
    //                     $row = mysqli_fetch_array($cart);
    //                     if($row){
    //                         $cartid = $row['cart_id'];
    //                     }
    //                     $insertPro_cart = Product::insertpro_cart($cartid,$id,$quantity);
                        
    //                 }
    //             break;
    //         }
    //     }
    // }

    $select = "select * from products where pro_id = ".$id;
    $query = mysqli_query($db,$select);
    $numrow = mysqli_num_rows($query);
    if($numrow>0){
        while($row = $query->fetch_object()){;
            if($_SESSION['lang']==1){
                // $disc=$row->pro_descriptionKh;
            }else if($_SESSION['lang']==2){
                //$disc=$row->pro_descriptionEn;
            }
        }
    }
    
?>
<head>
</head>
    <div class="container">
        <div id="main_area">
            <div class="row" style="margin: 0 auto; padding:18px; margin-left:-151px;">
                <div class="col-md-7" id="slider">
                    <div class="row">
                        <div class="col-md-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel">
                                <div class="carousel-inner">
                                    <div class="active item" data-slide-number="0">
                                        <img src="../uploads/<?php echo $pimage;?>" style="width: 440px;height: 310px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="slider-thumbs" style="margin-top: 10px;">
                        <ul class="hide-bullets">
                            <?php
                                $productImg =  Product::getProductSubImage($id);
                                foreach($productImg as $imgs){
                            ?>
                            <li class="col-md-3">
                                <a class="thumbnail" id="carousel-selector-0">
                                    <img style="height: 80px;width:96px;" src="../uploads/<?php echo $imgs['multi_images'];?>" >
                                </a>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <h3 class='m_3 p_title' style="background:#eee; padding:10px;"><?php echo $pname;?><h3>
                    <p class='m_5' style="color:red;">Discount : <?php echo $disc;?>%</p>
                    <p class='m_5' style="color:red;">Close Date : <?php echo $pdate;?></p><br>
                    <p class='m_3'>Contact for more information</p>
                    <p class='m_5'>Address : <?php echo $paddress;?></p>
                    <p class='m_5'>Facebook :<?php echo '<a href="'.$pface.'">Click for detial...</a>';?></p>
                    <p class='m_5'>Tel Contact : 0<?php echo $pphone;?></p>
                    <p>
                        <button type="submit" class="black" name="basket">
                            <?php echo _t_addbasket;?>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <script>
         $(document).ready(function() {
            $('#myCarousel').carousel({
                interval: 5000
            });
            $('#carousel-text').html($('#slide-content-0').html());
            $('[id^=carousel-selector-]').click( function(){
                var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                var id = parseInt(id);
                $('#myCarousel').carousel(id);
            });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
            });
        });
    </script>
<?php
    include ('template/footer.php');
?>