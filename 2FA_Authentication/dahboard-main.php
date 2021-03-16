
<?php

include_once('./includes_folder/db.php');
include_once('./includes_folder/header.php');
?>

    <div class="container">
        <section class="page-header">
            <div class="row">
                <div class="col-md-5">
                    <h1>Home</h1>
                </div>
                <div class="col-md-7"><button class="btn btn-primary float-right add-order" type="button" style="background: rgb(230,0,126);">Create A Order</button><button class="btn btn-primary float-right add-print" type="button" style="background: rgb(230,0,126);">Add A Print</button></div>
            </div>
        </section>
        <div class="row top-panels">
            <div class="col-md-12 recent-activity">
                <h5>Recent Orders</h5>
            </div>
            <?php  
                $sql        = "SELECT * FROM orders LIMIT 0,5";     //sql query
                $result     = mysqli_query($conn, $sql);      //query connection
                while($row  = mysqli_fetch_array($result)){
            ?>  
            <div class="col-md-9 recent-activity">
                <?php    echo '<p>' . $row['order_details'] . '</p>'; ?>  <!-- display orders -->
            </div>  

            <div class="col-md-3 recent-activity">
                <div class="btn-group float-right"><button class="btn btn-dark" type="button">Actions</button><button class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button"></button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">Edit Order</a><a class="dropdown-item" href="#">Refund Order</a></div>
                </div>
            </div>

            <?php
                }  //close statement
            
            ?>
            <div class="col-md-12 recent-activity"><a href="all_orders.php" style="color: rgb(255,25,205);">View More</a></div>
        </div> 

        <div class="row top-panels">
            <div class="col-md-12 recent-activity products-panel">
                <h5>Products</h5>
            </div>
            <?php
                //fetch all data from prodcut table
                $sql       = "SELECT * FROM products_table LIMIT 0,5";
                $result    = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-9 recent-activity">
                 <?php    echo '<p>' . $row['Products'] . '</p>'; ?> <!-- display product -->
            </div>
            <div class="col-md-3 recent-activity">
                <div class="btn-group float-right"><button class="btn btn-dark" type="button">Actions</button><button class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button"></button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">Edit Product</a><a class="dropdown-item" href="#">Delete Product</a></div>
                </div>
            </div>
            <?php
                }       //close statement
            ?>
            <div class="col-md-12 recent-activity"><a href="all_orders.php" style="color: rgb(255,25,205);">View More</a></div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>