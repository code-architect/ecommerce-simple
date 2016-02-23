<?php
/**
 * Created by PhpStorm.
 * User: Code-Architect
 */





/*************************************************************************/
/*****************           Helper Functions         *******************/
/*************************************************************************/



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
 * @work Get product thumbnails
 */
function get_products()
{
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){

        $product = <<<DELEMITER

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="{$row['product_image']}">
                            <div class="caption">
                                <h4 class="pull-right">{$row['product_price']}</h4>
                                <h4><a href="#">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['product_description']}</p>

                                <a class="btn btn-primary" target="_blank" href="">View Tutorial</a>
                            </div>

                        </div>
                    </div>
DELEMITER;

        echo $product;


    }
}

