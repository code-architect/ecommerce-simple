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
    $query = query("SELECT * FROM products WHERE product_quantity > 0 AND product_status = 1 ORDER BY product_id $type");
    confirm($query);

    while($row = fetch_array($query)){

        $product = <<<DELEMITER

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img height="150" width="320" src="../resources/uploads/{$row['product_image']}"></a>
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
 * @work Getting category name by id
 */
function get_category_name_by_id($id)
{
    $sql = query(escape_string("SELECT cat_title FROM categories WHERE cat_id = {$id} LIMIT 1"));
    confirm($sql);

    $category = fetch_array($sql);
    return $category[0];

}


//-----------------------------------------------------------------------//


/**
 * @work Getting categories by id dynamically
 * @param $id S_GET id
 */

function get_products_by_category($id)
{
    $query = query("SELECT * FROM products WHERE product_category_id = $id and product_quantity > 0 AND product_status = 1");
    $get_num_rows = mysqli_num_rows($query);
    confirm($query);

    // If query returns rows, only then execute this else redirect user
    if($get_num_rows) {

        while ($row = fetch_array($query)) {


            $product = <<<DELEMITER

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img height="150" width="320" src="../resources/uploads/{$row['product_image']}"></a>
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
        $product = <<<DELEMITER
            <h1>No Products Found.Sorry!</h1>
            <h4> Try our other categories!</h4>
DELEMITER;

        echo $product;

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


/**
 * @work: Show all the products to the admin section
 */
function get_products_admin()
{
    $onweb = "No";

    $query = query("SELECT a.*,b.cat_title, b.cat_id FROM products a INNER JOIN categories b WHERE b.cat_id = a.product_category_id");
    confirm($query);

    while($row = fetch_array($query)) {

        if($row['product_status'] == 1){
            $onweb = "Yes";
        }else{
            $onweb = "No";
        }

        $product = <<<DELEMITER
            <tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_title']}</td>
                <td><img src="../../resources/uploads/{$row['product_image']}" height="70" width="70"></td>
                <td>{$row['cat_title']}</td>
                <td>{$row['product_quantity']}</td>
                <td>{$onweb}</td>
                <td>{$row['product_price']}</td>
                <td><a href="index.php?edit_product={$row['product_id']}" class="btn btn-warning"><spam class="glyphicon glyphicon-pencil"><spam></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete this item?');" href="../../resources/templates/admin_pages/delete_product.php?id={$row['product_id']}" class="btn btn-danger"><spam class="glyphicon glyphicon-trash"><spam></a></td>
            </tr>
DELEMITER;

        echo $product;
    }
}




//------------------------------------------------------------------------------//



/**
 * @work: check if product exists or not
 * @param $id
 * @return bool
 */
function check_product_exists($id)
{
    $query = query("SELECT product_title FROM products WHERE product_id = '{$id}'");
    confirm($query);

    if(mysqli_num_rows($query) == 0){
        return false;
    }else{
        return true;
    }
}



//------------------------------------------------------------------------------//


/**
 * @work: show categories in add product page
 */
function category_for_add_product($id = "")
{

    $result = query("SELECT * FROM categories");
    confirm($result);

    if($id == "")
    {
        while($row = fetch_array($result))
        {
            echo "<option value=".$row['cat_id'].">".$row['cat_title']."</option>";
        }
    }
    else
    {
        while($row = fetch_array($result))
        {
            if($row['cat_id'] == $id) { $show = "selected>";}else {$show = ">";}
            echo "<option value=".$row['cat_id']." ".$show.$row['cat_title']."</option>";
        }
    }
}




//------------------------------------------------------------------------------//



/**
 * @work: create a new product in the inventory
 */
function create_product()
{
    if(isset($_POST['publish']))
    {
        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_description    = escape_string($_POST['product_description']);
        $product_short_desc     = escape_string($_POST['product_short_desc']);
        $product_status         = escape_string($_POST['product_status']);

        $file_name = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];

        $file_name1 = $_FILES['image2']['name'];
        $file_tmp2 =$_FILES['image2']['tmp_name'];

        move_uploaded_file($file_tmp, TEMPLATE_IMAGE.DS.$file_name);        // small image
        move_uploaded_file($file_tmp2, TEMPLATE_IMAGE.DS.$file_name1);      // big image

        $query = query("INSERT INTO products(product_title, product_category_id, product_price, product_quantity,
                                             product_description, product_short_desc, product_image, product_image_big,
                                             product_status)

                        VALUES('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_quantity}',
                               '{$product_description}', '{$product_short_desc}', '{$file_name}', '{$file_name1}',
                               '{$product_status}')");
        confirm($query);

        set_message("New Product Just Added");
        redirect("index.php?products");
    }
}





//------------------------------------------------------------------------------//


/**
 * @work: Update product in the inventory
 */
function update_product($id)
{
    if(isset($_POST['Update']))
    {
        $product_title          = escape_string($_POST['product_title']);
        $product_category_id    = escape_string($_POST['product_category_id']);
        $product_price          = escape_string($_POST['product_price']);
        $product_quantity       = escape_string($_POST['product_quantity']);
        $product_description    = trim(escape_string($_POST['product_description']));
        $product_short_desc     = trim(escape_string($_POST['product_short_desc']));
        $product_status         = escape_string($_POST['product_status']);

        $file_name = $_FILES['image']['name'];
        $file_tmp =$_FILES['image']['tmp_name'];

        $file_name1 = $_FILES['image2']['name'];
        $file_tmp2 =$_FILES['image2']['tmp_name'];

        // if the user decide to keep the same image
        if(empty($file_name) && empty($file_name1)) {
            $get_pic = query("SELECT product_image, product_image_big FROM products WHERE product_id = ".$id);
            confirm($get_pic);
            while($pic = fetch_array($get_pic)) {
                $file_name = $pic['product_image'];
                $file_name1 = $pic['product_image_big'];
            }
        }

        move_uploaded_file($file_tmp, TEMPLATE_IMAGE.DS.$file_name);        // small image
        move_uploaded_file($file_tmp2, TEMPLATE_IMAGE.DS.$file_name1);      // big image

        $query =    "UPDATE products SET ";
        $query .=   "product_title          = '{$product_title}', ";
        $query .=   "product_category_id    = '{$product_category_id}', ";
        $query .=   "product_price          = '{$product_price}', ";
        $query .=   "product_quantity       = '{$product_quantity}', ";
        $query .=   "product_description    = '{$product_description}', ";
        $query .=   "product_short_desc     = '{$product_short_desc}', ";
        $query .=   "product_image          = '{$file_name}', ";
        $query .=   "product_image_big      = '{$file_name1}', ";
        $query .=   "product_status         = '{$product_status}' ";
        $query .=   "WHERE product_id       = '{$id}'";


        $result = query($query);
        confirm($result);

        set_message("Product has been updated.");
        redirect("index.php?edit_product=".$id);
    }
}




//------------------------------------------------------------------------------//


/**
 * @work: show categories in category page
*/
function show_categories_in_admin()
{
    $result = query("SELECT * FROM categories");
    confirm($result);

        while ($row = fetch_array($result)) {
            $category = <<<DELEMITER
            <tr>
                <td>{$row['cat_id']}</td>
                <td>{$row['cat_title']}</td>
                <td><a href="" class="btn btn-warning"><spam class="glyphicon glyphicon-pencil"><spam></a></td>
                <td><a onclick="return confirm('Are you sure you want to delete this category?');" href="index.php?categories&cat_del={$row['cat_id']}" class="btn btn-danger"><spam class="glyphicon glyphicon-trash"><spam></a></td>

            <tr>
DELEMITER;
            echo $category;

        }

}



//------------------------------------------------------------------------------//




/**
 * @work: add a new category to category table
 */
function add_category()
{
    if(isset($_POST['add_category']))
    {
        $cat_title = escape_string($_POST['cat_title']);

        $sql = query("INSERT INTO categories (cat_title) VALUES ('{$cat_title}')");
        confirm($sql);

        set_message("A new category has been added");
        redirect("index.php?categories");
    }
}




//------------------------------------------------------------------------------//



/**
 * @work: delete category
 */
function delete_category()
{
    if(isset($_GET['cat_del'])){

        $id = escape_string($_GET['cat_del']);

        $query = query("SELECT * FROM categories WHERE cat_id = '{$id}'");
        confirm($query);

        if(mysqli_num_rows($query) == 0)
        {
            set_message("No such category exists");
            redirect("index.php?categories");
        }
        else
        {
            $sql = query("DELETE FROM categories WHERE cat_id = '{$id}'");
            set_message("Category has been deleted");
            redirect("index.php?categories");
        }
    }
}

















