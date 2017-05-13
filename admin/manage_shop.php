<?php
    include ("authorization.php");
    include ('../models/admin.php');

    $postSuceess="";
    $codeErr="";

    if(isset($_POST['post'])){
        $sname = $_POST['name'];
        $saddress = $_POST['address'];
        $sfacebook = $_POST['facebook'];
        $sphone = $_POST['phone'];
        $sgmail = $_POST['gmail'];
        $slocation = $_POST['location'];
        $type = basename($_FILES['image']['type']);
        $simage = basename($_FILES['image']['name']);
        $scat = $_POST['cat'];
        $sdesen = $_POST['desEn'];
        $sdate = date("Y/m/d H:i:s");
        $yes = 1;

        if($type != "png" && $type != "jpg" && $type != "jpeg"){
            echo "This file not respond because it is not file image.";
            $yes = 0;
        }else{
            $to = "../uploads/".$_FILES['image']['name'];
            echo "Hello path ".$to;
            move_uploaded_file($_FILES['image']['tmp_name'],$to);
            $insert_product = Products::insertShop($scat,$sname,$sdesen,$simage,$saddress,$sphone,$sfacebook,$sgmail,$slocation,$sdate);
            $postSuceess="You have successfull post product. <br/><a href='listproducts.php'>Go to ListProduct</a>";
            $yes=1;
        }
    }
?>
<style type="text/css">
    .btn-success{
        margin-top: 10px;
    }
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none;
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
                        Manage Shop
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> ManageShop
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Shop Name</label>
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Shop Description</label>
                                <textarea class="form-control" rows="3" name="desEn"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Shop category</label>
                                <select class="form-control" name="cat">
                                    <option value="No Cateogry" style="display:none;">Selects category</option>
                                    <?php 
                                        $category = Products::getShopCategory();
                                        foreach($category as $cat){
                                    ?>
                                    <option value="<?php echo $cat['id'];?>">
                                        <?php echo $cat['shop_category'];?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="image" id='uploader'><br />
                                <img id='placeholder' style="width:200px;">
                                <p class="success"><?php echo $postSuceess;?></p>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#placeholder').previewImage( {uploader: '#uploader'});
                        </script>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" name="address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Facebook</label>
                                <input class="form-control" name="facebook" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Phone Number</label>
                                <input type="number" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="gmail" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Map Location</label>
                                <input class="form-control" name="location" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="post" class="btn btn-success">Submit Post</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>