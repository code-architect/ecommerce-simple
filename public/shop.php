<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
<!-- Page Content -->



    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome To Our Shop!</h1>
            <p>Lorem ipsum dolor sit amet, ugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header> -->

        <hr>


        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php echo get_products(); ?>

        </div>
        <!-- /.row -->

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
