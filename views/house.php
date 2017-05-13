<?php
    $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );
    include ("template/header.php");
    //include ("../models/products.php");
?>
<div class='main'>
    <div class='wrap'>
        <link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
        <div class="col-md-12">
			<?php 
				$product =  Product::getHouse();
					foreach ($product as $pro){
						echo "<ul class='list-inline'>
                                <li class='displayborder'>
                                    <a href='details.php?code=".$pro['pro_code']."&id=".$pro['pro_id']."'>
                                        <img src='../uploads/".$pro['pro_image']."' />
                                        <div class='price'>
                                            <div class='cart-left'>
                                                <div class='price2'>
                                                  <span class='discount'>-%".$pro['pro_discount']."</span>
                                                </div>
                                                <p class='titlepro'>".$pro['pro_name']."</p>
                                                
                                                <div class='price1'>
                                                <span class='total_p'>$".$pro['total_price']."</span>&nbsp&nbsp&nbsp
                                                  <span class='actual1'>$".$pro['pro_price']."</span>
                                                </div>
                                            </div>
                                            <div class='clear'></div>
                                        </div>  
                                    </a>
                                </li>
                            </ul>";
					}
				?>
		</div>
		<div class='clear'></div>
	</div>
</div>
<?php
	include ('template/footer.php');
?>