
<div class="col-lg-12">
    <h1 class="page-header">
        All Orders
    </h1>
</div>

<div class="col-lg-12">
    <div class="row">

        <h3 class="bg-success"><?php display_message(); ?></h3>

        <table class="table table-list-search">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Category</th>
                <th>In Stock</th>
                <th>On Web</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>

                <?php get_products_admin(); ?>

            </tbody>
        </table>

    </div>
</div>

<!-- /Table -->

