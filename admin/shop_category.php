<?php
    include ("authorization.php");
    include ("../models/category.php");
    
    if(isset($_POST['submit'])){
        $shop_cate = $_POST['name'];
        $query = Category::insertShopCate($shop_cate);
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
                            <i class="fa fa-table"></i> ManageCategory
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Category Name</label>
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-success">Submit Category</button>
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
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $category =  Category::getShopCat();
                                                foreach($category as $cat){?>

                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $cat['shop_category'];?></td>
                                                    <td style="width:13%" >
                                                        <a href='edit_shopcat.php?id=<?php echo $cat['id'];?>' class="btn btn-primary">Edit</a>
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