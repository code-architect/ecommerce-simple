<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>
    <!-- Custom Login CSS -->
    <link href="css/login.css" rel="stylesheet">
<!-- Page Content -->
<div class="container">


<?php
// Login Logic
if(!isset($_SESSION['username'])){

if(isset($_POST['submit'])){
    $username = escape_string($_POST['username']);
    $password = md5(escape_string($_POST['password']));

    login_user($username, $password);
}
?>


    <!-- Login Form -->
    <h2 class="text-center bg-warning"><?php display_message(); ?></h2>
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
<?php display_message(); ?>
    <!-- Login Form End -->

<?php } elseif(isset($_SESSION['username']) && $_SESSION['username'] == "admin") {
    redirect("admin");
} elseif(isset($_SESSION['username'])) {
    redirect("shop.php");
}
?>

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>