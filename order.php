<?php include("partials-frontend/menu.php") ?>
<?php

    //check whether id is set or not
    if(isset($_GET['food_id']))
    {
        //get the id and details of the selected food
        $id = mysqli_real_escape_string($conn,$_GET['food_id']);

        //get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id = $id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //count the rows
        $count = mysqli_num_rows($res);

        //check whether data is available or not
        if($count==1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else 
        {
            //food not available
            header("location:" .SITEURL);
        }
    }
    else
    {
        header("location:" .SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        
                            //check whether image is available or not
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not available</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                            }                       
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">$<?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Pawan Bisht" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 7302xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. bishtxxx.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    
                    <input type="hidden" name="food_title" value="<?php echo $title;?>" class="btn btn-primary">
                    <input type="hidden" name="price" value="<?php echo $price;?>" class="btn btn-primary">
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                //check whether button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the deatils from form
                    $food = mysqli_real_escape_string($conn,$_POST['food_title']);
                    $price = mysqli_real_escape_string($conn,$_POST['price']);
                    $qty = mysqli_real_escape_string($conn,$_POST['qty']);
                    $total = $price * $qty;
                    $date = date("Y-m-d H:i:sa");
                    $status = "Ordered";
                    $name = mysqli_real_escape_string($conn,$_POST['full-name']);
                    $contact = mysqli_real_escape_string($conn,$_POST['contact']);
                    $email = mysqli_real_escape_string($conn,$_POST['email']);
                    $address = mysqli_real_escape_string($conn,$_POST['address']);


                    //save the order in db
                    //sql for insters data into db
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$date',
                        status = '$status',
                        custmor_name = '$name',
                        custmor_contact = '$contact',
                        custmor_email = '$email',
                        custmor_address = '$address'
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);

                    //check whether query is executed or not
                    if($res2==true){
                        $_SESSION['order'] = "<div class='success text-center'><strong>Order placed successfully</strong></div>";
                        header("location:".SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error text-center'><strong>failed to order food</strong></div>";

                    }

                } 
                
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include("partials-frontend/footer.php") ?>