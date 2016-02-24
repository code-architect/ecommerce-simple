<?php
/**
 * Created by PhpStorm.
 * User: Code-Architect
 * File: Side Bar Navigation and Shop Name on Page
 */
?>

<div class="col-md-3">
    <p  class="lead">Shop Name</p>
    <div class="list-group">

        <?php
            $result = query(escape_string("SELECT * FROM categories"));
            confirm($result);

        while($row = fetch_array($result)){

                echo "<a href='".$row['cat_id']."' class='list-group-item'>".$row['cat_title']."</a>";
            }
        ?>


    </div>
</div>