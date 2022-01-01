<?php

    //authorization or access control
    //check whethe user is logged in or not
    if(! isset($_SESSION['user'])){ //if user session is not set

        //user is not logged in
        //redirect to login page with message

        $_SESSION['not_login'] = " <div class='error text-center'><strong> please login to access admin panel</strong></div>";
        header("location:".SITEURL.'/admin/login.php');
    }


?>