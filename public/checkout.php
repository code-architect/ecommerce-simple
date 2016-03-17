<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<?php

//session_destroy();
echo $_SESSION['product_1'];
?>


<!-- Page Content -->
<div class="container">

    <!-- /.row -->

    <div class="row">
        <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
        <h1>Checkout</h1>

        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="edwindiaz123-facilitator@gmail.com">
            <input type="hidden" name="currency_code" value="US">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub-total</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Apple</td>
                    <td>&#36;12</td>
                    <td>2</td>
                    <td>&#36;24</td>
                    <td>
                        <a class='btn btn-warning' href="cart.php?remove="><span class='glyphicon glyphicon-minus'></span></a>
                        <a class='btn btn-success' href="cart.php?add="><span class='glyphicon glyphicon-plus'></span></a>
                        <a class='btn btn-danger' href="cart.php?delete="><span class='glyphicon glyphicon-remove'></span></a>
                    </td>
                <tr>
                </tbody>
            </table>
        </form>



        <!--  ***********CART TOTALS*************-->

        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount"></span>

                    </td>
                </tr>

                <tr class="shipping">
                    <th>Shipping and Handling</th>


                </tr>

                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">&#36;

</span></strong> </td>
                </tr>


                </tbody>

            </table>

        </div><!-- CART TOTALS-->


    </div><!--Main Content-->


</div>
<!-- /.container -->



<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
