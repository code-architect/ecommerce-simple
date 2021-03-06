<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php

//session_destroy();

// If logged in
if(isset($_SESSION['username']) && isset($_SESSION['user_email'])){
?>


<!-- Page Content -->
<div class="container">

    <!-- /.row -->

    <div class="row">
        <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
        <h1>Checkout</h1>

        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="jaindoe@xyz.com">
            <input type="hidden" name="currency_code" value="US">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub-total</th>

                </tr>
                </thead>
                <tbody>
                    <?php cart(); ?>
                </tbody>
            </table>
            <?php
                if(isset($_SESSION['total_products']) && ($_SESSION['total_products'] != '0')){
            ?>

            <input type="image" name="upload"
                   src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                   alt="PayPal - The safer, easier way to pay online">

            <?php } else { echo "Your Basket Is empty"; } ?>
        </form>



        <!--  ***********CART TOTALS*************-->

        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount"></span>
                <?php
                    echo isset($_SESSION['total_products']) ? $_SESSION['total_products'] : $_SESSION['total_products'] = 0;
                ?>
                    </td>
                </tr>

                <tr class="shipping">
                    <th>Shipping and Handling</th>
                <?php
                    if(isset($_SESSION['total_price'])){
                        echo ($_SESSION['total_price'] > 100 || $_SESSION['total_price'] == 100) ? "<td>Free Shipping</td>" : "<td>No Free Shipping</td>";
                    }
                ?>

                </tr>

                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">&#36;
                <?php
                    echo isset($_SESSION['total_price']) ? $_SESSION['total_price'] : $_SESSION['total_price'] = 0;
                ?>
</span></strong> </td>
                </tr>


                </tbody>

            </table>

        </div><!-- CART TOTALS-->

    </div><!--Main Content-->



    <!-- ***************************************************************************************** -->
    <!-- If user not logged in -->
    <?php } else { ?>
        <div class="container">

        <div class="row">
            <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
            <h1>Checkout</h1>

            <form action="login.php" method="post">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php cart(); ?>
                    </tbody>
                </table>

                <?php if(isset($_SESSION['total_products'])){ ?>

                    <input type="submit" class="btn btn-primary btn-lg" value="Check Out">

                <?php } else { echo "Your Basket Is empty"; } ?>


            </form>
        </div><!--Main Content-->

    </div>

    <?php } ?>
    <!-- ***************************************************************************************** -->



</div>
<!-- /.container -->



<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
