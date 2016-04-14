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
            set_message("We only have ".$row['product_quantity']." ".$row['product_title']." available.");
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
        unset($_SESSION['total_price']);
        unset($_SESSION['total_products']);
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
    unset($_SESSION['total_price']);
    unset($_SESSION['total_products']);
    redirect("checkout.php");

}


function cart(){

    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;

    $total_products = 0;
    $total_price = 0;

    // looping throw SESSION
    foreach ($_SESSION as $name => $value) {

        // if there is product in the curt show it
        if ($value > 0) {

            // making sure that we are looping throw the right session
            if (substr($name, 0, 8) == "product_") {

                // getting the length of the string minus "product_"
                $length = strlen($name-8);

                // id of the product from session
                $id = substr($name, 8,$length);


                $query = query("SELECT * FROM products WHERE product_id = ".$id);
                confirm($query);

                while ($row = fetch_array($query)) {

                    // subtotal of the product
                    $sub = $row['product_price'] * $value;

                    $product = <<<DELEMITER

        <tr>
            <td><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></td>
            <td><a href="item.php?id={$row['product_id']}"><img height="42" width="42" src="../resources/uploads/{$row['product_image']}"></a></td>
            <td>&#36;{$row['product_price']}</td>
            <td>{$value}</td>
            <td>&#36;{$sub}</td>
            <td>
                <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                <a class='btn btn-success' href="cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
                <a class='btn btn-danger' href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
            </td>
         <tr>

          <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
          <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
          <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
          <input type="hidden" name="quantity_{$quantity}" value="{$value}">
DELEMITER;

                    echo $product;

                    $item_name++;
                    $item_number++;
                    $amount++;
                    $quantity++;


                    $_SESSION['total_price'] = $total_price += $sub;
                    $_SESSION['total_products'] = $total_products += $value;
                }
            }
        }
    }


}


