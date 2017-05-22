<?php
    include ("authorization.php");
    include ("../models/admin.php");
    
    if(isset($_POST['submit'])){
        $pcode = $_POST['code'];
        $pname = $_POST['name'];
        $distric_code = $_POST['district'];

        $query = Products::insertCommune($distric_code,$pcode,$pname);
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
                        Manage Commune
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-table"></i> Manage Commune
                        </li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <form role="form" method="POST" enctype="multipart/form-data" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Districe</label>
                                <select class="form-control" name="district">
                                    <option value="No Cateogry" style="display:none;">Selects District</option>
                                    <?php 
                                        $District =  Products::selectDistrict();
                                            foreach($District as $name){?>
                                                <option value="<?php echo $name['code'];?>">
                                                    <?php echo $name['district_name']; ?>
                                                </option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Commune Code</label>
                                <input class="form-control" name="code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10">
                                <label>Commune Name</label>
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
                                            <th>Commune</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $Commune =  Products::selectCommune();
                                                foreach($Commune as $com){
                                            ?>

                                                <tr>
                                                    <td scope="row"><?php echo $i;?></td>
                                                    <td><?php echo $com['code'];?></td>
                                                    <td><?php echo $com['commune_name'];?></td>
                                                    <td style="width:13%" >
                                                        <a href='' class="btn btn-primary">Edit</a>
                                                        <a style="z-index:0; margin-left:53px; margin-top:-35px;" href=""class="btn btn-danger">Delete</a>
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