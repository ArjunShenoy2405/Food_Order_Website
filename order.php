    <?php include('partials-front/menu.php'); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <?php
    //Check whether food id is set or not
    if(isset($_GET['food_id']))
    {
        //Get the food id and details of the selected food
        $food_id = $_GET['food_id'];

        //Get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //Check whether the data is available or not
        if($count==1)
        {
            //Get the data from the database
            $row = mysqli_fetch_assoc($res);

            //Get all the details
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to Home page
        header('location:'.SITEURL);
    }
    ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search1">
        <div class="container" data-aos="fade-down-right" data-aos-duration="1500" data-aos-once="true">
            
            <h2 class="text-center text-black">Fill this form to confirm your order</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend >Selected Food</legend>

                    <div class="food-menu-img">
                    <?php
                    //Check whether the image is available or not
                    if($image_name=="")
                    {
                        echo "Image not available";
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                    }
                    ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <p class="food-price">₹<?php echo $price; ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your full name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843XXXXXX" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. xyz@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Door No., Street, City" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

            //Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the details from the form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa"); //Order date and time
                $status = "Ordered"; //Ordered, On-Delivery, Delivered, Cancelled

                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Save the order in database
                $sql2 = "INSERT INTO tbl_order SET
                    food = '$food',
                    price = $price,
                    qty = '$qty',
                    total = '$total',
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                //$sql2; die();

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether Query executed successfully or not
                if($res2==true)
                {
                    //Query executed
                    $_SESSION['order'] = "<div class='text-center' style='color: green;'>Order placed successfully</div>";
                    header('location:'.SITEURL);

                }
                else
                {
                    //Failed to save order
                    $_SESSION['order'] = "<div class='text-center' style='color: red;'>Failed to place the order</div>";
                    header('location:'.SITEURL);
                }
            }

            ?>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
</script>

    <?php include('partials-front/footer.php'); ?>