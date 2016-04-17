
<?php
// getting the get value
$id = escape_string($_GET['edit_product']);

// update the products
update_product($id);




// check if there is a $_GET request and if it is valid
$value = check_product_exists($id);
if($value == false){
    redirect('index.php?products');
} else {

    $sql = query("SELECT * FROM products WHERE product_id = '{$id}' LIMIT 1");
    confirm($sql);
    $row = fetch_array($sql);

?>




<div class="col-md-12">
    <?php display_message(); ?>
    <div class="row">
        <h1 class="page-header">
            Edit Product
        </h1>
    </div>


    <form action="" method="post" enctype="multipart/form-data">


        <div class="col-md-8">


            <!-- Product Title -->
            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" value="<?php echo $row['product_title']; ?>" name="product_title" class="form-control" required="">

            </div>
            <!-- Product Title Ends -->

            <!-- Product Description -->
            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required="">
                    <?php echo $row['product_description']; ?>
                </textarea>
            </div>
            <!-- Product Description Ends -->


            <div class="form-group row">

                <!-- Product Price -->
                <div class="col-xs-3">
                    <label for="product-price">Product Price</label>
                    <input type="text" value="<?php echo $row['product_price']; ?>" name="product_price" class="form-control" size="60" required="">
                </div>
                <!-- Product Price Ends -->

            </div>


            <!-- Product Description Short -->
            <div class="form-group">
                <label for="product-title">Product Short Description</label>
                <textarea name="product_short_desc" id="" cols="30" rows="3" class="form-control" required="required">
                    <?php echo $row['product_short_desc']; ?>
                </textarea>
            </div>
            <!-- Product Description Short Ends -->




        </div><!--Main Content-->


        <!-- SIDEBAR-->


        <aside id="admin_sidebar" class="col-md-4">

            <!-- Update Button -->
            <div class="form-group">
                <input type="submit" name="Update" class="btn btn-primary btn-lg" value="Update">
            </div>


            <!-- Product Categories-->

            <div class="form-group">
                <label for="product-title">Product Category</label>

                <select name="product_category_id" id="" class="form-control">
                    <?php category_for_add_product($row['product_category_id']); ?>
                </select>

            </div>


            <!-- Product Status -->
            <div class="form-group">
                <label for="product-title">Product Status</label>

                <select name="product_status" id="product_status" class="form-control">
                    <option value="1" <?php if($row['product_status'] == 1) {echo "selected";} ?>>On Web</option>
                    <option value="0" <?php if($row['product_status'] == 0) {echo "selected";} ?>>Drafted</option>
                </select>

            </div>


            <!-- Product Quantity -->
            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" value="<?php echo $row['product_quantity']; ?>" name="product_quantity" class="form-control" required="">
            </div>


            <!-- Product Image Small -->
            <div class="form-group">
                <label for="product-image">Product Image Small</label>
                <input type="file" name="image" id="image" ><br>
                <img src="../../resources/uploads/<?php echo $row['product_image']; ?>" height="75" width="100">
            </div>

            <!-- Product Image Big -->
            <div class="form-group">
                <label for="product-image-big">Product Image Big</label>
                <input type="file" name="image2" id="image2" ><br>
                <img src="../../resources/uploads/<?php echo $row['product_image_big']; ?>" height="75" width="100">
            </div>



        </aside><!--SIDEBAR-->



    </form>

<?php } // end of if ?>