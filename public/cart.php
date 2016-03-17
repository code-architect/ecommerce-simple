<?php
/**
 * Created by PhpStorm.
 * User: Code Architect
 */
require_once("../resources/config.php");

// Checking what kind of response is coming from get request
if(isset($_GET['add'])){

    // checking if the product exists
    $query = query("SELECT * FROm products WHERE product_id = ". escape_string($_GET['add']). " ");
    confirm($query);

    while($row = fetch_array($query))
    {
        // Checking if the product add limit is exceeding the product quantity
        if($row['product_quantity'] != $_SESSION['product_'.$_GET['add']])
        {
            $_SESSION['product_'.$_GET['add']] +=1;
            redirect('checkout.php');
        }
        else
        {
            // Printing default message if condition not satisfied
            set_message("We only have ".$row['product_quantity']." available ".$row['product_title']);
            redirect('checkout.php');
        }
    }

}

