<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK.DS."header.php"); ?>



<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

    <?php

//    if($_SERVER['REQUEST_URI'] == "/sand_box/ecommerce_simple/public/admin/" || "/sand_box/ecommerce_simple/public/admin/index.php" )
//    {
//        include(TEMPLATE_ADMIN.DS."admin_content.php");
//    }
    if($_SERVER['REQUEST_URI'] == "/sand_box/ecommerce_simple/public/admin/index.php" || $_SERVER['REQUEST_URI'] == "/sand_box/ecommerce_simple/public/admin/" )
    {
        include(TEMPLATE_ADMIN.DS."admin_content.php");
    }
    if(isset($_GET['orders']))
    {
        include(TEMPLATE_ADMIN.DS."orders.php");
    }
    ?>

</div>
<!-- /.container-fluid -->


<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>