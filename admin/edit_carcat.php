<?php
    include ("authorization.php");
    include ("../models/category.php");

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
        $select= Category::getCarCatID($id);
        $row = mysqli_fetch_array($select);
        if($row){
            $ca_name = $row['car_name'];
            $ca_price = $row['car_price'];
        }else{
            echo "No result.";
        }
    }

    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        $ca_name = $_POST['name'];
        $ca_price = $_POST['price'];
        $query = Category::updateCarCat($id,$ca_name,$ca_price);
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
                                <label>CAR NAME</label>
                                <input class="form-control" name="name" value="<?php echo $ca_name;?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>CAR PRICE/MONTH</label>
                                <input class="form-control" name="price" value="<?php echo $ca_price;?>" required>
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