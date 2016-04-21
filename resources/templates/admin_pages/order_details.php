<?php
    //fetching the get if from
    $id = escape_string($_GET['oid']);

    // checking if the order exists or not
    $order = check_order_exists($id);

    // if order exists proceed
    if($order == true){

    // get the details
    $row = get_order_details($id);

?>

<div class="container">
    <div class="row">
        <div class="col-xs-10">
            <div class="panel panel-primary">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Details of Order ID : <strong><?php echo $id; ?></strong>
                    </h2>
                </div>

                <!-- Showing User Details -->
                <?php foreach($row['users'] as $user){ ?>
                <div class="panel-body">
                    <strong>Buyer Name :</strong> <?php echo $user['user_firstname']." ".$user['user_lastname']; ?><br>
                    <strong>Username :</strong><?php echo $user['username']; ?><br>
                    <strong>Address : </strong>
                    <?php
                        echo $user['user_address'].",".$user['user_city']."<br>".
                             $user['user_state'].": ".$user['user_pincode']."<br>".
                             $user['user_country']."<br>";
                    ?>
                    <strong>Phone :</strong><?php echo $user['user_phone']."<br>"; ?>
                    <strong>Email :</strong><?php echo $user['user_email']; ?>
                    <strong></strong>

                </div>
                <?php } ?>
                <!-- End of User Details -->


                <ul class="list-group">

                    <li class="list-group-item">
                        <h4>Shipping Details</h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Product Category</th>
                                <th>Product Price</th>
                                <th>Bought Quantity</th>
                            </tr>
                            </thead>
                            <tbody>

                        <!-- Showing Product Details -->
                        <?php foreach($row['products'] as $pro){ ?>
                            <tr>
                                <td><?php echo $pro['product_title']; ?></td>
                                <td></td>
                                <td><img src="../../resources/uploads/<?php echo $pro['product_image']; ?>" height="70" width="70"></td>
                                <td><?php echo $pro['cat_title']; ?></td>
                                <td><?php echo $pro['product_price']; ?></td>
                                <td><?php echo $pro['product_quantity']; ?></td>
                            </tr>
                        <?php } ?>
                        <!-- End of Product Details -->

                            </tbody>
                        </table>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>

<?php
    }
    // if order do not exists then redirect
    else {
        redirect("index.php?orders");
    }

?>