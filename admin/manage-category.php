<?php include('partials/header.php') ?>

    <div class="main">
        <div class="wrapper"><h1>Manage Category</h1>
        <br>

        <?php
            if(isset($_SESSION['add-category']))
            {
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['img-dlt']))
            {
                echo $_SESSION['img-dlt'];
                unset($_SESSION['img-dlt']);
            }

            if(isset($_SESSION['cat-dlt']))
            {
                echo $_SESSION['cat-dlt'];
                unset($_SESSION['cat-dlt']);
            }

            if(isset($_SESSION['cat-update']))
            {
                echo $_SESSION['cat-update'];
                unset($_SESSION['cat-update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>

            <!-- Button to add Admin -->
            <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Feature</th>
                    <th>Active</th>
                    <th>Actions</th>
                    
                </tr>

                <?php

                    //query to get all category form db
                    $sql = "SELECT * FROM tbl_category";

                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    //create serial no. var and assign the value as 1
                    $sn = 1;

                    // check whether we have data in db or not
                    if($count>0)
                    {
                        //we have data in db
                        while($row=mysqli_fetch_assoc($res))
                        {

                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $feature = $row['feature'];
                            $active = $row['active'];

                            ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    
                                    <?php 
                                        //chech whether image name is avaible or not
                                         if($image_name!="")
                                         {
                                             //display the Image
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px " >
                                            
                                            <?php


                                         }
                                         else
                                         {
                                            //display the message
                                            echo "<div class='error'>Image not added.</div>";
                                         }
                                    ?>
                                </td>

                                <td><?php echo $feature; ?></td>
                                <td><?php echo $active; ?></td>
                                
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
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
                            <td colspan="6">
                                <div class="error">No category Added.</div>
                            </td>
                        </tr>


                        <?php

                    }
                ?>


                
            </table>
    </div>
    </div>
    

<?php include('partials/footer.php') ?>