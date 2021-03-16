<?php  

include_once('./includes_folder/header.php');

include_once('./includes_folder/db.php');

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
                    <h1>All Prints</h1>
                </div>
                <div class="col-md-7"><button class="btn btn-primary float-right add-print" type="button" style="background: rgb(230,0,126);">Add A Print</button></div>
            </div>
        </section>
        <section class="page-header"></section>
        <div class="row top-panels">
            <div class="col-md-12 recent-activity products-panel">
                <h5>Products</h5>
            </div>
                <!-- begin php script -->
            <?php

                $sql        = "SELECT * FROM products_table LIMIT $start_from,$num_per_page";
                $result     = mysqli_query($conn, $sql);
                while($row  = mysqli_fetch_array($result)){
            ?>
            <div class="col-md-9 recent-activity">
                <?php    echo '<p>' . $row['Products'] . '</p>'; ?> <!-- output products -->
            </div>
            <div class="col-md-3 recent-activity">
                <div class="btn-group float-right"><button class="btn btn-dark" type="button">Actions</button><button class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false" type="button"></button>
                    <div class="dropdown-menu"><a class="dropdown-item" href="#">Edit Product</a><a class="dropdown-item" href="#">Delete Product</a></div>
                </div>
            </div>
            <?php
                }
            ?> <!-- begin php script -->
        </div>
        <div class="row pagnate-panel" style="color: rgb(0,0,0);">
            <div class="col">
                <nav>
                    <ul class="pagination">
                <!-- begin php pagination script -->
            <?php
                $sql            = "SELECT * FROM products_table";
                $result         = mysqli_query($conn, $sql);
                $total_record   = mysqli_num_rows($result);
                $total_pages    = ceil($total_record/$num_per_page);

                if($page > 1)
                {
            ?>
                   <?php echo "<li class=\"page-item\"><a href='all_prints.php?page=".($page-1)."' class='page-link' aria-label=\"Previous\"><span aria-hidden=\"true\">«</span></a></li>"; ?>
            <?php
                }

                for($i=1;$i<=$total_pages;$i++)
                {
            ?>
                  <?php  echo "<li class=\"page-item\"><a href='all_prints.php?page=".$i."'class='page-link'>".$i."</a></li>" ; ?>
            <?php
                }

                if($i > $page)
                {
            ?>
                    <?php echo "<li class=\"page-item\"><a href='all_prints.php?page=".($page+1)."' class='page-link' aria-label=\"Previous\"><span aria-hidden=\"true\">»</span></a></li>"; ?>
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
            
