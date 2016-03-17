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
// Asking to reduce product quantity
elseif(isset($_GET['remove'])) {

    // reduce 1 from the cart
    $_SESSION['product_'.$_GET['remove']]--;

    // If there is nothing in the cart unset the session and redirect
    if($_SESSION['product_'.$_GET['remove']] < 1 )
    {
        unset( $_SESSION['product_'.$_GET['remove']]);
        redirect("checkout.php");
    }
    else
    {
        redirect("checkout.php");
    }

}
// Asking to delete product
elseif(isset($_GET['delete'])) {

    $_SESSION['product_'.$_GET['delete']] = '0';
    unset( $_SESSION['product_'.$_GET['delete']]);
    redirect("checkout.php");

}


function cart()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)) {

        $product = <<<DELEMITER

        <tr>
            <td>{$row['product_title']}</td>
            <td>&#36;{$row['product_price']}</td>
            <td>2</td>
            <td>&#36;24</td>
            <td>
                <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                <a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
            </td>
         <tr>
DELEMITER;

        echo $product;

    }


}

