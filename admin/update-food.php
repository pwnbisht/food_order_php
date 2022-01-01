<?php include("partials/header.php")?>

<div class="main">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <?php

            //get the id
            if(isset($_GET['id']))
            {
                $id = mysqli_real_escape_string($conn,$_GET['id']);

                //get all data from db

                //sql query for get all the data from db

                $sql = "SELECT * FROM tbl_food WHERE id = $id ";

                $res = mysqli_query($conn,$sql);

                //count the rows and check whether data is related to this id or not
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    //get all the data

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $description = $row['dscr'];
                    $price = $row['price'];
                    $current_img = $row['image_name'];
                    $category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];


                }
                else
                {
                    $_SESSION['food-id'] = " <div class='error'><strong> id not found. </strong></div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                }
            }
            else
            {
                //redirect 
                $_SESSION['food-id'] = " <div class='error'><strong> food not found. </strong></div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }

            
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td>
                        Title:
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" ><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Current image:
                    </td>
                    <td>
                        <?php
                            if($current_img!="")
                            {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_img; ?>" width="100px">
                            <?php
                            
                            }
                            else
                            {
                                echo "<div class= 'error'>Image not Available</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        Select new image:
                    </td>
                    <td>
                        <input type="file" name="img" >
                    </td>
                </tr>

                <tr>
                    <td>
                        Category:
                    </td>
                    <td>
                        <select name="category" >
                            <?php

                                //sql for get all categories from db

                                $sql2 = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                                $res2 = mysqli_query($conn,$sql2);

                                //count the rows and check whether we have category or not

                                $count2 = mysqli_num_rows($res2);

                                //if count>0 we have categories and else we dont have any category
                                if($count2>0)
                                {
                                    while($row2 = mysqli_fetch_assoc($res2))
                                    {
                                        $cat_id = $row2['id'];
                                        $cat_title = $row2['title'];
                                        ?>

                                        <option <?php if($category==$cat_id) { echo "selected";} ?> value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                   //we dont have any category
                                ?>
                                <option value="0">No category found</option>
                                <?php
                                }
                            
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked" ;} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No") {echo "checked" ;} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked" ;} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($featured=="No") {echo "checked" ;} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ; ?>">
                        <input type="hidden" name="current_img" value="<?php echo $current_img; ?>">
                        <input type="submit" name="submit" value=" Update Food " class="btn-secondary">
                    </td>
                </tr>

            </table>


        </form>
        <?php

            //check whether submit button is clicked or not

            if(isset($_POST['submit']))
            {
                //get the all the data from form
                $id = mysqli_real_escape_string($conn,$_POST['id']);
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $description = mysqli_real_escape_string($conn,$_POST['description']);
                $price = mysqli_real_escape_string($conn,$_POST['price']);
                $current_img = mysqli_real_escape_string($conn,$_POST['current_img']);
                $category = mysqli_real_escape_string($conn,$_POST['category']);
                $featured = mysqli_real_escape_string($conn,$_POST['featured']);
                $active = mysqli_real_escape_string($conn,$_POST['active']);
                
                //update the new img if selected
                //check whether img is selected or not

                if(isset($_FILES['img']['name']))
                {
                    //get the img details

                    $image_name = mysqli_real_escape_string($conn,$_FILES['img']['name']);
                    
                    //check whether img is available or not

                    if($image_name!="")
                    {
                        //img available
                        //upload the new img

                        //1 get the extention of img
                        $ext = end(explode('.', $image_name));

                        //rename the image
                        $image_name = "food_".date('Y_m_d-H-i-s').'.'.$ext;

                        $source_path = $_FILES['img']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //check whether img uploded or not
                        //and if image not uploded stop the process

                        if($upload == False)
                        {
                            $_SESSION['upload'] =  " <div class='error'><strong> Failed to upload image </strong></div>";
                            header("location:".SITEURL.'admin/manage-food.php');
                            die();
                        }

                        //remove the current img
                        //img available, so remove it

                        if($current_img!="")
                        {
                            $path = "../images/food/".$current_img;
                            //remove the image
                            $remove = unlink($path);

                            if($remove==false)
                            {
                                $_SESSION['upload']=  " <div class='error'><strong> Failed to delete image </strong></div>";
                                header("location:".SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = $current_img;
                    }
                }
                else
                {
                    $image_name = $current_img;
                }

                //update the db
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                dscr = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured'
                active = '$active'
                WHERE id = $id
                ";

                //execute the query
                $res3 = mysqli_query($conn,$sql3);

                //check whether query is executed or not

                if($res3==TRUE)
                {
                    $_SESSION['food-update']= " <div class='success'><strong> Food updated successfully </strong></div>";
                    header("location:".SITEURL.'admin/manage-food.php');

                }
                else
                {
                    $_SESSION['food-update']= " <div class='error'><strong> Failed to update food </strong></div>";
                    header("location:".SITEURL.'admin/manage-food.php');
                    // echo $image_name;
                }

                                
            }
        
        ?>
    </div>
</div>


<?php include("partials/footer.php")?>