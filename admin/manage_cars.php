<?php
    include ("authorization.php");
    include ("../models/admin.php");
    
    if(isset($_POST['submit'])){
        $car = $_POST['car'];
        $color = $_POST['color'];
        $price = $_POST['prices'];
        $query = Products::insertCarAndColor($car,$color,$price);
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
                        Manage Cars
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
                                <select class="form-control" name="car">
                                    <option value="No Cateogry" style="display:none;">Selects Car</option>
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
                                    <option value="No Cateogry" style="display:none;">Selects Color</option>
                                    <?php 
                                        $color =  Products::getColorCategory();
                                            foreach($color as $colorName){?>
                                                <option value="<?php echo $colorName['id'];?>">
                                                    <?php echo $colorName['colors']; ?>
                                                </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Price per day</label>
                                <input class="form-control" name="prices" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
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
                                            <th>Color</th>
                                            <th>Price</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $getCar =  Products::getCarAndColor();
                                                foreach($getCar as $carColor){?>
                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $carColor['car_name'];?></td>
                                                    <td><?php echo $carColor['colors'];?></td>
                                                    <td><?php echo $carColor['prices'];?></td>

                                                    <td style="width:13%" >
                                                        <a href='edit_carcat.php?id=<?php echo $carColor['id'];?>' class="btn btn-primary">Edit</a>
                                                        <a style="z-index:0; margin-left:53px; margin-top:-35px;" href="delete_car.php?id=<?php echo $carColor['id'];?>" onclick="return confirm('You want to delete product?')" class="btn btn-danger">Delete</a>
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