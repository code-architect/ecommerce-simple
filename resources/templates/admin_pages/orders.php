
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
                TODO: Create Order details
                TODO: DELETE ORDER from both tables orders, reports
                -->
                <!--
                SELECT a.order_shop_id, a.product_quantity, a.product_quanity_price,
                b.user_email, b.order_tx, b.order_status,
                c.product_title, c.product_price

                FROM reports a, orders b, products c
                WHERE a.order_shop_id = b.order_shop_id AND a.product_id = c.product_id
                _______________________________________________________________________
                SELECT product_title, product_price from products where product_id
                IN
                (select product_id from reports where order_shop_id = '867PZI948Y5O9XG2OY1P7180580')
                ______________________________________________________________________
                select a.*, b.* from products a, users b
                where a.product_id IN (select product_id from reports where order_shop_id = '867PZI948Y5O9XG2OY1P7180580')
                AND
                b.user_email = (select user_email from orders where order_shop_id = '867PZI948Y5O9XG2OY1P7180580')
                ______________________________________________________________________
                select a.product_title, a.product_price, c.* , b.user_firstname, b.user_lastname, b.user_email
                  from products a, users b, orders c
                  where a.product_id IN (select a.product_id from reports where b.order_shop_id = '{$id}')
                  AND
                  b.user_email = (select user_email from orders where order_shop_id = '{$id}')
                  AND c.order_shop_id = '{$id}'
                -->
            </div>
        </div>

        <!-- /Table -->

