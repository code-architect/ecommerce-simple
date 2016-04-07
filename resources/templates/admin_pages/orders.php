
  <div class="col-lg-12">
            <h1 class="page-header">
                All Orders
            </h1>
        </div>



        <div class="col-lg-12">
            <div class="row">

                    <table class="table table-list-search">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Amount</th>
                            <th>PayPal Transaction ID</th>
                            <th>Order Payment Status</th>
                            <th>Order Currency</th>
                            <th>User Email</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php display_orders(); ?>

                        </tbody>
                    </table>
                <!--
                SELECT a.order_shop_id, a.product_quantity, a.product_quanity_price,
                b.user_email, b.order_tx, b.order_status,
                c.product_title, c.product_price

                FROM reports a, orders b, products c
                WHERE a.order_shop_id = b.order_shop_id AND a.product_id = c.product_id
                -->
            </div>
        </div>

        <!-- /Table -->

