<?php
    include ("authorization.php");
    include ('../models/admin.php');

    $postSuceess="";
    $codeErr="";

    if(isset($_POST['post'])){
        $img = $_POST['img_url'];
        $type = basename($_FILES['img']['type']);
        $image = basename($_FILES['img']['name']);
        if($type != "png" && $type != "jpg" && $type != "jpeg"){
            echo "This file not respond because it is not file image.";
            $yes = 0;
        }else{
            $to = "../uploads/".$_FILES['img']['name'];
            echo "Hello path :".$to;
            move_uploaded_file($_FILES['img']['tmp_name'],$to);
            $insert_adv = Products::insertadv($img,$image);
            $postSuceess="You have successfull add advertisment...!.";
            $yes=1;
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
                        Manage Advertisment
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> ManageAdvertisment
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-4">
                         <div class="form-group">
                            <div class="col-xs-10">
                                <label>Image URL</label>
                                <input class="form-control" name="img_url" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="img" id='uploader' required><br />
                                <img id='placeholder' style="width:200px;">
                                <p class="success"><?php echo $postSuceess;?></p>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#placeholder').previewImage( {uploader: '#uploader'});
                        </script>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="post" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="table-container" class="table-responsive">
                                <table id="maintable" class="table table-bordered table-hover table-striped">
                                    <thead >
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Image URL</th>
                                            <th style="width:20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $adv =  Products::getAdv();
                                                foreach($adv as $ad){?>
                                                <tr>
                                                    <td scope="row"><?php echo $ad['adv_id'];?></td>
                                                    <td><?php echo "<img style='width:100px' src='../uploads/".$ad['images']."'/>"?></td>
                                                    <td><?php echo $ad['images_url'];?></td>
                                                    <td style="width:13%" >
                                                        <a style="z-index:0;" href='edite_adv.php?id=<?php echo $ad['adv_id'];?>' class="btn btn-success">Edit</a>
                                                        <a style="z-index:0;" href="delete_adv.php?id=<?php echo $ad['adv_id'];?>" onclick="return confirm('You want to delete slide?')" class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php }?>
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