<?php
	include ("template/header.php");
	//include ("../models/products.php");

	$emailErr='';
  	$regisErr = '';
?>
<style type="text/css">
	li a,p,h3{
		font-family: Arial !important;
	}
	.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: hidden;
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}
	/* Modal Content */
	.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s;
	}
	/* Add Animation */
	@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
	}
	@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
	}
	/* alert modal on homepage*/
	.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
	}

	.close:hover,
	.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
	}

	.modal-header {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
	}
	.modal-body {padding: 2px 16px;}
	.modal-footer {
    padding: 2px 16px;
    background-color: #5cb85c;
    color: white;
	}

	#slider1 img{
		height: 150px !important;
	}
	#slider img{
		height: 300px !important;
	}
	.error {color: #FF0000;font-size: 28px;}
        .errorEmail{color:#ff0000;}
        body{
            font-family: Arial !important;
        }
        input, select, option{
            font-family: Arial !important;
            font-size: 16px !important;
        }
        h4{
            font-family: Arial;
        }
    .discounttxt{
    	background-color: #00ADC9;
	    width: 85px;
	    height: 40px;
	    color: #fff;
	    position: absolute;
	    text-align: center;
	    padding-top: 8px;
	    margin-left: -18px;
	    margin-top: -12px;
	    font-size: 22px;
	    border: 1px solid #fff;
    }
</style>
<div class='main' style="background-image: url(resources/images/pic.png),url(resources/images/pic2.jpg);height:1394px;background-color: #6fd4ed;background-position:0 0, 0 bottom; background-repeat:no-repeat;position: absolute; background-size: 100% 49%;" >
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
			// var modal = document.getElementById('myModal');
			// // Get the button that opens the modal
			// var btn = document.getElementById("myBtn");
			// setTimeout(function(){
			// 	$('#myModal').show('fade');
			// },8000);
			// // Get the <span> element that closes the modal
			// var span = document.getElementsByClassName("close")[0];
			// // When the user clicks the button, open the modal 
			// btn.onclick = function() {
			//     modal.style.display = "block";
			// }
			// // When the user clicks on <span> (x), close the modal
			// span.onclick = function() {
			//     modal.style.display = "none";
			// }
			// // When the user clicks anywhere outside of the modal, close it
			// window.onclick = function(event) {
			//     if (event.target == modal) {
			//         modal.style.display = "none";
			//     }
			// }
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
		    <!-- <div class='slider-wrapper theme-default'>
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
		    </div> -->
		</div>
		<div class="clear"></div>
		<div class="bg-custom col-md-12 col-lg-12">
		<h1 style="text-align:center; color:#fff; font-size:bold;"></h1><hr>
			<?php 
				$Product =  Product::getProducts();
					foreach ($Product as $pro){
						?>
						<div class="col-md-4" style="padding-right:-1px;padding-bottom:25px;">
							<div class="discounttxt"><?php echo $pro['pro_discount']; ?>%</div>
							<a href="details.php?id=<?php echo $pro['pro_id'];?>">
								
								<img class="images" style="height: 300px;border:1px solid #ccc" src="../uploads/<?php echo $pro['pro_image'];?>" />
								<div class="overlay">
							    	<div class="text" style="font-weight:bold; font-family:arial; font-size:90%; color: #286090;">
							    		<?php echo 'Name : '.$pro['pro_name']; ?><br>
							    		<?php echo 'Discount : '.$pro['pro_discount'].'%'; ?><br>
							    	</div> 
							  </div>
							</a>
						</div>
			<?php }?>
		</div>
		<div class='clear'></div>

		<!-- <div class="strike">
		    <h1>ALL PRODUCT CATEGORIES</h1>
		</div> -->
		<h1 style="text-align:center; color:#00ADC9; font-size:bold;">ALL PRODUCT CATEGORIES</h1>
		<hr>
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

		<!-- <div class="strike">
		    <h1>SPECIAL PROMOTION</h1>
		</div> -->
		<h1 style="text-align:center; color:#00ADC9; font-size:bold;">SPECIAL PROMOTION</h1>
		<hr>
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
		    <h1>ABOUT US</h1>
		</div> -->
		<h1 style="text-align:center; color:#00ADC9; font-size:bold;">ABOUT US</h1>
		<hr>
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

				<!-- <div class="strike">
				    <h1>CONTACT US</h1>
				</div> -->
				<h1 style="text-align:center; color: #00ADC9; font-size:bold;">CONTACT US</h1>
				<hr>
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