<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
<!-- Page Content -->

<?php
//checkLogin();
//localhost/sand_box/ecommerce_simple/public/thankyou.php?tx=JK025GY8OIP789AS2&st=Completed&amt=345%2e90&cc=USD&cm=item_number=
if(isset($_SESSION['username']) && isset($_SESSION['user_email'])) {

    if ( isset($_GET['tx']) && (isset($_GET['st'])) ) {

        // These are the get request passed from paypal
        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];

        $buyer = escape_string($_SESSION['user_email']);


        $check_paypal_id = get_paypal_id($transaction);

        // checking id transaction is completed
        if($_GET['st'] == "Completed" && $check_paypal_id == false)
        {
            // unique order id
            $order_shop_id = str_shuffle(time().$transaction);
            $_SESSION['order_shop_id'] = $order_shop_id;

            $query = query("INSERT INTO orders (user_email, order_shop_id, order_amount, order_tx, order_status, order_currency)
                            VALUES ('{$buyer}', '{$order_shop_id}', '{$amount}', '{$transaction}', '{$status}', '{$currency}')");
            confirm($query);

            process_transaction($_SESSION['order_shop_id']);
        }


    } else {
        redirect("index.php");
    }
} else {
    redirect("index.php");
}

?>
    <!-- Page Content -->
    <div class="container">


        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">

            <h1>Thank you, for shopping</h1>
            <br>
            <br>

            <p><b>Your Used Email ID:                   </b><?php echo $buyer; ?></p>
            <p><b>Your Product Order Id:                </b><?php echo $_SESSION['order_shop_id']; ?></p>
            <p><b>Paid Amount:                          </b><?php echo $amount; ?></p>
            <p><b>Your PayPal Transaction Id:           </b><?php echo $transaction; ?></p>
            <p><b>Your Transaction Currency in PayPal:  </b><?php echo $currency; ?></p>
            <p><b>Your PayPal Transaction Status:       </b><?php echo $status; ?></p>
            <br>
            <br>
            <p>Thank You. For Shopping on our Web Site. To keep on shopping Click on the button below</p>

            <p><a href="index.php" class="btn btn-primary btn-large">Keep On Shopping!</a>
            </p>
        </header>

        <?php
            // releasing the keys except given value in the session
            $keys = ['username', 'user_email', 'order_shop_id'];
            unsetExcept($keys);
            unset($_GET);


        ?>
        <hr>
        <!-- /Jumbotron Header -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

