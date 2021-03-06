<?php
    include ("authorization.php");
    include ('../models/admin.php');

    $postSuceess="";
    $codeErr="";

    if(isset($_POST['post'])){
        $description = $_POST['desc'];
        $type = basename($_FILES['images']['type']);
        $image = basename($_FILES['images']['name']);
        $yes = 1;
        
        if($type != "png" && $type != "jpg" && $type != "jpeg"){
            echo "This file not respond because it is not file image.";
            $yes = 0;
        }else{
            $to = "../uploads/".$_FILES['images']['name'];
            echo "Hello path :".$to;
            move_uploaded_file($_FILES['images']['tmp_name'],$to);
            $insert_adv = Products::insertadv($description,$image);
            $postSuceess ="You have successfull added Advertise";
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
                        Manage Advertise
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> ManageAdvertise
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
                                <textarea class="form-control" rows="3" name="desc"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Selects Image</label>
                                <input type='file' name="images" id='uploader' required><br />
                                <img id='placeholder' style="width:200px;">
                                <p class="success"><?php echo $postSuceess;?></p>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $('#placeholder').previewImage( {uploader: '#uploader'});
                        </script>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <button type="submit" name="post" class="btn btn-success">Submit Post</button>
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
                                            $slides =  Products::getAdv();
                                                $i=1;
                                                foreach($slides as $s){?>
                                                   
                                                <tr>
                                                    <td scope="row"><?php echo $i ;?></td>
                                                    <td><?php echo "<img style='width:100px' src='../uploads/".$s['image']."'/>"?></td>
                                                    <td><?php echo $s['images_url'];?></td>
                                                    <td style="width:13%" >
                                                        <a style="z-index:0;" href='edite_slide.php?id=<?php echo $s['id'];?>' class="btn btn-success">Edit</a>
                                                        <a style="z-index:0;" href="delete_slide.php?id=<?php echo $s['id'];?>" onclick="return confirm('You want to delete slide?')" class="btn btn-danger">Delete</a>
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