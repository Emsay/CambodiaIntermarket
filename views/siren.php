<?php
   $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );
    include ("template/header.php");
    //include ("../models/products.php");
?>
<?php
    $per_page=9;
    if (isset($_GET['page'])) {

    $page = $_GET['page'];
    }
    else {
    $page=1;
    
    }
    // Page will start from 0 and Multiple by Per Page
    $start_from = ($page-1) * $per_page;
    //Selecting the data from table but with limit
    $query = "select products.*, category.cat_name from products inner join category on products.cat_id=category.cat_id ORDER BY create_date DESC LIMIT $start_from, $per_page";
    
    $result = mysqli_query ($db, $query);
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
                    <h2 class="head">Serin in the house</h2>
                    <?php
                        include ("template/pagination.php");
                    ?>
                    <div class="">
                        <?php
                          	while ($row = mysqli_fetch_assoc($result)) {
                        ?>
        				<?php 
        					echo "<ul class='list-inline'>
        		                    <li class='displayborder'>
        		                        <a href='details.php?code=".$row['pro_code']."&id=".$row['pro_id']."'>
        		                            <img src='../uploads/".$row['pro_image']."' />
        		                            <div class='price'>
        		                                <div class='cart-left'>
        		                                	<div class='price2'>
        		                                      <span class='discount'>-%".$row['pro_discount']."</span>
        		                                    </div>
        		                                    <p class='titlepro'>".$row['pro_name']."</p>
        		                                    
        		                                    <div class='price1'>
        		                                    <span class='total_p'>$".$row['total_price']."</span>&nbsp&nbsp&nbsp
        		                                      <span class='actual1'>$".$row['pro_price']."</span>
        		                                    </div>
        		                                </div>
        		                                <div class='clear'></div>
        		                            </div>  
        		                        </a>
        		                    </li>
        		                </ul>";
        					?>
        		        <?php 
        		           }
        		        ?>
                    </div>
                
                <?php
    	          //Now select all from table
    	         $query = "select * from products where cat_id=8";
    	          $result = mysqli_query($db, $query);
    
    	          // Count the total records
    	          $total_records = mysqli_num_rows($result);
    
    	          //Using ceil function to divide the total records on per page
    	          $total_pages = ceil($total_records / $per_page);
    
    	          //Going to first page
    	          echo "<center><a href='siren.php?page=1'>".'First Page'."</a> ";
    
    	          for ($i=1; $i<=$total_pages; $i++) {
    
    	          echo "<a href=siren.php?page=".$i."'>".$i."</a> ";
    	          };
    	          // Going to last page
    	          echo "<a href='siren.php?page=$total_pages'>".'Last Page'."</a></center> ";
    	        ?>
            </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
<?php
    include ("template/footer.php");
?>