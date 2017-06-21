<?php
    ob_start();
    include ('template/header.php');
    include ('../models/users.php');

    $emailErr='';
    $regisErr = '';

    if(isset($_POST['btnSubmit'])){
        //session_start();
        $name = $_POST['name'];
        $company_name = $_POST['company_name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $password = md5($_POST['pass']);
        $phone = $_POST['phone'];
        $role = "user";
        $date_time = date("Y/m/d H:i:s");

        $email_validate = User::ValidateEmail($email);
        if($email_validate){
            $emailErr = "";
        }else{
            $emailErr = "Email not valid formart";
        }

        $checkMail = User::checkEmail($email);
        if($checkMail=='already'){
            $emailErr = "Email has already registered.";
        }else{
            echo "";
        }

        if($email_validate && $checkMail!='already')
        {
            $insert_users = User::insert($name,$company_name,$address,$email,$password,$phone,$role,$date_time);
            //echo "You have been registered!";
            $userID = User::getUserid($email);
            $row = mysqli_fetch_array($userID);
            if($row){
                $userid = $row['userid'];
            }
            $mycart = User::insertcart($userid);
            header ("location:".URL."views/login.php");
        }else{
            $regisErr = "Register not success!";
        }
        
    }
    error_reporting(0);
    if(isset($_POST['clientSub'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pro = $_POST['province'];
        $dis = $_POST['district'];
        $com = $_POST['commune'];
        $date_time = date("Y/m/d H:i:s"); 
        $insertClient = User::insertUserClient($name,$email,$pro,$dis,$com,$date_time);
    }
?>
<head>
    <style type="text/css">
        .error {color: #FF0000;font-size: 28px;}
        .errorEmail{color:#ff0000;}
        body, button{
            font-family: Arial !important;
        }
        input, select, option{
            font-family: Arial !important;
            font-size: 16px !important;
        }
        h4{
            font-family: Arial;
        }
    </style>
</head>
<div class='register_account'>
    <div class='wrap' style="background: rgba(204, 204, 204, 0.2);">
        <div class='col-md-6'>
            <h4 class='title'>Enterprise or Company</h4>
            <form method='POST' name="form">
                <p class="errorEmail"><?php echo $regisErr;?></p>
                <div>
                    <input type='text' name='name' value='' placeholder='<?php echo _t_name;?>' required>
                    <span class="error">*</span></div>
                <div>
                    <input type='text' name='company_name' value='' placeholder='<?php echo _t_companyname;?>' >
                    <span class="error">*</span></div>
                <div>
                    <input type='text' name='address' value='' placeholder='<?php echo _t_address;?>' >
                    <span class="error">*</span></div>
                <div>
                    <p class="errorEmail"><?php echo $emailErr;?></p>
                    <input type='text' name='email' value='' placeholder='<?php echo _t_email;?>' required>
                    <span class="error">*</span>
                </div>
                <div>
                    <input type='password' name='pass' value='' placeholder='<?php echo _t_pass;?>' required>
                    <span class="error">*</span></div>
                <div>
                    <input type='text' name='phone' value='' placeholder='<?php echo _t_phonenum;?>' required>
                    <span class="error">*</span></div>
                <div class='clear'></div>
                <button class='grey' type='submit' name='btnSubmit' ><?php echo _t_signup;?></button>
            </form>
        </div>
        <div class='col-md-6'>
            <h4 class='title'>Client</h4>
            <form method='post' name="form">
                <div class="form-group">
                    <label>User Name</label>
                    <input class="form-control" type='text' name='name' value='' placeholder='Name' required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type='email' name='email' value='' placeholder='Email' required style="width:91%">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <div class="province">
                        <select class="form-control" id="txtProvince" name="province">
                            <option value="" style="display: none;">Select Province</option>
                            <?php
                            $provin =  Product::selectProvince();
                                foreach($provin as $provinces){?>
                                <option value="<?php echo $provinces['id'];?>">
                                    <?php echo $provinces['province_name']; ?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    <div id="showDistrict">
                        <select class="form-control" id="txtDistrict" name="district">
                            <option value="" style="display: none;">Selects District</option>
                        </select>
                    </div>
                    <div id="showCommune">
                        <select class="form-control" name="commune">
                            <option value="" style="display:none;">Selects Commune</option>
                        </select>
                    </div>
                </div>
                <div class='clear'></div>
                <button class='grey' type='submit' name='clientSub'>Sing Up</button>
            </form>
        </div>
            
        <div class='clear'></div>
    </div>
</div>
<script>
    $(function(){
        $("#txtProvince").change(function(){
            var id =$(this).val();
            $.get("../models/products.php?provinceID="+id, function(data, status){
                $('#showDistrict').html(data);
            });
        });
        $(document).on('change', "#txtDistrict",function () {
            var idDis =$(this).val(); 
            $.get("../models/products.php?districtID="+idDis, function(data, status){
                $('#showCommune').html(data);
            });
        });
    });
</script>
<?php
    include ('template/footer.php');
?>