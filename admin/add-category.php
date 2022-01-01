<?php include("partials/header.php") ?>
<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- add category form starts here -->
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
                        Select Image :
                    </td>
                    <td>
                        <input type="file" name="img">
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
                        <input type="submit" name="submit" value=" Add Category " class="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

        <!-- add category form ends here -->

        <?php

        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {

            //1. get the data from form

            $title = mysqli_real_escape_string($conn,$_POST['title']);

            //for radio button, we need to check whether radio button is checked or not
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

            //check whether img is selected or not and set the valuse for img name accoridingly
            //print_r($_FILES['img']);     //to display the array coz echod does not display the array

            // Array ( [name] => photo6141017585433554621.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpCFE6.tmp [error] => 0 [size] => 103193 )

            //die();

            if (isset($_FILES['img']['name'])) {

                //upload the img
                //to upload img we need img name and source path and destination path
                $image_name = mysqli_real_escape_string($conn,$_FILES['img']['name']);

                if ($image_name != "") 
                {
                    //auto rename our image 
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
                        header("location:" . SITEURL . 'admin/add-category.php');
                        //stop the process
                        die();
                    }
                }
            } 
            else {
                //dont upload img and set the image name value as blank
                $image_name = " ";
            }

            //2. sql query for insert category data into db

            $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    feature = '$feature',
                    active = '$active'
                ";

            //3. Execute Query and save data in DB
            $res = mysqli_query($conn, $sql);

            //check whether data is inserted in db or not 
            if ($res == True) {

                $_SESSION['add-category'] = " <div class='success'><strong> Category added successfully </strong></div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                //failed to add category
                $_SESSION['add-category'] = " <div class='error'><strong> Failed to add category </strong></div>";
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>


    </div>
</div>


<?php include("partials/footer.php") ?>