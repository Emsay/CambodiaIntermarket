<?php
    include ("import.php");
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="..\">CIM Admin</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php        
                if(isset($_SESSION['login_user'])=='Undefined'){
                    echo "<i class='fa fa-user'></i> ".$_SESSION['login_user']."<b class='caret'></b>";
                }
            ?>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="shop_category.php"><i class="fa fa-fw fa-bar-chart-o"></i> Shop Category</a>
            </li>
            <li>
                <a href="manage_shop.php"><i class="fa fa-fw fa-bar-chart-o"></i> Manage Shop</a>
            </li>
            <li>
                <a href="manage_category.php"><i class="fa fa-fw fa-edit"></i> Manage Category</a>
            </li>
            <li>
                <a href="car_category.php"><i class="fa fa-fw fa-edit"></i>Manage Car</a>
            </li>
            <li>
                <a href="manage_post.php"><i class="fa fa-fw fa-bar-chart-o"></i> Manage Product</a>
            </li>
            <li>
                <a href="listproducts.php"><i class="fa fa-fw fa-table"></i> List Products</a>
            </li>
            <li>
                <a href="manage_slide.php"><i class="fa fa-fw fa-table"></i> Manage SlideShow</a>
            </li>
            <li>
                <a href="send_mail.php"><i class="fa fa-fw fa-table"></i> Send Email</a>
            </li>
            <li>
                <a href="province.php"><i class="fa fa-fw fa-table"></i>Manage Province</a>
            </li>
            <li>
                <a href="district.php"><i class="fa fa-fw fa-table"></i>Manage District</a>
            </li>
            <li>
                <a href="commune.php"><i class="fa fa-fw fa-table"></i>Manage Commune</a>
            </li>
        </ul>
    </div>
</nav>
