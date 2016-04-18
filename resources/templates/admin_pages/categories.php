
<h1 class="page-header">
    Product Categories
</h1>
<h3 class="bg-success"><?php display_message(); ?></h3>

<div class="col-md-4">

    <?php
        // add to category
        add_category();

        //delete from category list
        delete_category();

        //update category
        update_category();
    ?>

    <?php
    if(isset($_GET['edit_cat'])){
        $edit_cat = escape_string($_GET['edit_cat']);   // cleaning the get value
        $checking_cat = check_category_exists($edit_cat);   // checking if the category exists

        if($checking_cat == true) {
            $category_value = query("SELECT * FROM categories WHERE cat_id = '{$edit_cat}'");
            confirm($category_value);
            $row = fetch_array($category_value);
        }
    ?>

    <!-- edit category -->
    <form action="" method="post">

        <div class="form-group">
            <label for="category-title">Title</label>
            <input value="<?php echo $row['cat_title']; ?>" name="up_cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">

            <input name="update_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>

    </form>
    <!-- Add category ends-->

    <?php } else { ?>

    <!-- Add category -->
    <form action="" method="post">

        <div class="form-group">
            <label for="category-title">Title</label>
            <input name="cat_title" type="text" class="form-control">
        </div>

        <div class="form-group">

            <input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>

    </form>
    <!-- Add category ends-->

    <?php } ?>

</div>


<div class="col-md-8">

    <table class="table">
        <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
        </thead>
            <?php show_categories_in_admin(); ?>
        <tbody>

        </tbody>

    </table>

</div>
