<?php
    include ("authorization.php");
    include ("../models/admin.php");
    
    if(isset($_POST['submit'])){
        $code = $_POST['code'];
        $name = $_POST['name'];
        $province_code = $_POST['province'];

        $query = Products::insertDistrict($province_code,$code,$name);
        if($query){
            echo "";
        }else{
            echo "";
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
                        Manage District
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Manage District
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Province</label>
                                <select class="form-control" name="province">
                                    <option value="No Cateogry" style="display:none;">Selects Province</option>
                                    <?php 
                                        $province =  Products::selectProvince();
                                            foreach($province as $name){?>
                                                <option value="<?php echo $name['code'];?>">
                                                    <?php echo $name['province_name']; ?>
                                                </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>District Code</label>
                                <input class="form-control" name="code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>District Name</label>
                                <input class="form-control" name="name" required>
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
                                            <th>Code</th>
                                            <th>District</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $district =  Products::selectDistrict();
                                                foreach($district as $dis){
                                            ?>

                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $dis['code'];?></td>
                                                    <td><?php echo $dis['district_name'];?></td>
                                                    <td style="width:13%" >
                                                        <a href='' class="btn btn-primary">Edit</a>
                                                        <a style="z-index:0; margin-left:53px; margin-top:-35px;" href="" class="btn btn-danger">Delete</a>
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