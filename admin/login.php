<?php include("../config/constants.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login food order system</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    
    <div class="login">
        <h1 class="text-center">Login</h1><br>

        <?php
            if(isset($_SESSION['admin_login'])){
                echo $_SESSION['admin_login'];
                unset($_SESSION['admin_login']);
            }
            
            if(isset($_SESSION['not_login'])){
                echo $_SESSION['not_login'];
                unset($_SESSION['not_login']);
            }
        ?>
        <!-- login form starts hear  -->

        <form action="" method="POST" class="text-center">
        Username:
        <br>
        <input type="text" name="username" placeholder="Enter Username">
        <br> <br>
        Password:
        <br>
        <input type="password" name="password" placeholder="Enter Password">
        <br><br>
        <input type="submit" name="submit" value="login" class="btn-primary ">
        
        </form>
        <br>

        <!-- login ends starts here -->

        <p class="text-center">Created by- <a href="#">Pawan Bisht</a></p>
    </div>
 
</body>
</html>

<?php 
    // check whether submit button is clicked or not
    if(isset($_POST['submit'])){
        
        // process for login

        //get data from login form

        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = md5(mysqli_real_escape_string($conn,$_POST['password']));

        // sql to check if username or pass is correct or not
        $sql = "SELECT * FROM tbl_admin WHERE user_name = '$username' AND password = '$password'";

        //exectue the query
        $res = mysqli_query($conn, $sql);

        //count rows to check whether the user exits or not 
        $count = mysqli_num_rows($res);
        if($count==1){
            //user available 
            $_SESSION['admin_login'] = " <div class='success'><strong> Success </strong></div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it.


            header("location:".SITEURL.'admin/'); 

        }
        else{
            $_SESSION['admin_login'] = " <div class='error text-center'><strong> wrong username or password </strong></div>";
            header("location:".SITEURL.'admin/login.php');

        }

        //check whether the query is executed or not

        // if($res==true){
        //     // header("location:".SITEURL.'admin/manage-admin.php');
        // }
        // else{
        //     $_SESSION['admin_login'] = " <div class='error'><strong> Failed to update admin </strong></div>";
        //     header("location:".SITEURL.'admin/manage-admin.php');
        // }

    }

?>


