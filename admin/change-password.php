<?php include("partials/header.php") ?>

<div class="main">
    <div class="wrapper">
        <h1>change password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        
        ?>

        <form action="" method="POST">
            <table class="tbl">
                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Current password""></td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td><input type="password" name="new_password" placeholder="New password""></td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm password""></td>
                    
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


    </div>
</div>

<?php 
    // check wether the submit(change password) button is clicked or not
    if(isset($_POST['submit'])){

        //1. get the data from from
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $current_password = mysqli_real_escape_string($conn,md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($conn,md5($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($conn,md5($_POST['confirm_password']));

        //2. check wether the user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password = '$current_password'";
        //execute the query
        $res = mysqli_query($conn,$sql);
        if($res==true){
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1){
                //get the details
                // echo "user found";
                //check whether new password and confirm password match or not
                if($new_password==$confirm_password){
                    //update password
                    $sql2 = "UPDATE tbl_admin SET 
                        password = '$new_password'
                        WHERE id = '$id'
                    ";
                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);

                    //check whether the query is executed or not
                    if($res2 == true){
                        $_SESSION['password_changed'] = "<div class='success'><strong>Password changed. </strong></div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['password_changed'] = "<div class='danger'><strong>Somtheing went wrong. </strong></div>";
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    
                }
                else{
                    $_SESSION['password_doesnt_match'] = "<div class='danger'><strong>Password did not match. </strong></div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }

            }
            else{
                //redirecte to manage admin page
                $_SESSION['user-not-found'] = "<div class='error'><strong>Wrong password or User not found. </strong></div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        } 

        //3. check whether the new password or new password are same or not

        //4. change password if all above are true
    }
?>

<?php include("partials/footer.php") ?>