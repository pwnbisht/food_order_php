<?php include('partials/header.php') ?>

    <div class="main">
        <div class="wrapper"><h1>Manage Food</h1>
        <br>

        <?php
            if (isset($_SESSION['add-food'])) 
            {
                echo $_SESSION['add-food'];
                unset($_SESSION['add-food']);
            }

            if (isset($_SESSION['img-dlt'])) 
            {
                echo $_SESSION['img-dlt'];
                unset($_SESSION['img-dlt']);
            }
       

            if (isset($_SESSION['upload'])) 
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['food-update'])) 
            {
                echo $_SESSION['food-update'];
                unset($_SESSION['food-update']);
            }

            if (isset($_SESSION['food-dlt'])) 
            {
                echo $_SESSION['food-dlt'];
                unset($_SESSION['food-dlt']);
            }

            if (isset($_SESSION['unauthorized'])) 
            {
                echo $_SESSION['unauthorized'];
                unset($_SESSION['unauthorized']);
            }

           
        ?>
        <br><br>

            <!-- Button to add Food-->
            <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Feature</th>
                    <th>Active</th>
                    <th>Actions</th>
                    
                </tr>

                <?php
                
                    //auery to get all food from db
                    $sql = "SELECT * FROM tbl_food";

                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    //create the serial no var and assign the value as 1
                    $sn = 1;

                    //check whether data is available or not
                    if($count>0)
                    {
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $feature = $row['featured'];
                            $active = $row['active'];

                ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php

                                        if($image_name!="")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                                            <?php
                                        }
                                        else
                                        {
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                    
                                    ?>
                                </td>

                                <td><?php echo $price; ?></td>
                                <td><?php echo $feature; ?></td>
                                <td><?php echo $active; ?></td>

                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>

                            <?php

                        }
                    }

                    else
                    {
                        //we dont have any data in db
                        ?>  
                        <!-- break the php for writting html -->

                        <tr>
                            <td colspan="7">
                                <div class="error">No Food Added.</div>
                            </td>
                        </tr>


                        <?php

                    }
            
                
                ?>


           
            </table>
    </div>
    </div>
    
<?php include('partials/footer.php'); ?>