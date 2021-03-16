
<?php  include_once('./includes_folder/header.php');    //include HTML headers

include_once('./includes_folder/db.php');       //database conn


$num_per_page   = 05;

if(isset($_GET["page"]))
{
    $page   = $_GET["page"];
}else{
    $page   = 1;
}

$start_from =   ($page-1)*05;

?>
    <div class="container">
        <section class="page-header">
            <div class="row">
                <div class="col-md-5">
                    <h1>All Orders</h1>
                </div>
                <div class="col-md-7"><button class="btn btn-primary float-right add-print" type="button" style="background: rgb(230,0,126);">Create a Order</button></div>
            </div>
        </section>
        <section class="page-header"></section>
        <div class="row top-panels">
            <div class="col-md-12 recent-activity">
                <h5>Recent Orders</h5>
            </div>
            <!-- start php script -->
            <?php
                $sql        = "SELECT * FROM orders LIMIT $start_from,$num_per_page";
                $result     = mysqli_query($conn, $sql);
                while($row  = mysqli_fetch_assoc($result)){
            ?>  
            <div class="col-md-9 recent-activity">
                <?php    echo '<p>' . $row['order_details']. '</p>'; ?>
            </div>  

            <div class="col-md-3 recent-activity">
                <div class="btn-group float-right"><button class="btn btn-dark" type="button">Actions</button><button class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button"></button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">Edit Order</a><a class="dropdown-item" href="#">Refund Order</a></div>
                </div>
            </div>

            <?php
                }  
            ?>      <!-- end php script -->
        </div>

        <div class="row pagnate-panel">
            <div class="col">
                <nav>
                    <ul class="pagination">
                    <!-- start php pagination script -->
            <?php
                $sql            = "SELECT * FROM orders";
                $result         = mysqli_query($conn, $sql);
                $total_record   = mysqli_num_rows($result);
                $total_pages    = ceil($total_record/$num_per_page);

                if($page > 1)
                {
            ?>
                   <?php echo "<li class=\"page-item\"><a href='all_orders.php?page=".($page-1)."' class='page-link' aria-label=\"Previous\"><span aria-hidden=\"true\">«</span></a></li>"; ?>
            <?php
                }

                for($i=1;$i<=$total_pages;$i++)
                {
            ?>
                  <?php  echo "<li class=\"page-item\"><a href='all_orders.php?page=".$i."'class='page-link'>".$i."</a></li>" ; ?>
            <?php
                }

                if($i > $page)
                {
            ?>
                    <?php echo "<li class=\"page-item\"><a href='all_orders.php?page=".($page+1)."' class='page-link' aria-label=\"Previous\"><span aria-hidden=\"true\">»</span></a></li>"; ?>
                    
            <?php
                }
            ?>      <!-- end php pagination script -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>

