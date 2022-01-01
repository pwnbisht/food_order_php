<?php 

    include("../config/constants.php");
    // echo $image_name = $_GET['image'];

    //check whether the id and image name is set or not

    if(isset($_GET['id']) AND isset($_GET['image']))
    {
        
        //get the value and delete

        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $image_name = mysqli_real_escape_string($conn,$_GET['image']);

        //remove the physical image file if available

        if($image_name!="")
        {
            //img available , so remove it

            $path = "../images/category/".$image_name;
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

        //delete the data from db
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //sql query delete data from db 
        //execute the query

        $res = mysqli_query($conn,$sql);

        //check whether data is deleted from db or not
        if($res==true)
        {
            //set the session message
            $_SESSION['cat-dlt'] = " <div class='success'><strong> Successfully deleted category. </strong></div>";
            //redirect to manage-category page
            header("location:".SITEURL.'admin/manage-category.php');

        }
        else
        {
        //redirect to manage-category page whith error message
        $_SESSION['cat-dlt'] = " <div class='error'><strong> Failed to remove category. </strong></div>";
        //redirect to manage-category page
        header("location:".SITEURL.'admin/manage-category.php');
        }

    }
    else
    {
        // redirect to manage-category
        header("location:".SITEURL.'admin/manage-category.php');

    }

?>