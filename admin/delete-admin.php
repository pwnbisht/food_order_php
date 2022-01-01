<?php
    include('../config/constants.php');
    // 1. get the id of admin to be deleted
    $id = mysqli_real_escape_string($conn,$_GET['id']);


    //2. Create SQL qurey to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id" ;

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whwther the query executed successfully 
    if($res==true){
        //create session var to disply message
        $_SESSION['delete'] = " <div class='success'> Admin Deleted Successfully </div>";
        //redirected to Manage Admin Page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    // else{
    //     // echo "failed";
    //     $_SESSION['delete'] = "Failed to delete Admin, try again  later";
    //     //redirected to Manage Admin Page
    //     header("location:".SITEURL.'admin/manage-admin.php');
    // }
    //3. redirect to manage admin page with message (success/error)


?>