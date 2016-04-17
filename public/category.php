<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
<!-- Page Content -->


<!-- Page Content -->
<div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Viewing Items From Category: <?php  echo get_category_name_by_id($_GET['id']); ?>
            </h1>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- Categories here -->
        <?php include(TEMPLATE_FRONT.DS."side_nav.php"); ?>


        <div class="col-md-9">


            <div class="row">

                <?php echo get_products_by_category(escape_string($_GET['id'])); ?>

            </div> <!-- end of row --->

        </div>

    </div>

</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
