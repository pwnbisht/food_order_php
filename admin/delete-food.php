<?php

    include("../config/constants.php");

    //check whether the id and image name is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the vlue and delete
        $id = mysqli_real_escape_string($conn,$_GET['id']);
        $image_name = mysqli_real_escape_string($conn,$_GET['image_name']);

        //remove the physical image file if available

        if($image_name!="")
        {
            //imahe available, so remove  it

            $path = "../images/food/".$image_name;
            //remove the image
            $remove = unlink($path);

            // if failed to remove img than add an error and redirect

            if($remove==false)
            {
                $_SESSION['img-dlt'] = " <div class='error'><strong> Failed to remove food image </strong></div>";
                header("location:".SITEURL.'admin/manage-food.php');
                die();
            }
        }

        //delete the data from db
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        //check whether data is deleted from db or not

        if($res==true)
        {
            $_SESSION[' '] = " <div class='success'><strong> Successfully deleted Food. </strong></div>";
            header("location:".SITEURL.'admin/manage-food.php');
        }
        else
        {
            //redirect to manage-category page whith error message
            $_SESSION['food-dlt'] = " <div class='error'><strong> Failed to remove Food. </strong></div>";
            //redirect to manage-category page
            header("location:".SITEURL.'admin/manage-food.php');
        }

    }
    else
    {
        $_SESSION['unauthorized'] = " <div class='error'><strong> unauthorized Access. </strong></div>";
        header("location:".SITEURL.'admin/manage-food.php');
    }



?>