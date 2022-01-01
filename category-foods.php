<?php include("partials-frontend/menu.php") ?>
<?php 
    //check whether id is set or not
    if(isset($_GET['id']))
    {
        $cat_id = mysqli_real_escape_string($conn,$_GET['id']);

        ///get the category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id = $cat_id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //get the value from db
        $row = mysqli_fetch_assoc($res);
        $cat_title = $row['title'];
    }
    else
    {
        header("location:".SITEURL.'index.php');
    }
            
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $cat_title; ?>"</a></h2>
    </div>
</section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php

                //sql for get food based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $cat_id ";
                
                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);
                
                //check whether food is available or not
                if($count2>0 )
                {
                    //food available
                    while($row = mysqli_fetch_assoc($res2)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['dscr'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                
                                    //check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                            <img src="<?php SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">$<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    //food is not available
                    echo "<div class='error'>Food is not available</div>";
                }
            
            
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-frontend/footer.php") ?>