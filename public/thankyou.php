<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
<!-- Page Content -->

<?php
checkLogin();
if(isset($_GET['tx'])){

    // These are the get request passed from paypal
    $amount = $_GET['amt'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];


} else {
    redirect("index.php");
}

?>
    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Thank You. For Shopping on our Web Site. To keep on shopping Click on the button below</p>
            <p><a href="index.php" class="btn btn-primary btn-large">Keep On Shopping!</a>
            </p>
        </header>

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
