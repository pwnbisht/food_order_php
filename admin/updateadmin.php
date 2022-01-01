<?php include('partials/header.php') ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Admin </h1>
        <br><br>

        <?php 

            //1. Get the id of the selected Admin
            $id= mysqli_real_escape_string($conn,$_GET['id']);

            //2. Create SQL qurey to get details
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            //3. execute the query
            $res = mysqli_query($conn,$sql);

            //4. check whether the query is executed or not

            if($res==true){
                //check whether the data is available or not
                $count = mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1){
                    //get the details
                    $rows = mysqli_fetch_assoc($res);

                    
                    $full_name = $rows['full_name'];
                    $user_name = $rows['user_name'];
                }
                else{
                    //redirecte to manage admin page
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
        ?>


        <form action="" method="POST">

            <table class="tbl">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullname" value="<?php echo $full_name; ?>"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $user_name; ?>"></td>
                </tr>

                <!-- <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr> -->

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<!-- check whether the submit button is clicker or not -->
<?php 
    if(isset($_POST['submit'])){
        // echo "button clicked";
        //1. get the all data from form
        $id = mysqli_real_escape_string($conn,$_POST['id']);
        $fullname = mysqli_real_escape_string($conn,$_POST['fullname']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        
        //2. SQL query to update data into DB
        $sql = "UPDATE tbl_admin SET
        full_name = '$fullname',
        user_name = '$username'
        WHERE id = '$id'
        ";
        //3. Execute the query
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //check whether data is updated or not

        if($res==TRUE){
            $_SESSION['update'] = " <div class='success'><strong> Admin updated successfully </strong></div>";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed to insert data
            // echo "failed";

            //Create a session var to display message
            $_SESSION['update'] = " <div class='error'><strong> Failed to update admin </strong></div>";
            //redirect page to add admin
            header("location:".SITEURL.'admin/manage-admin.php');

        }

        

    }

?>


<?php include('partials/footer.php') ?>