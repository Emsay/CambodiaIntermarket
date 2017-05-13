<?php
    include ("template/header.php");
    
    if(isset($_POST['btnSubmit'])){
        $user_id=1;
        $car_id = $_POST['car'];
        $departure = $_POST['departure'];
        $date_depart = $_POST['datedepart'];
        $destination = $_POST['destination'];
        $date_des = strtotime($_POST['datedes']);
        // $date_des = date('Y-m-d', strtotime($_POST['datedes']));
        $new_date = date('Y-m-d', $date_des);
        echo $new_date;
        $price = 10;
        // $query = Product::insertCarDetail($user_id,$car_id,$departure,$destination,$date_depart,$date_des,$price);
        // if($query){
        //     echo "";
        // }else{
        //     echo "";
        // }
    }
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
<style type="text/css">
    .btn-success{
        margin-top:10px;
    }
    .fa-calendar{
        float: right;
        margin-top: -43px !important;
        margin-right: 17px !important;
    }
</style>

<div class='register_account'>
    <div class='wrap' style="background: rgba(204, 204, 204, 0.2);">
        <div class='col-md-12'><h4 class='title'>Transportation</h4></div>
        <form method='POST' name="form">
            <div class='col-md-8'>
                <div>
                    <label>Car Type</label>
                    <select class="form-control" name="car">
                        <option value="No Cateogry" style="display:none;">Selects Car</option>
                        <?php 
                            $car =  Product::getCarCategory();
                                foreach($car as $carName){?>
                                    <option value="<?php echo $carName['id'];?>">
                                        <?php echo $carName['car_name']; ?>
                                    </option>
                        <?php }?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Departure</label>
                        <select class="form-control" name="departure">
                            <option value="No Cateogry" style="display:none;">Selects Departure</option>
                            <?php 
                                $province =  Product::getProvince();
                                    foreach($province as $p){?>
                                        <option value="<?php echo $p['id'];?>">
                                            <?php echo $p['province_name']; ?>
                                        </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="date">Date Departure</label>
                        <input class="form-control" id="date" name="datedepart" placeholder="M-D-Y" type="text"/>
                        <span class="fa fa-calendar"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Destination</label>
                        <select class="form-control" name="destination">
                            <option value="No Cateogry" style="display:none;">Selects Destination</option>
                            <?php 
                                $province =  Product::getProvince();
                                    foreach($province as $p){?>
                                        <option value="<?php echo $p['id'];?>">
                                            <?php echo $p['province_name']; ?>
                                        </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="control-label" for="date">Date Destination</label>
                        <input class="form-control" id="date" name="datedes" placeholder="M-D-Y" type="text"/>
                        <span class="fa fa-calendar"></span>
                    </div>
                </div>
                <div class='clear'></div>
                <button class='grey' type='submit' name='btnSubmit'>Submit</button>
            </div>
        </form>
        <div class="clear"></div>
        <div class="col-md-12">
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Car Type</th>
                        <th>Go To</th>
                        <th>Date Departure</th>
                        <th>Date Destination</th>
                        <th>Number of Date</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $u_id = 1;
                    $getCarDetail = Product::getCarDetail($u_id);
                    $numberdate = 4;
                    foreach($getCarDetail as $car){
                ?>
                    <tr>
                        <td><?=$car['car_name']; ?></td>
                        <td><?=$car['province_name']; ?></td>
                        <td><?=$car['date_departure']; ?></td>
                        <td><?=$car['date_destination']; ?></td>
                        <td><?=$numberdate;?></td>
                        <td><?=$car['prices']*4; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        
        <div class='clear'></div>
    </div>
</div>
<script>
    $(document).ready(function(){
      var date_input1=$('input[name="datedepart"]'); //our date input has the name "date"
      var date_input=$('input[name="datedes"]');
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input1.datepicker(options);
      date_input.datepicker(options);
    })
</script>
<?php
    include ('template/footer.php');
?>