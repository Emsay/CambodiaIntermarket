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
	<link rel="icon" type="image/gif/png" href="resources/images/logo1.jpg">
	<meta name="google-site-verification" content="Ry4SC9lqacxjYGDI_lYE9LC_Kg6POipip5-QEJCG4ZA" />
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
	<!-- start menu -->
	
	<script type="text/javascript" src="resources/js/megamenu.js"></script>
	<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
	<link href="resources/css/etalage.css" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="resoursec/css/bootstrap-datetimepicker.css"> -->

    <script src="resources/js/slides.min.jquery.js"></script>
    <script src="resources/js/jquery.flexisel.js"></script>
    <script src="resources/js/jquery.etalage.min.js"></script>
	<script src="resources/js/jquery.easydropdown.js"></script>
	<script src="resources/js/bootstrap-datetimepicker.min.js"></script>

	<style>
		div.headerStyle{
			margin-top: 24px;
   			height: 70px;
		}
		img.imglogo{
			width: 170px;
    		height: 110px;
    		margin-top:-10px;
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
		<div class="col-md-4 col-xs-12">
			<ul class="list-inline lang">
				<!-- <a href="..\lang/switch_lang.php?lang=2" style="color:#fff; font-family:'Arial';font-size:14px;margin-left:91px;">English</a> |
				<a href="..\lang/switch_lang.php?lang=1">ភាសាខ្មែរ</a> -->
				<div class="col-md-3">
					<a href="index.php">
						<img src="resources/images/logo.png" alt="" class="imglogo" />
					</a>
				</div>
				<div class="col-md-9">
				<?php
						if(!isset($_POST['search'])){
						    $searchname = "";
						} else {
						    $searchname = $_POST['search'];
						}  
					?>
			 		<form class="navbar-form" role="search" method="post" action="search.php">
				        <div class="input-group">
				            <input type="text" class="form-control" placeholder="<?php echo _t_search;?>" name="search" style="height: 35px; width: 225px;font-size: 14px;" value="<?= $searchname ?>">
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit" id="submit" name="submit" style="height:35px; background: #3b5998;color:#fff;margin-top:0px;">
				                	<i class="glyphicon glyphicon-search"></i>
				                </button>
				            </div>
				        </div>
				    </form>
				</div>
				<!-- <?php
			    if(isset($_SESSION['login_user'])=='Undefined'){
					echo "<li style='color:#fff; font-family:'Arial';font-size:14px;margin-left:91px;'>"._t_welcome." ".$_SESSION['login_user']."</li>";
					}else{
						echo "";
					}
				?> -->
			</ul>
		</div>
		<?php
			// $session_items = 0;
	  //       $session_like = 0;
	  //       if(!empty($_SESSION["cart_item"])){
	  //           $session_items = count($_SESSION["cart_item"]);
	  //       }
	  //       if(!empty($_SESSION["like_item"])){
	  //           $session_like = count($_SESSION["like_item"]);
	  //       } 
	    ?>
		<div class="col-md-4 col-xs-12 threeicon">
			<div class="col-md-4 col-xs-4 styleicon">
				<!-- <a href="mywishlist.php">
		    		<img src="resources/images/heart.png" class="icon">
		    		<span class="divItems" style="color:#fff;">
		    		<?php echo $session_like; ?></span>
		    		<p class="texticon"><?php echo _t_wishlist;?></p>
		    	</a> -->
			</div>
		</div>
		<div class="col-offset-2 col-md-2 col-xs-9">
			<ul class="list-inline loginheader">
				<?php
					if(isset($_SESSION['login_user'])=='Undefined'){
						echo '<li><a href="logout.php">'._t_logout.'</a></li>';
					}else{
						echo '<li>
								<a href="login.php"> '._t_login.' |</a>		
								<a href="register.php">'._t_register.'</a>
							</li>';
					}
				?>
			</ul>
		</div>
		<div class="clear"></div>
		<?php
		    if(isset($_SESSION['login_user'])=='Undefined'){
				echo "";
			}else{
				// echo "<div class='animation'>Please register to get 5% off.</div>";
			}
		?>
 	</div>
</div>
	<div class="header-bottom">
	    <div class="wrap">
		    <div class="col-md-12 headerStyle">
			    <!-- <div class="col-md-3">
			    	<a href="index.php">
						<img src="resources/images/logo.png" alt="" class="imglogo" />
					</a>
			    </div> -->
			    <div class="col-md-4">
			    	<!-- <?php
						if(!isset($_POST['search'])){
						    $searchname = "";
						} else {
						    $searchname = $_POST['search'];
						}  
					?>
			 		<form class="navbar-form" role="search" method="post" action="search.php">
				        <div class="input-group">
				            <input type="text" class="form-control" placeholder="<?php echo _t_search;?>" name="search" style="height: 50px;width: 201px;font-size: 20px;" value="<?= $searchname ?>">
				            <div class="input-group-btn">
				                <button class="btn btn-default" type="submit" id="submit" name="submit" style="height:50px;background: #3b5998;color:#fff;margin-top:0px;">
				                	<i class="glyphicon glyphicon-search"></i>
				                </button>
				            </div>
				        </div>
				    </form> -->
			    </div>
			    <div class="col-md-1"></div>
			    <div class="col-md-2">
			    	<?php
						/*if(isset($_SESSION['login_user'])=='Undefined'){
							echo "<a href='profile.php?id=".$_SESSION['uid']."'>
						    		<span class='glyphicon glyphicon-user' aria-hidden='true'>
						    		<b>My Account</b></span>
						    	</a>";
						}else{
							echo "<a href='login.php'>
						    		<span class='glyphicon glyphicon-user' aria-hidden='true'>
						    		<b>My Account</b></span>
						    	</a>";
						}*/
					?>
			    </div>
			    <div class="col-md-2">
					<?php
					  //   if(isset($_SESSION['login_user'])=='Undefined'){
							// echo "<a href='mycart.php'>
							// <span class='cartCount'>".$countcart."</span>
					  //   		<span class='glyphicon glyphicon-shopping-cart'>
					  //   		<b'>Cart</b></span>
					  //   	</a>";
					  //   }else{
					  //   	echo "<a href='mycart.php'>
					  //   	<span class='cartCount'>".$session_items."</span>
					  //   		<span class='glyphicon glyphicon-shopping-cart'>
					  //   		<b>Cart</b></span>
					  //   	</a>";
					  //   }
					?>
			    </div>
		    </div>
		    <!-- <hr style="border:1px solid #eee;"> -->
	 		<div class="clear"></div>
			<!-- <div class="promote"></div> -->
	 		<!-- desktop menu -->
			<div class="menu">
	            <ul class="megamenu skyblue">
	            	<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_trip;?></a>
					</li>
					<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_shoppings;?></a>
					</li>
					<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_troubleshooting;?></a>
					</li>
					<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_food;?></a>
					</li>
					<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_cinemaandfootball;?></a>
					</li>
					<li class="dropdown1">
					    <a href="woman.php" class="dropbtn"><?php echo _t_hostroom;?></a>
					</li>
				</ul>
			</div>
			
    <div class="clear"></div>
    </div>
</div>


