<?php
    include ("authorization.php");
    include ("../models/category.php");
    
    if(isset($_POST['submit'])){
        $car_cate = $_POST['name'];
        $car_prices = $_POST['prices'];
        $query = Category::insertCarCate($car_cate,$car_prices);
        if($query){
            echo "insert new row";
        }else{
            echo "fail!";
        }
    }
?>
<style type="text/css">
    .btn-success{
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
                        Manage Car
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Manage Car
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
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Price Per Day</label>
                                <input class="form-control" name="prices" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-success">SAVE CAR</button>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="table-container" class="table-responsive">
                                <table id="maintable" class="table table-bordered table-hover table-striped">
                                    <thead >
                                        <tr>
                                            <th>#</th>
                                            <th>Car Type</th>
                                            <th>Price</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $category =  Category::getCarCat();
                                                foreach($category as $ca){?>

                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $ca['car_name'];?></td>
                                                    <td>$ <?php echo $ca['prices'];?></td>
                                                    <td style="width:13%" >
                                                        <a href='edit_carcat.php?id=<?php echo $ca['id'];?>' class="btn btn-primary">Edit</a>
                                                        <a style="z-index:0; margin-left:53px; margin-top:-35px;" href="delete_car.php?id=<?php echo $ca['id'];?>" onclick="return confirm('You want to delete product?')" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                
                                            <?php $i++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <?php
    include ("authorization.php");
    include ("../models/category.php");
    
    if(isset($_POST['submit'])){
        $car_cate = $_POST['name'];
        $car_prices = $_POST['price'];
        $query = Category::insertCarCate($car_cate,$car_prices);
        if($query){
            echo "insert new row";
        }else{
            echo "fail!";
        }
    }
?>
<style type="text/css">
    .btn-success{
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
                        Manage Category
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Manage Car Color
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
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>CAR PRICE/MONTH</label>
                                <input class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-success">SAVE CAR</button>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="table-container" class="table-responsive">
                                <table id="maintable" class="table table-bordered table-hover table-striped">
                                    <thead >
                                        <tr>
                                            <th>#</th>
                                            <th>CAR NAME</th>
                                            <th>CAR PRICE/MONTH</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $category =  Category::getCarCat();
                                                foreach($category as $ca){?>

                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $ca['car_name'];?></td>
                                                    <td><?php echo "$ ". $ca['car_price'];?></td>
                                                    <td style="width:13%" >
                                                      <a style="z-index:0; background:#4cb1ca;border:1px #4cb1ca;" href='edit_carcat.php?id=<?php echo $ca['id'];?>' class="btn btn-success">Edit</a>
                                                      <a style="z-index:0;" href="delete_car.php?id=<?php echo $ca['id'];?>" onclick="return confirm('You want to delete product?')" class="btn btn-danger">Delete</a></td>
                                                </tr>
                                                
                                            <?php $i++; }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->