<?php include('partials/header.php'); ?>



    <!-- main content section start -->
    <div class="main">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br>

            <?php

                if(isset($_SESSION['admin_login'])){
                    echo $_SESSION['admin_login'];
                    unset($_SESSION['admin_login']);
                }

            ?>
            <br>

            <div class="col-4 text-center">

            <?php
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
            
            ?>
                <h1><?php echo $count; ?></h1>
                <br>
                categories
            </div>

            <div class="col-4 text-center">
                
                <?php
                    $sql1 = "SELECT * FROM tbl_food";
                    $res1 = mysqli_query($conn,$sql1);
                    $count1 = mysqli_num_rows($res1);
                
                ?>
                <h1><?php echo $count1 ;?></h1>
                <br>
                Foods
            </div>

            <div class="col-4 text-center">
                
                <?php
                    $sql2 = "SELECT * FROM tbl_order";
                    $res2 = mysqli_query($conn,$sql2);
                    $count2 = mysqli_num_rows($res2);
                
                ?>
                <h1><?php echo $count2; ?></h1>
                <br>
                Total orders
            </div>

            <div class="col-4 text-center">
                
                <?php
                    $sql3 = "SELECT SUM(total) As Total FROM tbl_order WHERE status='Delivered'";
                    $res3 = mysqli_query($conn,$sql3);
                    $count3 = mysqli_num_rows($res3);

                    //get the value
                    $row = mysqli_fetch_assoc($res3);
                    //get the revenue
                    $total_r = $row['Total'];
                
                ?>
                <h1>$<?php echo $total_r; ?></h1>
                <br>
                Revenue Generated
            </div>
            <div class="clearfix"></div>
            
        </div>
    </div>
    <!-- main content section ends -->

    <!-- footer section start -->
    <?php include('partials/footer.php'); ?>
    <!-- footer section end -->
    

</body>
</html>