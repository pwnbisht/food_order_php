<?php include("partials-frontend/menu.php") ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            
                //Display all the categories that are active
                //sql query
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                //execute the query
                $res = mysqli_query($conn,$sql);
                //count the rows
                $count = mysqli_num_rows($res);

                //check whether categories are available or not

                if($count>0){
                    //cate. available
                    while($row= mysqli_fetch_assoc($res)){
                        //get all the data from db
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                <?php
                                        //check whether img is available or not
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not availabe</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <?php
                                        }

                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else{
                    //categories not available
                    echo "<div class='error'>Category Not Found</div>";
                }
            
            ?>          
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<?php include("partials-frontend/footer.php") ?>