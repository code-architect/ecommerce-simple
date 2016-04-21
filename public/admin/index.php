<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK.DS."header.php"); ?>

<?php
//check if user is admin or not
checkAdmin();
?>

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Admin Dashboard <small>Welcome Admin</small>
        </h1>
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

    elseif(isset($_GET['orders']))                              // Order summery page
    {
        include(TEMPLATE_ADMIN.DS."orders.php");
    }

    elseif(isset($_GET['products']))                         // View Products Page
    {
        include(TEMPLATE_ADMIN.DS."products.php");
    }

    elseif(isset($_GET['add_product']))                         // Add Products Page
    {
        include(TEMPLATE_ADMIN.DS."add_product.php");
    }

    elseif(isset($_GET['edit_product']))                         // Edit Products Page
    {
        include(TEMPLATE_ADMIN.DS."edit_product.php");
    }

    elseif(isset($_GET['categories']))                         // categories page
    {
        include(TEMPLATE_ADMIN.DS."categories.php");
    }

    elseif(isset($_GET['order_details']))                                 // The order details page view_product
    {
        include(TEMPLATE_ADMIN.DS."order_details.php");
    }

    else
    {
        include(TEMPLATE_ADMIN.DS."admin_content.php");
    }
    ?>

</div>
<!-- /.container-fluid -->


<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>