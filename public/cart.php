<?php
/**
 * Created by PhpStorm.
 * User: Code Architect
 */
require_once("../resources/config.php");

// Checking what kind of response is coming from get request
if(isset($_GET['add'])){

    $_SESSION['product_'.escape_string($_GET['add'])] +=1;
    redirect('checkout.php');

}