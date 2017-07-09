<?php
	include ('../lang/define_lang.php');
	include ("../config/config.php");
	include ("seo.php");
	include ("../models/products.php");

	//add to cart
    require_once("../include/dbcontroller.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) {
        switch($_GET["action"]) {
            case "add":
                if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE pro_code='" . $_GET["code"] . "'");
                    $itemArray = array($productByCode[0]["pro_code"]=>array(
                        'name'=>$productByCode[0]["pro_name"], 
                        'code'=>$productByCode[0]["pro_code"], 
                        'quantity'=>$_POST["quantity"], 
                        'price'=>$productByCode[0]["pro_price"])
                    );

                    if(!empty($_SESSION["cart_item"])) {
                        if(in_array($productByCode[0]["pro_code"],$_SESSION["cart_item"])) {
                            foreach($_SESSION["cart_item"] as $k => $v) {
                                    if($productByCode[0]["pro_code"] == $k)
                                        $_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
                            }
                        } else {
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                    }
                }
            break;
            case "like":
            	if(!empty($_POST["quantity"])) {
                    $productByCode = $db_handle->runQuery("SELECT * FROM products WHERE pro_code='" . $_GET["code"] . "'");
                    $ArrayItem = array($productByCode[0]["pro_code"]=>array(
                        'name'=>$productByCode[0]["pro_name"], 
                        'code'=>$productByCode[0]["pro_code"], 
                        'quantity'=>$_POST["quantity"], 
                        'price'=>$productByCode[0]["pro_price"]));
                    
                    if(!empty($_SESSION["like_item"])) {
                        if(in_array($productByCode[0]["pro_code"],$_SESSION["like_item"])) {
                            foreach($_SESSION["like_item"] as $key => $vvalue) {
                                    if($productByCode[0]["pro_code"] == $key)
                                        $_SESSION["like_item"][$k]["quantity"] = $_POST["quantity"];
                            }
                        } else {
                            $_SESSION["like_item"] = array_merge($_SESSION["like_item"],$ArrayItem);
                        }
                    } else {
                        $_SESSION["like_item"] = $ArrayItem;
                    }
                }
            break;
        }
    }
  //   if(isset($_SESSION['login_user'])=='Undefined'){
  //   	$uid = $_SESSION['uid'];
		// $userID = Product::getIdCart($uid);
	 //    $row = mysqli_fetch_array($userID);
	 //    if($row){
	 //        $cartid = $row['cart_id'];
	 //    }
	 //    $mycountcart = Product::countCart($cartid);
	 //    $count = mysqli_fetch_array($mycountcart);
	 //    $countcart=0;
	 //    if($count){
	 //    	$countcart = $count[0];
	 //    }
  //   }else{
  //   	echo "";
  //   }
    
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>

	<meta name="description" content="<?php echo $pageDescription; ?>">
	<meta name="keywords" content="<?php echo $pageKeyword; ?>">
	<?php
		// If canonical URL is specified, include canonical link element
		if($pageCanonical){
			echo '<link rel="canonical" href="' . $pageCanonical . '">';
		}
		// If meta robots content is specified, include robots meta tag
		if($pageRobots){
			echo '<meta name="robots" content="' . $pageRobots . '">';
		}
	?>
	<link href="resources/css/mystyles.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="icon" type="image/gif/png" href="resources/images/logo.png">
	<meta name="google-site-verification" content="Ry4SC9lqacxjYGDI_lYE9LC_Kg6POipip5-QEJCG4ZA" />
	<!-- this codeline defined the default zoom for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link href="resources/css/bootstrap.min.css" rel="stylesheet">
	<?php
		if($_SESSION['lang']==2){
	?>
		<link href="resources/css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
		<link href='resources/css/style.css' rel='stylesheet' type='text/css' media='all' />
	<?php
		}else{
	?>
		<link href="resources/css/megamenukh.css" rel="stylesheet" type="text/css" media="all" />
		<link href='resources/css/stylekh.css' rel='stylesheet' type='text/css' media='all' />
	<?php
		}
	?>
	<link href="resources/css/form.css" rel="stylesheet" type="text/css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="resources/js/jquery1.min.js"></script>
	<script type="text/javascript" src="resources/js/jquery-1.9.1.js"></script>
	<!-- start menu -->
	
	<script type="text/javascript" src="resources/js/megamenu.js"></script>
	<!-- <script>
		$(document).ready(function(){$(".megamenu").megamenu(
			);
		});
	</script> -->
	<link href="resources/css/etalage.css" rel="stylesheet">

  <script src="resources/js/slides.min.jquery.js"></script>
  <script src="resources/js/jquery.flexisel.js"></script>
  <script src="resources/js/jquery.etalage.min.js"></script>
	<script src="resources/js/jquery.easydropdown.js"></script>
	<!-- <script src="resources/js/jquery-1.9.1.js"></script> -->
	
	<style>
		div.headerStyle{
			margin-top: 24px;
   			height: 70px;
		}
		b{
			font-size: 14px;
		}
		.glyphicon-user{
			margin-top: 20px;
    		margin-left: -27px;
		}
		.glyphicon-shopping-cart{
			margin-top: 20px;
    		margin-left: -27px;
		}
		.cartCount{
			color:#333;
			float: left; 
			margin-top: 7px;
		}
	</style>
</head>
<div class="wrap">
	<div class="header-top col-md-12 col-xs-12">
			<ul class="list-inline loginheader">
				<?php
					if(isset($_SESSION['login_user'])=='Undefined'){
						echo '<li><a href="logout.php">'._t_logout.'</a></li>';
					}else{
						echo '<li>
								<a href="login.php"> '._t_login.' |</a>		
								<a href="register.php">'._t_signup.'</a>
							</li>';
					}
				?>
			</ul>
			<a href="index.php">
				<img src="resources/images/logo.png" alt="" class="logocim"/>
			</a>
		<div class="clear"></div>
		<?php
		    if(isset($_SESSION['login_user'])=='Undefined'){
				echo "";
			}else{
				// echo "<div class='animation'>Please register to get 5% off.</div>";
			}
		?>
		<?php
			if(!isset($_POST['search'])){
			    $searchname = "";
			} else {
			    $searchname = $_POST['search'];
			}  
		?>
		<!-- <form class="navbar-form" role="search" method="post" action="search.php">
	        <div class="input-group">
	            <input type="text" class="form-control" placeholder="<?php echo _t_search;?>" name="search" value="<?= $searchname ?>">
	        </div>
	    </form> -->
	   <!--  <div class="container">
			<div class="row">
		        <div class="col-sm-6 col-sm-offset-3">
		            <div id="imaginary_container"> 
		                <div class="input-group stylish-input-group">
		                    <input type="text" class="form-control" placeholder="<?php echo _t_search;?>" name="search" value="<?= $searchname ?>">
		                    <span class="input-group-addon">
		                        <button type="submit">
		                            <span class="glyphicon glyphicon-search"></span>
		                        </button>  
		                    </span>
		                </div>
		            </div>
		        </div>
			</div>
		</div> -->
 	</div>
</div>
	<div class="header-bottom">
	    <div class="wrap">
		    <div class="col-md-12 headerStyle">
			    
		    </div>
		    <!-- <hr style="border:1px solid #eee;"> -->
	 		<div class="clear"></div>
			<span class="menu-trigger">MENU</span>
			<div class="menu">
			    <ul class="megamenu skyblue">
			        <li class="dropdown1">
					  <a href="carDetail.php" class="dropbtn"><?php echo _t_carrent;?></a>
					</li>
					<li class="dropdown1">
					    <a href="#" class="dropbtn"><?php echo _t_shoppings;?></a>
					</li>
					<li class="dropdown1">
					    <a href="#" class="dropbtn"><?php echo _t_restuarant;?></a>
					</li>
					<li class="dropdown1">
					    <a href="#?name=drink" class="dropbtn"><?php echo _t_fooddrink;?></a>
					</li>
					<li class="dropdown1">
					    <a href="#" class="dropbtn"><?php echo _t_cinemaandfootball;?></a>
					</li>
					<li class="dropdown1">
					    <a href="#" class="dropbtn"><?php echo _t_coupon;?></a>
					</li>
				</ul>
			</div>
    <div class="clear"></div>
    </div>
    <script type="text/javascript">
    	jQuery(document).ready(function(){
			jQuery(".menu-trigger").click(function(){
				jQuery(".menu").slideToggle();
			});
		});
    </script>
</div>


