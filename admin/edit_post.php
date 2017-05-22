<?php
    $db = mysqli_connect("localhost","root","","cambodiaintermarket_com");
    mysqli_query ( $db,"set character_set_results='utf8'" );

    include ("authorization.php");
    include ('../models/admin.php');

    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
        $id = $_GET['id'];

        $select= "SELECT products.*, category.cat_name from products inner join category on products.cat_id=category.cat_id where pro_id=".$id;
        $query = mysqli_query($db,$select);
        $row = mysqli_fetch_array($query);
        if($row){
            $cat_name = $row['cat_name'];
            $cat_id = $row['cat_id'];
            $proid = $row['pro_id'];
            $pname = $row['pro_name'];
            $paddress = $row['address'];
            $pfacebook = $row['facebook'];
            $pphone = $row['phone'];
            $pgmail = $row['gmail'];
            $plocation = $row['location'];
            $pprice = $row['pro_price'];
            $pdate_discount = $row['date_dis'];
            $pdis = $row['pro_discount'];
            $ptotal = $row['total_price'];
            $pcode = $row['pro_code'];
            $stock = $row['pro_stock'];
            $pimage = $row['pro_image'];
            $deskh = $row['pro_descriptionKh'];
            $desen = $row['pro_descriptionEn'];
            $pinfor = $row['pro_information'];
            $_SESSION['img']= $row['pro_image'];
            
        }else{
        // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
            echo 'Error!';
        }
    }

    if (isset($_POST['edit'])){
        $id = $_GET['id'];
        $pname = $_POST['name'];
        $paddress = $_POST['address'];
        $pfacebook = $_POST['facebook'];
        $pphone = $_POST['phone'];
        $pgmail = $_POST['gmail'];
        $plocation = $_POST['location'];
        $pprice = $_POST['price'];
        $pdis = $_POST['discount'];
        $pdate_discount = $_POST['date_discount'];
        $ptotal = $_POST['total'];
        $pcode = $_POST['code'];
        $pstock = $_POST['stock'];
        $type = basename($_FILES['image']['type']);
        $pimage = basename($_FILES['image']['name']);
        $pcat = $_POST['cat'];
        $deskh = $_POST['desKh'];
        $desen = $_POST['desEn'];
        $pinfor = $_POST['desInfo'];
        
        if($pimage){
            $to = "../uploads/".$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],$to);
            $edit_product = Products::edit($id,$pname,$pprice,$pdis,$ptotal,$pcode,$pcat,$pstock,$pimage,$deskh,$desen,$pinfor,$paddress,$pfacebook,$pphone,$pgmail,$plocation,$pdate_discount);
            header("Location: listproducts.php");
        }else if($_SESSION['img']){
            $to = "../uploads/".$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],$to);
            $edit_product = Products::edit($id,$pname,$pprice,$pdis,$pdate_discount,$ptotal,$pcode,$pcat,$pstock,$_SESSION['img'],$deskh,$desen,$pinfor,$paddress,$pfacebook,$pphone,$pgmail,
                $plocation);
            header("Location: listproducts.php");
        }else{
            echo "no images";
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
                        Update Product
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> UpdateProduct
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
                                <input class="form-control" name="name" value="<?php echo $pname; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Price</label>
                                <input class="form-control" name="price" value="<?php echo $pprice; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Discount</label>
                                <input class="form-control" name="discount" value="<?php echo $pdis; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Date Discount</label>
                                <input class="form-control" name="date_discount" value="<?php echo $pdis; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Code</label>
                                <input class="form-control" name="code" value="<?php echo $pcode; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <input name="stock" type="radio" value="In stock" 
                                <?php if($stock=='In stock') {echo 'checked' ;} ?>>
                                <label>In stock</label><br/>
                                <input name="stock" type="radio" value="In stock usually within 2 weeks after order" 
                                <?php if($stock=='In stock usually within 2 weeks after order') {echo 'checked' ;} ?>>
                                <label>In stock usually within 2 weeks after order</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects category</label>
                                <select class="form-control" name="cat">
                                    <option style="display:none" value="<?php echo $cat_id;?>">
                                        <?php echo $cat_name;?>
                                    </option>
                               <?php 
                                   $category = Products::getCategory();
                                   foreach($category as $cat){?>
                                        <option value="<?php echo $cat['cat_id'];?>">
                                           <?php echo $cat['cat_name'];?>
                                        </option>
                               <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="image" id='uploader'><br />
                                <?php echo "<img name='image' style='width:200px;' id='placeholder' src = '../uploads/".$pimage."'>";?>
                            </div><br/>
                        </div>
                        <script type="text/javascript">
                            $('#placeholder').previewImage( {uploader: '#uploader'});
                        </script>
                        
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Khmer Description</label>
                                <textarea class="form-control" rows="3" name="desKh" required>
                                    <?php echo $deskh; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>English Description</label>
                                <textarea class="form-control" rows="3" name="desEn" required>
                                    <?php echo $desen; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Product Information</label>
                                <textarea class="form-control" rows="3" name="desInfo">
                                    <?php echo $pinfor; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Address</label>
                                <textarea class="form-control" rows="3" name="address">
                                    <?php echo $paddress; ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Facebook</label>
                                <input class="form-control" name="facebook" 
                                value="<?php echo $pfacebook;?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Phone Number</label>
                                <input class="form-control" name="phone" 
                                value="<?php echo $pphone;?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Email Address</label>
                                <input class="form-control" name="gmail" 
                                value="<?php echo $pgmail;?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Location Address</label>
                                <input class="form-control" name="location" 
                                value="<?php echo 
                                $plocation;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-10">
                            <button type="submit" name='edit' class="btn btn-success">Submit Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>