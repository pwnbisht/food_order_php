<?php include("partials/header.php"); ?>

<div class="main">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php

            if(isset($_GET['id']))
            {
                $id = mysqli_real_escape_string($conn,$_GET['id']);

                //get the data from db
                $sql = "SELECT * FROM tbl_order WHERE id = $id";
                $res = mysqli_query($conn,$sql);

                //count rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $name = $row['custmor_name'];
                    $contact = $row['custmor_contact'];
                    $email = $row['custmor_email'];
                    $address = $row['custmor_address'];
                }
                else
                {
                    header("loaction:".SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header("loaction:".SITEURL.'admin/manage-order.php');
            }            
        ?>

        <form action="" method="POST">

            <table class="tbl-30">

                <tr>
                    <td>
                        Food Name:
                    </td>
                    <td>
                        <strong ><?php echo $food; ?></strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        Price:
                    </td>
                    <td>
                        <strong >$<?php echo $price; ?></strong>
                    </td>
                </tr>


                <tr>
                    <td>
                        Qty:
                    </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                
                <tr>
                    <td>
                        Status:
                    </td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Canceled"){echo "selected";} ?> value="Canceled">Canceled</option>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        Name:
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Email:
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Phone:
                    </td>
                    <td>
                        <input type="text" name="phone" value="<?php echo $contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        Address:
                    </td>
                    <td>
                        <textarea name="address" cols="30" rows="5" ><?php echo $address;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ; ?>">
                        <input type="hidden" name="price" value="<?php echo $price ; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            //check whether update button is clicked or not

            if(isset($_POST['submit']))
            {
                //get all the values from form
                $id = mysqli_real_escape_string($conn,$_POST['id']); 
                $price = mysqli_real_escape_string($conn,$_POST['price']);
                $qty = mysqli_real_escape_string($conn,$_POST['qty']);

                $total = $price * $qty;

                $status = mysqli_real_escape_string($conn,$_POST['status']);
                $name = mysqli_real_escape_string($conn,$_POST['name']);
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $phone = mysqli_real_escape_string($conn,$_POST['phone']);
                $address = mysqli_real_escape_string($conn,$_POST['address']);

                //sql query for update order
                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    custmor_name = '$name',
                    custmor_contact = '$phone',
                    custmor_email = '$email',
                    custmor_address = '$address'
                    WHERE id = $id
                ";
                
                //execute the query
                $res2 = mysqli_query($conn,$sql2);
                echo $res2;
                echo $address;

                //check whether query is executed or not
                if($res2==true)
                {
                    $_SESSION['update-order-db'] = "<div class='success'>order updated successfully</div>";
                    header("location:".SITEURL.'admin/manage-order.php');

                }
                else
                {
                    $_SESSION['update-order-db'] = "<div class='error'>Failed to update order</div>";
                    header("location:".SITEURL.'admin/manage-order.php');
                }

            }
        
        ?>

     </div>
</div>

<?php include("partials/footer.php") ?>