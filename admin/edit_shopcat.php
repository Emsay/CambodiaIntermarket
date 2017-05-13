<?php
    include ("authorization.php");
    include ("../models/category.php");

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];
        $select= Category::getShopCatID($id);
        $row = mysqli_fetch_array($select);
        if($row){
            $cat_name = $row['shop_category'];
        }else{
            echo "No result.";
        }
    }

    if(isset($_POST['submit'])){
        $id = $_GET['id'];
        $cat_name = $_POST['name'];
        $query = Category::updateShopCat($id,$cat_name);
        if($query){
            header ("location: shop_category.php");
        }else{
            echo "fail!";
        }
    }
    if(isset($_POST['back'])){
        header ("location: shop_category.php");
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
                            <i class="fa fa-table"></i> Edit Shop Category
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Shop Category Name</label>
                                <input class="form-control" name="name" value="<?php echo $cat_name;?>" required>
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