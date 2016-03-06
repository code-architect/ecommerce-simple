<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
    <!-- Custom Login CSS -->
    <link href="css/login.css" rel="stylesheet">
<!-- Page Content -->
<div class="container">


<?php
// Login Logic

if(isset($_POST['submit'])){
    $username = escape_string($_POST['username']);
    $password = md5(escape_string($_POST['password']));

    login_user($username, $password);

    print_r($_SESSION);
}
?>


    <!-- Login Form -->

<div class = "container">
    <div class="wrapper">
        <form action="" method="post" name="Login_Form" class="form-signin">
            <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
            <hr class="colorgraph"><br>

            <input type="text" class="form-control" name="username" placeholder="Username" required="" autofocus="" />
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/>

            <button class="btn btn-lg btn-primary btn-block"  name="submit" value="Login" type="submit">Login</button>
        </form>
    </div>
</div>
    <!-- Login Form End -->


<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>