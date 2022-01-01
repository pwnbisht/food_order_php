<?php include('partials/header.php') ?>
<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                $id = mysqli_real_escape_string($conn,$_GET['id']);

                //sql query for getting all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                //execute the query
                $res = mysqli_query($conn,$sql);

                //count the rows and check whether data related to this id is available or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_img = $row['image_name'];
                    $feature = $row['feature'];
                    $active = $row['active'];
                }
                else
                {
                    // redirect to manage-category with error message
                    $_SESSION['cat-update'] = " <div class='error'><strong> Category not found. </strong></div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                // redirect to manage-category
                header("location:".SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        Title :
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="enter title">
                    </td>
                </tr>
                <tr>
                    <td>
                        Current Image :
                    </td>
                    <td>
                        <?php
                        
                            if($current_img!="")
                            {
                                //displat the img
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_img; ?>" width="100px" >
                                <?php

                            }
                            else
                            {
                                // display the error
                                echo "<div class= 'error'>Image not Available</div>";
                            }

                        ?>
                    </td>
                </tr>


                <tr>
                    <td>
                        select Image :
                    </td>
                    <td>
                        <input type="file" name="img">
                    </td>
                </tr>


                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($feature=="Yes"){ echo "checked"; } ?> type="radio" name="feature" value="Yes"> Yes
                        <input <?php if($feature=="No"){ echo "checked"; } ?> type="radio" name="feature" value="No"> No
                    </td>
                </tr>

                
                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if($active=="Yes"){ echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){ echo "checked"; } ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="hidden" name="id" value="<?php echo $id ; ?>">
                        <input type="submit" name="submit" value=" Update Category " class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //get all the values from form
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $current_img = mysqli_real_escape_string($conn,$_POST['current_img']);
                $feature = mysqli_real_escape_string($conn,$_POST['feature']);
                $active = mysqli_real_escape_string($conn,$_POST['active']);

                //updating new image if selected
                //check whether the image is selected or not
                if(isset($_FILES['img']['name']))
                {
                    //get the image details
                    $image_name = mysqli_real_escape_string($conn,$_FILES['img']['name']);

                    //check whether img available r not

                    if($image_name!="")
                    {
                        //img available
                        //upload the new img


                        //1. get the extention of our img(.jpg, .png etc) eg= food1.jpg
                        $ext = end(explode('.', $image_name));

                        //2. rename the img

                        //$image_name = "food_category_".rand(000,999).'.'.$ext; //new img name will be ex- food_category_493.jpg 
                        $image_name = "food_category_" . date('Y_m_d-H-i-s') . '.' . $ext;  //new img name will be ex- food_category_2021_12_22-19-20-46.jpg

                        $source_path = $_FILES['img']['tmp_name'];
                        $destination_path = "../images/category/" . $image_name;

                        //finally upload the img
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the img is uploded or not
                        //and if the img not uploded the we will stop the pross and redirect with eddor msg

                        if ($upload == FALSE) 
                        {

                            $_SESSION['upload'] = " <div class='error'><strong> Failed to upload image </strong></div>";
                            header("location:" . SITEURL . 'admin/manage-category.php');
                            //stop the process
                            die();
                        }


                        //remove the current img
                        //img available , so remove it

                        if($current_img!="")
                        {
                            $path = "../images/category/".$current_img;
                            //remove the image
                            $remove = unlink($path);

                            //if failed to remove img then add an error msg and stop the process
                            if($remove==false)
                            {
                                //set the session message
                                $_SESSION['img-dlt'] = " <div class='error'><strong> Failed to remove category image </strong></div>";
                                //redirect to manage-category page
                                header("location:".SITEURL.'admin/manage-category.php');
                                //stop the process
                                die();
                            }
                        }

                        
                    }
                     
                }
                else
                {
                    $image_name = $current_img;
                }

                //update the db
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    feature = '$feature',
                    active = '$active'
                    WHERE id = $id
                ";

                //execute the query

                $res2 = mysqli_query($conn,$sql2);

                //redirect to manage-category
                //check whether query executed or not
                if($res==true)
                {
                    $_SESSION['cat-update'] = " <div class='success'><strong> Category updated successfully. </strong></div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['cat-update'] = " <div class='error'><strong> Failed to update category. </strong></div>";
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }
        
        ?>

    </div>
</div>


<?php include('partials/footer.php') ?>