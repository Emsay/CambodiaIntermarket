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

<style type="text/css">
    #gallery_01 img{border:2px solid #ccc;} /*Change the colour*/ 
    .active img{border:2px solid #00adc9 !important;}
    #wrap #zoom_03{
        height: 300px;
    }
    #wrap{
        border: 2px solid #00adc9;
        margin: 0 auto;
        width: 300px;
    }
    #gallery_01{
        margin-top: 10px;
        text-align: center;
    }
</style>

    <div class="container"><hr>
        <div class="row" style="margin:0 auto;>
            <div class="col-md-12">
                <div class="col-md-6" style="overflow:hidden height:200px !important; ">
                    <div class="product-img-box">
                        <div id="wrap" style="top:0px;position:relative;">
                            <img id="zoom_03" src="../uploads/<?php echo $pimage;?>" data-zoom-image="../uploads/<?php echo $pimage;?>"/> 
                        </div>
                    </div>
                    <div id="gallery_01">
                        <a href="#" data-image="../uploads/<?php echo $pimage;?>" data-zoom-image="../uploads/<?php echo $pimage;?>"> 
                            <img id="zoom_03" src="../uploads/<?php echo $pimage;?>" width="50px" />
                        </a>
                        <?php
                            $productImg =  Product::getProductSubImage($id);
                            foreach($productImg as $imgs){
                        ?>
                            <a href="#" data-image="../uploads/<?php echo $imgs['multi_images'];?>" data-zoom-image="../uploads/<?php echo $imgs['multi_images'];?>"> 
                                <img id="zoom_03" src="../uploads/<?php echo $imgs['multi_images'];?>" width="50px" />
                            </a>
                        <?php }?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class='m_3 p_title' style="background:#eee; padding:20px;"><?php echo $pname;?><h3>
                    <p class='m_5' style="color:red;">Discount : <?php echo $disc;?>%</p><br>
                    <!-- <p class='m_5' style="color:red;">Close Date : <?php echo $pdate;?></p><br> -->
                    <p class='m_3'>Contact for more information</p>
                    <p class='m_5'>Address : <?php echo $paddress;?></p>
                    <p class='m_5'>Facebook : <a href="<?php echo $pface;?>"> Click detail... </a></p>
                    <p class='m_5'>Tel Contact : <?php echo $pphone;?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <script src="resources/js/jquery.elevatezoom.js" type="text/javascript"></script>
    <script src="resources/js/cloud-zoom.js" type="text/javascript"></script>

    <script type="text/javascript">
        $("#zoom_03").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: ''});
        $("#zoom_03").bind("click", function(e) {
            var ez = $('#zoom_03').data('elevateZoom'); 
            $.fancybox(ez.getGalleryList()); 
            return false; 
        }); 

    </script>
 
<?php
    include ('template/footer.php');
?>