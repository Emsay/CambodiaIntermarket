<?php
    include ("authorization.php");
    include ("../models/admin.php");

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
        $select= Products::getCarColorId($id);
        $row = mysqli_fetch_array($select);
        if($row){
            $car_name = $row['car_name'];
            $car_price = $row['prices'];
            $car_color = $row['colors'];
        }else{
            echo "No result.";
        }
    }

    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        $ca_name = $_POST['name'];
        $ca_price = $_POST['price'];
        $query = Products::updateCarCat($id,$ca_name,$ca_price);
        if($query){
            header ("location: car_category.php");
        }else{
            echo "fail!";
        }
    }
    if(isset($_POST['back'])){
        header ("location: car_category.php");
    }
?>
<style type="text/css">
    .btn-success,.btn-default{
        margin-top:10px;
    }
</style>
<div id="wrapper">    
    <?php 
        include ("menu_admin.php");
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Update Category
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Edit Car Category
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                       <div class="form-group">
                            <div class="col-xs-10">
                                <label>Car Name</label>
                                <select class="form-control" name="car">
                                    <option value="No Cateogry" style="display:none;">
                                        <?php echo $car_name; ?></option>
                                    <?php 
                                        $car =  Products::getCarCategory();
                                            foreach($car as $carName){?>
                                                <option value="<?php echo $carName['id'];?>">
                                                    <?php echo $carName['car_name']; ?>
                                                </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Color</label>
                                <select class="form-control" name="color">
                                    <option value="No Cateogry" style="display:none;">
                                        <?php echo $car_color; ?></option>
                                    <?php 
                                        $color =  Products::getColorCategory();
                                            foreach($color as $colorName){?>
                                                <option value="<?php echo $colorName['id'];?>">
                                                    <?php echo $colorName['car_name']; ?>
                                                </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Price per day</label>
                                <input class="form-control" name="prices" value="<?php echo $car_price; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-success">Save</button>
                                <button type="submit" name="back" class="btn btn-default">Back</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>