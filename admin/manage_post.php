<?php
    include ("authorization.php");
    include ('../models/admin.php');

    $postSuceess="";
    $codeErr="";

    if(isset($_POST['post'])){
        /*$pname = $_POST['name'];
        $pdis = $_POST['discount'];
        $pdate_discount = strtotime($_POST['datedisc']);
        $paddress = $_POST['address'];
        $pfacebook = $_POST['facebook'];
        $pphone = $_POST['phone'];
        $pgmail = $_POST['gmail'];
        $type = basename($_FILES['image']['type']);
        $pimage = basename($_FILES['image']['name']);
        $date = date("Y/m/d H:i:s");
        $yes = 1;

        $new_date_discount = date('Y-m-d', $pdate_discount);
        // $checkCode = Products::checkCode($pcode);
        // if($checkCode=='already'){
        //     $codeErr = "Product Code has already added.";
        // }else{
        //     echo "";
        // }

        if($type != "png" && $type != "jpg" && $type != "jpeg"){
            echo "This file not respond because it is not file image.";
            $yes = 0;
        }else{
            $to = "../uploads/".$_FILES['image']['name'];
            // echo "Hello path ".$to;
            move_uploaded_file($_FILES['image']['tmp_name'],$to);
            $insert_product = Products::insert($pname, $pdis, $pimage, $date, $paddress, $pfacebook, $pphone, $pgmail, $new_date_discount);
            $postSuceess="You have successfull post product.";
            $yes=1;
        }*/
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
                        Manage Product Discount
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> ManageProduct
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Shop Name</label>
                                <input class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Discount</label>
                                <input class="form-control" name="discount" required>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <label class="control-label" for="date">Date Discount</label>
                            <input class="form-control" id="date" name="datedisc" placeholder="M-D-Y" type="text"/>
                            <!-- <span class="fa fa-calendar"></span> -->
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-xs-10">
                                <label>Select Post</label>
                                <select class="form-control" name="location">
                                    <option value="">Product Categories</option>
                                    <option value="1">Shop Information</option>
                                </select>
                            </div>
                        </div> -->
                       <!--  <div class="form-group">
                            <div class="col-xs-10">
                                <input name="stock" type="radio" value="In stock">
                                <label>In stock</label><br/>
                                <input name="stock" type="radio" value="In stock usually within 2 weeks after order">
                                <label>In stock usually within 2 weeks after order</label>
                            </div>
                        </div> -->
                      <!--   <div class="form-group">
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
                        </div> -->
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="image" id='uploader' required><br />
                                <img id='placeholder' style="width:200px;">
                                <p class="success"><?php echo $postSuceess;?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Select Gallery:</label>
                                <input type="file" name="files[]" multiple="multiple" id="mulit_images" />
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
                            <div class="col-xs-10" style="margin-top:20px;">
                                <button type="submit" name="post" class="btn btn-success">Submit Post</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
    if(isset($_POST['post'])){
        $pname = $_POST['name'];
        $pdis = $_POST['discount'];
        $pdate_discount = strtotime($_POST['datedisc']);
        $paddress = $_POST['address'];
        $pfacebook = $_POST['facebook'];
        $pphone = $_POST['phone'];
        $pgmail = $_POST['gmail'];
        $type = basename($_FILES['image']['type']);
        $pimage = basename($_FILES['image']['name']);
        $date = date("Y/m/d H:i:s");
        $yes = 1;
        $new_date_discount = date('Y-m-d', $pdate_discount);

        if(isset($_FILES['files'])){
            $errors = array();
            $uploadedFiles = array();
            $extension = array("jpeg","jpg","png","gif","JPG","PNG");
            $bytes = 1024;
            $KB = 1024;
            $totalBytes = $bytes * $KB;
            $UploadFolder = "../uploads";
             
            $counter = 0;
            $ext = pathinfo($pimage, PATHINFO_EXTENSION);
            if(in_array($ext,$extension) == false){
                echo "File invalid";
            }else{
                $to = "../uploads/".$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],$to);
                $insert_product = Products::insert($pname, $pdis, $pimage, $date, $paddress, $pfacebook, $pphone, $pgmail, $new_date_discount);
                $postSuceess="You have successfull post product.";
            }
            

            foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
                $temp = $_FILES["files"]["tmp_name"][$key];
                $name = $_FILES["files"]["name"][$key];
                 
                if(empty($temp))
                {
                    break;
                }
                 
                $counter++;
                $UploadOk = true;
                 
                /*if($_FILES["files"]["size"][$key] > $totalBytes)
                {
                    $UploadOk = false;
                    array_push($errors, $name." file size is larger than the 1 MB.");
                }
                 
                $ext = pathinfo($name, PATHINFO_EXTENSION);
                if(in_array($ext, $extension) == false){
                    $UploadOk = false;
                    array_push($errors, $name." is invalid file type.");
                }*/

                if($UploadOk == true){
                    move_uploaded_file($temp,$UploadFolder."/".$name);
                    $id = mysql_insert_id();
                    $sql=Products::insertMultiImg($id,$name);
                    array_push($uploadedFiles, $name);
                }
            }


            /*if($counter>0){
                if(count($errors)>0)
                {
                    echo "<b>Errors:</b>";
                    echo "<br/><ul>";
                    foreach($errors as $error)
                    {
                        echo "<li>".$error."</li>";
                    }
                    echo "</ul><br/>";
                }
                 
                if(count($uploadedFiles)>0){
                    echo "<b>Uploaded Files:</b>";
                    echo "<br/><ul>";
                    foreach($uploadedFiles as $fileName)
                    {
                        echo "<li>".$fileName."</li>";
                    }
                    echo "</ul><br/>";
                     
                    echo count($uploadedFiles)." file(s) are successfully uploaded.";
                }                               
            }else{
                echo "Please, Select file(s) to upload.";
            }*/
        }
    }
?>