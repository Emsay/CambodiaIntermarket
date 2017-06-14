<?php
	include ("template/header.php");
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
<div class="main">
    <div class="wrap">
		<div class="clear"></div>
		<div class="strike">
		    <h1>ALL SHOP/ COMPANY</h1>
		</div>
		<div class="clear"></div>
		<div style="background:#eee; padding:15px;" class="col-md-12 col-lg-12">
		<?php 
				if(isset($_GET['id'])){
				$id = $_GET['id'];
			} 
			$Product =  Product::listShop($id);
				foreach ($Product as $shop){
					?>
					<div class="col-md-3" style="padding-right:-1px;padding-bottom:25px;">
						<a href="details.php?id=<?php echo $shop['id'];?>">
							<img style="height:200px; width:450px;" src="../uploads/<?php echo $shop['images'];?>" />
						</a>
						<div class='socail' style="margin-top: 10px;">
	               			<a href="<?php echo $shop['facebook'];?>" class='fa fa-facebook' data-toggle='tooltip' data-placement='bottom'></a>
							<a class='fa fa-phone' data-toggle='tooltip' data-placement='bottom' title="<?php echo $shop['phone'];?>"></a>
							<a href="<?php echo $shop['location'];?>" class='fa fa-map-marker' data-toggle='tooltip' data-placement='bottom'></a>
			            <div class='clear'></div>
			            </div> 
					</div>
		<?php }?>
		</div>
	</div>
</div>
<?php
	include ('template/footer.php');
?>