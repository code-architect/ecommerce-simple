
<div class="col-md-12">

    <div class="row">
        <h1 class="page-header">
            Add Product
        </h1>
    </div>

<?php create_product(); ?>

    <form action="" method="post" enctype="multipart/form-data">


        <div class="col-md-8">

            <div class="form-group">
                <label for="product-title">Product Title </label>
                <input type="text" name="product_title" class="form-control" required="">

            </div>


            <div class="form-group">
                <label for="product-title">Product Description</label>
                <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required=""></textarea>
            </div>



            <div class="form-group row">

                <div class="col-xs-3">
                    <label for="product-price">Product Price</label>
                    <input type="text" name="product_price" class="form-control" size="60" required="">
                </div>

            </div>



            <div class="form-group">
                <label for="product-title">Product Short Description</label>
                <textarea name="product_short_desc" id="" cols="30" rows="3" class="form-control" required="required"></textarea>
            </div>




        </div><!--Main Content-->


        <!-- SIDEBAR-->


        <aside id="admin_sidebar" class="col-md-4">


            <div class="form-group">
                <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
                <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
            </div>


            <!-- Product Categories-->

            <div class="form-group">
                <label for="product-title">Product Category</label>

                <select name="product_category_id" id="" class="form-control">
                    <?php category_for_add_product(); ?>
                </select>

            </div>


            <!-- Product Status -->
            <div class="form-group">
                <label for="product-title">Product Status</label>

                <select name="product_status" id="" class="form-control">
                    <option value="1">On Web</option>
                    <option value="0">Drafted</option>
                </select>

            </div>


            <div class="form-group">
                <label for="product-title">Product Quantity</label>
                <input type="number" name="product_quantity" class="form-control" required="">
            </div>


            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Product Image Small</label>
                <input type="file" name="image" id="image" required="">
            </div>

            <!-- Product Image -->
            <div class="form-group">
                <label for="product-title">Product Imagel</label>
                <input type="file" name="image2" id="image2" required="">
            </div>



        </aside><!--SIDEBAR-->



    </form>
