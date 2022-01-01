<?php include("partials/header.php") ?>
<div class="main">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>
                        Title :
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>
                        Description :
                    </td>
                    <td>
                        <textarea name="dscr" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        Price :
                    </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>
                        Select Image :
                    </td>
                    <td>
                        <input type="file" name="img">
                    </td>
                </tr>



                <tr>
                    <td>
                        Category :
                    </td>
                    <td>
                        <select name="category">

                            <?php
                            //Create php code to display categories from DB
                            //1. Create sql to get all active categories from DB and display on drop down menu

                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' ";
                            $res = mysqli_query($conn, $sql);
                            //count the rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            //if count > 0 we havecategories else we dont have any categories
                            if ($count > 0) {
                                // we have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details of the categories
                                    $id = $row['id'];
                                    $title = $row['title'];


                            ?>


                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>


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
                        <input type="radio" name="feature" value="Yes"> Yes
                        <input type="radio" name="feature" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value=" Add Food " class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

        <?php

            //check whether the add food button is checked or not
            if(isset($_POST['submit']))
            {
                //add the food in db
                //get the data from form

                $title        =  mysqli_real_escape_string($conn,$_POST['title']);
                $description  =  mysqli_real_escape_string($conn,$_POST['dscr']);
                $price        =  mysqli_real_escape_string($conn,$_POST['price']);
                $category     =  mysqli_real_escape_string($conn,$_POST['category']);
                
                // for feature and active we need to check whether radio buttons are checked or not
                if (isset($_POST['feature'])) {
                    $feature = $_POST['feature'];
                } else {
                    //set the default value
                    $feature = "No";
                }
    
                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    //set the default value
                    $active = "No";
                }
                 

                //upload the image if selected
                //check whether img is selected or not and set the valuse for img name accoridingly
                //print_r($_FILES['img']);     //to display the array coz echod does not display the array

                // Array ( [name] => photo6141017585433554621.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpCFE6.tmp [error] => 0 [size] => 103193 )

                //die();

                if (isset($_FILES['img']['name'])) {

                    //upload the img
                    //to upload img we need img name and source path and destination path
                    $image_name = mysqli_real_escape_string($conn,$_FILES['img']['name']);

                    //check whether image is selected or not and upload img only if img is selected or not
                    if ($image_name != "") 
                    {
                        //auto rename our image 
                        //1. get the extention of our img(.jpg, .png etc) eg= food1.jpg
                        $ext = end(explode('.', $image_name));

                        //2. rename the img

                        //$image_name = "food_category_".rand(000,999).'.'.$ext; //new img name will be ex- food_category_493.jpg 
                        $image_name = "food_" . date('Y_m_d-H-i-s') . '.' . $ext;  //new img name will be ex- food_category_2021_12_22-19-20-46.jpg

                        $source_path = $_FILES['img']['tmp_name'];
                        $destination_path = "../images/food/" . $image_name;

                        //finally upload the img
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check whether the img is uploded or not
                        //and if the img not uploded the we will stop the pross and redirect with eddor msg

                        if ($upload == FALSE) 
                        {

                            $_SESSION['upload'] = " <div class='error'><strong> Failed to upload image </strong></div>";
                            header("location:" . SITEURL . 'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }
                } 
                else {
                    //dont upload img and set the image name value as blank
                    $image_name = " ";
                }

                //insert into DB

                //2. sql query for insert category data into db

                $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    dscr = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$feature',
                    active = '$active'
                ";

                //3. Execute Query and save data in DB
                $res2 = mysqli_query($conn, $sql2);

                //check whether data is inserted in db or not 
                if ($res2 == True) 
                {

                    $_SESSION['add-food'] = " <div class='success'><strong> Food added successfully </strong></div>";
                    header("location:" . SITEURL . 'admin/manage-food.php');
                } 
                else 
                {
                    //failed to add food
                    $_SESSION['add-food'] = " <div class='error'><strong> Failed to add Food </strong></div>";
                    header("location:" . SITEURL . 'admin/manage-food.php');
                }
            

                
            }
        
        
        ?>

    </div>                           
</div>
<?php include("partials/footer.php") ?>