<?php
	include ("template/header.php");
	//include ("../models/products.php");
?>
<style type="text/css">
	#slider1 img{
		height: 150px !important;
	}
	#slider img{
		height: 300px !important;
	}
</style>
<div class='main'>
	<div class='wrap'>
		<div class=''>
			<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
			<link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
			<link href='resources/css/style.css' rel='stylesheet' type='text/css' media='all' />
		 	<link href='resources/css/default.css' rel='stylesheet' type='text/css' media='all' />
		 	<link href='resources/css/nivo-slider.css' rel='stylesheet' type='text/css' media='all' />
		  	<script src='resources/js/jquery.nivo.slider.js'></script>
		  	<script src="resources/js/bootstrap.mini.js" type="text/javascript"></script>
			<script src="resources/js/bootstrap.js" type="text/javascript"></script>
		    <script type='text/javascript'>
		    	// slider 1
			    $(window).load(function() {
			        $('#slider').nivoSlider();
			    });
			    // slider 2
			     $(window).load(function() {
			        $('#slider1').nivoSlider();
			    });
			     // button tooltip
				$(document).ready(function(){
				    $('[data-toggle="tooltip"]').tooltip();   
				});
			</script>
			<!-- first slide show (home) -->
		    <div class='slider-wrapper theme-default'>
		      	<div id='slider' class='nivoSlider'>
		      		<?php 
		      			$ShowSlide=Product::showslide();
		      			foreach ($ShowSlide as $show){
		      				echo "
		      					<img src = '../uploads/".$show['image']."'/>
		      				";
		      			}
		      		?>

		      	</div>
		    </div>
		</div>
		<div class="clear"></div>

		<div class="strike">
		    <h1>ALL PRODUCT CATEGORIES</h1>
		</div>

		<div class="clear"></div>
		<!-- manage shop category -->
		<div class="col-md-12 col-lg-12">
		<?php 
			$category =  Product::getShopCategory();
				foreach ($category as $cat){
					?>
					<div class="col-md-4" style="padding-right:-1px;padding-bottom:25px">
						<a href="list_shop.php?id=<?php echo $cat['shop_cat_id'];?>">
							<img class="image" style="height:250px;" src="../uploads/<?php echo $cat['images'];?>"/>
						</a>
						<div class="caption">
			            	<button type="button" class="btn btn-primary"><?php echo $cat['shop_category'];?></button>

			        	</div>
					</div>
				<?php }?>
		</div>
		<!-- manage shop category -->
		<div class="clear"></div>

		<div class="strike">
		    <h1>SPECIAL PROMOTION</h1>
		</div>

		<div class="clear"></div>
		<!-- second slide show (product)-->
	   	<div class="col-md-12 col-lg-12">
	   		<div class='slider-wrapper theme-default'>
		      	<div id='slider1' class='nivoSlider'>
		      		<?php 
		      			$ShowSlide1=Product::showslideProduct();
		      			foreach ($ShowSlide1 as $show1){
		      				echo "
		      					<img src = '../uploads/".$show1['image']."'/>
		      				";
		      			}
		      		?>

		      	</div>
		    </div>
	   	</div>

	   	<div class="clear"></div>

		<!-- <div class="strike">
		    <h1>ALL SHOP/ COMPANY</h1>
		</div>

		<div class="clear"></div>
		<div class="col-md-12 col-lg-12">
		<?php 
			$Product =  Product::getProducts();
				foreach ($Product as $sho){
					?>
					<div class="col-md-3" style="padding-right:-1px;padding-bottom:25px">
						<a href="details.php?id=<?php echo $sho['pro_id'];?>">
							<img style="height:200px; width:450px;" src="../uploads/<?php echo $sho['pro_image'];?>" />
						</a>
						<div class='socail' style="margin-top: 10px;">
	               			<a href="<?php echo $sho['facebook'];?>" class='fa fa-facebook' data-toggle='tooltip' data-placement='bottom'></a>
							<a class='fa fa-phone' data-toggle='tooltip' data-placement='bottom' title="<?php echo $sho['phone'];?>"></a>
							<a class='fa fa-google' data-toggle='tooltip' data-placement='bottom' title="<?php echo $sho['gmail'];?>"></a>
							<a href="<?php echo $sho['location'];?>" class='fa fa-map-marker' data-toggle='tooltip' data-placement='bottom'></a>
	                        <div class='clear'></div>
	                    </div> 
					</div>
		<?php }?>
		</div> -->

		<div class='clear'></div>

		<div class="strike">
		    <h1>ABOUT US</h1>
		</div>

		<div class='clear'></div>

		<h1>Who are we?</h1>
        <div class="section group">
            <div class="labout span_1_of_about">
                <div class="testimonials ">
                    <div class="testi-item" style="width:235px;">
                        <a href="#" >
                            <img src="resources/images/logo1.jpg">
                        </a>
                    </div>
                    <h3 style="margin-top:-65px;"><?php echo _t_title;?></h3>
                </div>
            </div>
            <div class="cont span_2_of_about">
                <h3></h3>
                <p><?php echo _t_aboutcim;?></p>
            </div>

            <div class="clear"></div>

            <div class="col-md-12">

				<div class="strike">
				    <h1>CONTACT US</h1>
				</div>

				<div class='clear'></div>
				<!-- google map -->
				<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAZFsa3xsng8xZ_-NuGKeP-V41HtTi9Obk'></script>
				<div style='overflow:hidden;height:440px;width:100%;'>
					<div id='gmap_canvas' style='height:440px;width:100%;'></div>
					<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
				</div>
				<script type='text/javascript'>
					function init_map(){
						var myOptions = {
							zoom:13,
							center:new google.maps.LatLng(11.5136032,104.88714900000002),
							mapTypeId: google.maps.MapTypeId.ROADMAP
						};
						map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
						marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(11.5136032,104.88714900000002)});
						infowindow = new google.maps.InfoWindow({
							content:'<strong style="font-weight: bold;">Cambodia Intermarket</strong><br>Borey Pi Phop Thmey<br>'
						});
						google.maps.event.addListener(marker, 'click', function(){
							infowindow.open(map,marker);
						});
						infowindow.open(map,marker);
					}google.maps.event.addDomListener(window, 'load', init_map);
				</script>

			</div>
	</div>
	<div class='clear'></div>
</div>
<?php
	include ('template/footer.php');
?>