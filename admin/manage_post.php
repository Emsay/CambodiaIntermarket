<?php
    include ("authorization.php");
    include ('../models/admin.php');

    $postSuceess="";
    $codeErr="";

    if(isset($_POST['post'])){
        $pname = $_POST['name'];
        $pprice = $_POST['price'];
        $pdis = $_POST['discount'];
        $ptotal = $_POST['total'];
        $pcode = $_POST['code'];
        $paddress = $_POST['address'];
        $pfacebook = $_POST['facebook'];
        $pphone = $_POST['phone'];
        $pgmail = $_POST['gmail'];
        $plocation = $_POST['location'];
        $pexpire = $_POST['expire'];
        $type = basename($_FILES['image']['type']);
        $pimage = basename($_FILES['image']['name']);
        $pcat = $_POST['cat'];
        $deskh = $_POST['desKh'];
        $desen = $_POST['desEn'];
        $pinfor = $_POST['desInfo'];
        $stock = $_POST['stock'];
        $date = date("Y/m/d H:i:s");
        $yes = 1;
        
        $checkCode = Products::checkCode($pcode);
        if($checkCode=='already'){
            $codeErr = "Product Code has already added.";
        }else{
            echo "";
        }

        if($type != "png" && $type != "jpg" && $type != "jpeg"){
            echo "This file not respond because it is not file image.";
            $yes = 0;
        }else{
            if($checkCode!='already'){
                $to = "../uploads/".$_FILES['image']['name'];
                echo "Hello path ".$to;
                move_uploaded_file($_FILES['image']['tmp_name'],$to);
                $insert_product = Products::insert($pname,$pprice,$pdis,$ptotal,$pcode,$pcat,$stock,$pimage,$deskh,$desen,$pinfor,$paddress,$pfacebook,$pphone,$pgmail,$plocation);
                $postSuceess="You have successfull post product. <br/><a href='listproducts.php'>Go to ListProduct</a>";
                $yes=1;
            }
        }
    }
?>
<div id="wrapper">    
    <?php 
        include ("menu_admin.php");
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Manage Product
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> PostProduct
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Name</label>
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Price</label>
                                <input class="form-control" name="price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Discount</label>
                                <input class="form-control" name="discount" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Code</label>
                                <input class="form-control" name="code">
                                <p style="color:red;"><?php echo $codeErr;?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Select Post</label>
                                <select class="form-control" name="location">
                                    <option value="0">Product Categories</option>
                                    <option value="1">Shop Information</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <input name="stock" type="radio" value="In stock">
                                <label>In stock</label><br/>
                                <input name="stock" type="radio" value="In stock usually within 2 weeks after order">
                                <label>In stock usually within 2 weeks after order</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects category</label>
                                <select class="form-control" name="cat">
                                    <option value="No Cateogry" style="display:none;">Selects category</option>
                                    <?php 
                                        $category = Products::getCategory();
                                        foreach($category as $cat){
                                    ?>
                                    <option value="<?php echo $cat['cat_id'];?>" name="cat">
                                        <?php echo $cat['cat_name'];?>
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="image" id='uploader' required><br />
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
                                <label>Khmer Description</label>
                                <textarea class="form-control" rows="3" name="desKh"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>English Description</label>
                                <textarea class="form-control" rows="3" name="desEn"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Information</label>
                                <textarea class="form-control" rows="3" name="desInfo"></textarea>
                            </div>
                        </div>
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
                                <input class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Email Address</label>
                                <input class="form-control" name="gmail" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Location Address</label>
                                <input class="form-control" name="location" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="post" class="btn btn-success">Submit Post</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>