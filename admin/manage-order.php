<?php include('partials/header.php') ?>

    <div class="main">
        <div class="wrapper"><h1>Manage Order</h1>
        <br>

        <?php
            if(isset($_SESSION['update-order']))
            {
                echo $_SESSION['update-order'];
                unset($_SESSION['update-order']);
            }

            if(isset($_SESSION['update-order-db']))
            {
                echo $_SESSION['update-order-db'];
                unset($_SESSION['update-order-db']);
            }
        ?>
            <!-- Button to add Admin -->
            <!-- <a href="#" class="btn-primary">Add Order</a>
            <br>
            <br> -->
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                    
                </tr>

                <?php
                
                    //get all the orders from db
                    $sql = "SELECT * FROM tbl_order";

                    //execute the query
                    $res = mysqli_query($conn,$sql);
                    
                    //count the rows
                    $count = mysqli_num_rows($res);
                    $sn = 1; //for serial number
                    
                    //check whether data is available or not
                    if($count>0)
                    {
                        //display food
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $custmor_name = $row['custmor_name'];
                            $custmor_contact = $row['custmor_contact'];
                            $custmor_email = $row['custmor_email'];
                            $custmor_address = $row['custmor_address'];

                            ?>
                            <tr>
                                <td><?php echo $sn++ ; ?></td>
                                <td><?php echo $food ; ?></td>
                                <td>$<?php echo $price ; ?></td>
                                <td><?php echo $qty ; ?></td>
                                <td><?php echo $total ; ?></td>
                                <td><?php echo $order_date ; ?></td>
                                <td>
                                    <?php
                                        //order status color
                                        if($status=="Ordered")
                                        {
                                            echo "<label><b>$status</b></label>";
                                        }
                                        elseif($status=="On Delivery")
                                        {
                                            echo "<label style='color: orange'><b>$status</b></label>";
                                        }
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label style='color: green'><b>$status</b></label>";
                                        }
                                        elseif($status=="Canceled")
                                        {
                                            echo "<label style='color: red'><b>$status</b></label>";
                                        }
                                    
                                    ?>
                                </td>
                                <td><?php echo $custmor_name ; ?></td>
                                <td><?php echo $custmor_contact ; ?></td>
                                <td><?php echo $custmor_email ; ?></td>
                                <td><?php echo $custmor_address ; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id ;?>" class="btn-secondary">Update order</a>
                                    <!-- <a href="#" class="btn-danger">Delete order</a> -->
                                </td>
                            </tr>
                            <?php

                        }
                    }
                    else
                    {
                        echo "<tr><td colspan='12' class='error'>Order not avaliable</td></tr>";
                    }
                
                ?>


                
            </table>
    </div>
    </div>
    
<?php include('partials/footer.php') ?>