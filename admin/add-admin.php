<?php include('partials/header.php') ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1><br>
         
        <?php 

                if(isset($_SESSION['add'])) //checking whether the session is set or not
                {
                    echo $_SESSION['add'];  // display the session message
                    unset($_SESSION['add']);//removing session message
                }
            
            ?>

        <form action="" method="POST">

            <table class="tbl">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullname" placeholder="Pawan Bisht"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="pwnbisht"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php include('partials/footer.php') ?>

<?php
    // process the value from form and save it in DB
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))     //submit = name
    {
        // 1. Get the data from Form
        $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));    //encrypt the password using MD5

        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$fullname',
            user_name = '$username',
            password = '$password'
        ";
        
        //3. Execute Query and save data in DB
            //these queries are added into config/constants.php file and included on header.php

        //4. executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Check whether the (Query in executed) data is inserted or not and display appropriate message
        if($res==TRUE){
            //Daata inserted
            // echo "inserted";

            //Create a session var to display message
            $_SESSION['add'] = " <div class='success'><strong> Admin added successfully </strong></div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed to insert data
            // echo "failed";

            //Create a session var to display message
            $_SESSION['add'] = " <div class='error'><strong> Failed to add admin </strong></div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');

        }
    }


?>