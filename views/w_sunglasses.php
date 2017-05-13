<?php
    $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );
    include ("template/header.php");
    //include ("../models/products.php");
?>
    <div class="main">
        <div class="wrap">
            <link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
            <div class="slider_container">
                <div class="slide">
                    <!-- <img src="resources/images/perfumebannere.jpg" alt=""/> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-2">
                    <?php
                        include ("template/left_menu.php");
                    ?>
                </div>
                <div class="col-lg-10">
                    <h2 class="head">Sun Glasses</h2>
                    <?php
                        include ("template/pagination.php");
                    ?>
                    <div class="">
                    <?php
                        $product =  Product::getWsunglass();
                        foreach ($product as $pro){
                            echo "<ul class='list-inline'>
                                    <li class='displaydata'>
                                        <a href='details.php?code=".$pro['pro_code']."&id=".$pro['pro_id']."'>
                                            <img src='../uploads/".$pro['pro_image']."' />
                                            <div class='price'>
                                                <div class='cart-left'>
                                                    <div class='price2'>
                                                      <span class='discount'>-%".$pro['pro_discount']."</span>
                                                    </div>
                                                    <p class='title'>".$pro['pro_name']."</p>
                                                    <div class='price1'>
                                                      <span class='total_p'>$".$pro['total_price']."</span>&nbsp&nbsp&nbsp
                                                      <span class='actual1'>$".$pro['pro_price']."</span>
                                                    </div>
                                                </div>
                                                <div class='clear'></div>
                                            </div>  
                                        </a>
                                    </li>
                                </ul>
                            ";
                            }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
<?php
    include ("template/footer.php");
?>