<?php include('partials/header.php'); ?>

    <!-- main content section start -->
    <div class="main">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br>

            <?php 

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];  // displaying session message
                    unset($_SESSION['add']);//removing session message
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];  // displaying session message
                    unset($_SESSION['delete']);//removing session message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }


                if(isset($_SESSION['password_doesnt_match'])){
                    echo $_SESSION['password_doesnt_match'];
                    unset($_SESSION['password_doesnt_match']);
                }

                if(isset($_SESSION['password_changed'])){
                    echo $_SESSION['password_changed'];
                    unset($_SESSION['password_changed']);
                }


                                
            
            ?>
            <br>
            <br>

            <!-- Button to add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br>
            <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                    
                </tr>

                <?php 
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_admin";
                    //execute the query
                    $res = mysqli_query($conn,$sql);

                    //check whether the querty is executed or not
                    if($res==TRUE){
                        //count rows tocheck whether we have data in DB
                        $count = mysqli_num_rows($res); //function to get all the rows in DB
                        
                        $sn=1; //create the var and assign the value
                        
                        //check the number of rows
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //using while loop to get all the data frokm db
                                //and while loop will run as long as we have data in DB

                                //get individual data

                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $user_name = $rows['user_name'];

                                //display the values in our tables
                                ?>
                                    
                                        <tr>
                                            <td><?php echo $sn++ ?></td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $user_name; ?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                                <a href="<?php echo SITEURL; ?>admin/updateadmin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                            </td>
                                        </tr>
                                <?php

                            }
                        }
                        else{
                            // echo "no data";
                        }
                    }
                
                ?>


            </table>

        </div>
    </div>
    <!-- main content section ends -->

    <!-- footer section start -->
<?php include('partials/footer.php'); ?>
    <!-- footer section end -->
