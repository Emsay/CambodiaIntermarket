<?php
    $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );


    include ('template/header.php');
    //include ('../models/products.php');
    require_once("../include/dbcontroller.php");
    $db_handle = new DBController();
    
    $id = $_GET['id'];
    $product =  product::getShop($id);
    $row = mysqli_fetch_array($product);
    if($row){
        $sname = $row['shop_name'];
        $simage = $row['images'];
        $sface = $row['facebook'];
        $sphone = $row['phone'];
    }

    $select = "select * from shop where id = ".$id;
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
    <meta charset='utf-8' />
</head><hr>
    <div class="main">
        <div class="wrap">
            <div class="col-md-6" > 
                <img class='img-responsive' src='../uploads/<?php echo $simage;?>' class='img-responsive'/>
            </div>
            <div class='col-md-6'>
                <h3 class='m_3 p_title' style="background:#eee; padding:20px; color: #00ADC9;"><?php echo $sname;?><h3>
                <p class='m_3' style="color:red;">Contact for more information</p>
                <p class='m_5'>Facebook :<a href="https://www.facebook.com/CambodiaIntermarket/">Click for detial...</a></p>
                <p class='m_5'>Tel Contact : <?php echo $sphone;?></p>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div style="height:50px"></div>
    </div>
    <div class="clear"></div>

<?php
    include ('template/footer.php');
?>