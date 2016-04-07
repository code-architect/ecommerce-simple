<?php
/**
 * Created by PhpStorm.
 * User: Code-Architect
 */





/*************************************************************************/
/*****************           Helper Functions         *******************/
/*************************************************************************/


/**
 * @work Set respond text|message to session
 * @param $msg String
 */
function set_message($msg){

    if(!empty($msg)){
        $_SESSION['message'] = $msg;

    }else{
        $msg = '';
    }
}



//-----------------------------------------------------------------------//


/**
 * @work Display $_SESSION['message'] then unset it
 */
function display_message(){

    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


//-----------------------------------------------------------------------//


/**
 * @work Redirect the user
 * @param $location | name of the file
 */
function redirect($location){
    header("Location: $location");
}


//-----------------------------------------------------------------------//


/**
 * @work executes and return the given sql query
 * @param $sql | SQl Query
 * @return bool|mysqli_result
 */
function query($sql)
{
    global $conn;
    return mysqli_query($conn, $sql);
}

//-----------------------------------------------------------------------//


/**
 * @work if query failed return feed back
 * @param $result
 */
function confirm($result)
{
    global $conn;
    if(!$result){
        die("Query failed". mysqli_error($conn));
    }
}


//-----------------------------------------------------------------------//


/**
 * @work Escapes special characters in a string for use in an SQL statement
 * @param $string | string to be cleared
 * @return string | returning clear string
 */
function escape_string($string)
{
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}


//-----------------------------------------------------------------------//


function fetch_array($result)
{
    return mysqli_fetch_array($result);
}



/*************************************************************************/
/*****************           Product Functions         *******************/
/*************************************************************************/


/**
 * @work Get product thumbnails details
 * @param string $type DESC|default(ASC)
 */

function get_products($type = 'ASC')
{
    $query = query("SELECT * FROM products WHERE product_quantity > 0 ORDER BY product_id $type");
    confirm($query);

    while($row = fetch_array($query)){

        $product = <<<DELEMITER

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}"></a>
                            <div class="caption">
                                <h4 class="pull-right">&#8377;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['product_short_desc']}</p>

                                <a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                            </div>

                        </div>
                    </div>
DELEMITER;

        echo $product;

    }
}


//-----------------------------------------------------------------------//


/**
 * @work Getting categories dynamically
 */
function get_categories()
{
    $result = query(escape_string("SELECT * FROM categories"));
    confirm($result);

    while($row = fetch_array($result))
    {
        echo "<a href='category.php?id=".$row['cat_id']."' class='list-group-item'>".$row['cat_title']."</a>";
    }

}


//-----------------------------------------------------------------------//

/**
 * @work Getting categories by id dynamically
 * @param $id S_GET id
 */

function get_products_by_category($id)
{
    $query = query("SELECT * FROM products WHERE product_category_id = $id and product_quantity > 0");
    $get_num_rows = mysqli_num_rows($query);
    confirm($query);

    // If query returns rows, only then execute this else redirect user
    if($get_num_rows) {

        while ($row = fetch_array($query)) {

            /* $product = <<<DELEMITER

                          <div class="col-md-3 col-sm-6 hero-feature">
                             <div class="thumbnail">
                                 <img src="{$row['product_image']}" alt="">
                                 <div class="caption">
                                     <h3>{$row['product_title']}</h3>
                                     <p>{$row['product_short_desc']}</p>
                                     <p>
                                       <a href="cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a>
                                       <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                     </p>
                                 </div>
                             </div>
                         </div>
     DELEMITER;*/

            $product = <<<DELEMITER

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}"></a>
                            <div class="caption">
                                <h4 class="pull-right">&#8377;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['product_short_desc']}</p>
                                <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                <a class="btn btn-primary" target="_blank" href="cart.php?add={$row['product_id']}">Add To Cart</a>
                            </div>

                        </div>
                    </div>
DELEMITER;
            echo $product;

        }
    }else{
        redirect('index.php');
    }
}





//-----------------------------------------------------------------------//

/**
 * @work If somebody enters here with out proper Get value
 * @param $value $_GEt[value]
 */
function redirect_if_not_valid($value)
{
    if ($_GET[$value] == 0 || $_GET[$value] == '' || $_GET[$value] == NULL) {
        redirect('index.php');
    }
}




//-----------------------------------------------------------------------//

/**
 * @work unset session except given value in array
 * @param $keys array
 */
function unsetExcept($keys) {
    foreach ($_SESSION as $key => $value)
        if (!in_array($key, $keys))
            unset($_SESSION[$key]);
}



/*************************************************************************/
/*****************          Back End Functions         *******************/
/*************************************************************************/

/**
 * @work user login
 * @param $username Username
 * @param $password Password (encrypted)
 */
function login_user($username, $password)
{
    $query = query("SELECT * FROM users WHERE username = '$username' AND user_password = '$password' LIMIT 1");
    confirm($query);


    if(mysqli_num_rows($query) == 0)
    {
        set_message("Your Password or Username is not correct!!!");
        redirect("login.php");
    }else{
        $row = fetch_array($query);
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_email'] = $row['user_email'];

        if($_SESSION['username'] == "admin") {
            redirect("admin");
        }else{
            redirect("checkout.php");
        }
    }
}



//-----------------------------------------------------------------------//



function send_message()
{
    if(isset($_POST['submit'])){

        $to = "xyz@abc.com";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $headers = "From: {$name} {$email}";

        $result = mail($to, $phone, $message, $headers);

        if(!$result){
            set_message("ERROR!! Sorry we could not send your message!");
        }else{
            set_message("Your message has been sent");
        }
    }
}



//-----------------------------------------------------------------------//


/**
 * @work checking if user logged in
 */
function checkLogin($location)
{
    if($_SESSION['username'] == "" && $_SESSION['user_email'] == ""){
        redirect($location);
    }
}




/*************************************************************************/
/*****************             Admin Functions         *******************/
/*************************************************************************/


/**
 * @work if not admin do not allow
 */
function checkAdmin(){
    if($_SESSION['username'] != "admin"){
        redirect("../login.php");
    }
}



//----------------------------------------------------------------------------//


/**
 * @work: Generate and store purchased products in reports table
 * @param $order_shop_id
 */
function process_transaction($order_shop_id){

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

                    $sql = query("INSERT INTO reports (product_id, order_shop_id, product_quanity_price, product_quantity)
                                  VALUES ('{$id}','{$order_shop_id}','{$sub}', '{$value}')");
                    confirm($sql);

                    $sql_new = query("UPDATE products SET product_quantity = (product_quantity - '{$value}') WHERE product_id = ".$id);
                    confirm($sql_new);
                }
            }
        }
    }
}




//------------------------------------------------------------------------------//

/**
 * work: checks if the same paypal transaction id exists or not
 * @param $id
 */
function get_paypal_id($id) {
    $query = query("SELECT order_id FROM orders WHERE order_tx = '{$id}'");
    confirm($query);

    if(mysqli_num_rows($query) == 0){
        return false;
    }else{
        return true;
    }
}



//------------------------------------------------------------------------------//



/**
 * @work: Display orders in Admin orders page
 */
function display_orders()
{
    $query = query("SELECT * FROM orders");
    confirm($query);

    while($data = fetch_array($query)){

    $orders = <<<DELEMITER

        <tr>
            <td><a href="index.php?oid={$data['order_shop_id']}">{$data['order_shop_id']}</a></td>
            <td>{$data['order_amount']}</td>
            <td>{$data['order_tx']}</td>
            <td>{$data['order_status']}</td>
            <td>{$data['order_currency']}</td>
            <td>{$data['user_email']}</td>
        </tr>

DELEMITER;
        echo $orders;
    }

}




//------------------------------------------------------------------------------//