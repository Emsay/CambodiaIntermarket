<?php
    include ("template/header.php");
    
    if(isset($_POST['btnSubmit'])){
        $user_id=1;
        $car_id = $_POST['car'];
        $departure = $_POST['departure'];   
        $destination = $_POST['destination'];

        $date_depart = strtotime($_POST['datedepart']);
        $date_des = strtotime($_POST['datedes']);

        $new_date_depart = date('Y-m-d', $date_depart);
        $new_date_des = date('Y-m-d', $date_des);
        
        $query = Product::insertCarDetail($user_id,$car_id,$departure,$destination,$new_date_depart,$new_date_des);
        if($query){
            echo "yes";
        }else{
            echo "no";
        }
    }
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="resources/css/bootstrap-datetimepicker.css">
<script src="resources/js/bootstrap-datetimepicker.min.js"></script>
<link href='resources/css/mystyles.css' rel='stylesheet' type='text/css' media='all' />
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
<style type="text/css">
    .btn-success{
        margin-top:10px;
    }
    .fa-calendar{
        float: right;
        margin-top: -43px !important;
        margin-right: 17px !important;
    }
    .control-label{
        padding-top:10px;
        padding-bottom: 10px;
    }
    .grey{
        font-family: Arial !important; 
    }
    .grey:hover{
        background-color: #fff !important;
        color:#000 !important;
    }
</style>

<div class='register_accounts'>
    <div class='wrap'>
    <hr style="border:1px solid #eee;">
        <form method='POST' name="form">
            <div class='col-md-6' style="background: #00ADC9; color: #fff; padding: 17px;}">
                <div class='col-md-12'><h4 class='title' style="color:#fff;">TRANSPORTATION</h4></div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="control-label">Car Type</label>
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
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label">Departure</label>
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
                        <!-- <span class="fa fa-calendar"></span> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="control-label">Destination</label>
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
                        <!-- <span class="fa fa-calendar"></span> -->
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <div class='clear'></div>
                        <button class='grey' type='submit' name='btnSubmit'>Submit</button>
                    </div>
                </div>
            </div>
        </form>
        
        <div class="clear"></div>
        <!-- <hr style="border:1px solid #eee;"> -->
        <div class="col-md-12">
            
            <table class="table">
                <thead>
                    <tr style=" color: #00ACD9;">
                        <th>CAR TYPE</th>
                        <th>GO TO</th>
                        <th style="text-align: center;">DATE DEPARTURE</th>
                        <th style="text-align: center;">DATE DESTINATION</th>
                        <th style="text-align: center;">AMOUNT OF DATE</th>
                        <th style="text-align: center;">PRICE($)</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $u_id = 1;
                    $getCarDetail = Product::getCarDetail($u_id);

                    foreach($getCarDetail as $car){

                        $date_depart = strtotime($car['date_departure']);
                        $new_date_depart = date('d-M-Y', $date_depart);
                        $dateDepart = date('d',strtotime($new_date_depart));

                        $date_des = strtotime($car['date_destination']);
                        $new_date_des = date('d-M-Y', $date_des);
                        $dateDestina = date('d',strtotime($new_date_des));

                        $totalDate = ($dateDestina-$dateDepart)+1;
                ?>
                    <tr>
                        <td><?php echo $car['car_name']; ?></td>
                        <td><?=$car['province_name']; ?></td>
                        <td style="text-align: center;"><?=$new_date_depart; ?></td>
                        <td style="text-align: center;"><?=$new_date_des; ?></td>
                        <td style="text-align: center;"><?=$totalDate;?> day</td>
                        <td style="text-align: center;">$ <?=$car['prices']*$totalDate; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        
        <div class='clear'></div>
    </div>
</div>

<?php
    include ('template/footer.php');
?>