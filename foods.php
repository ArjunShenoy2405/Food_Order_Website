    <?php include('partials-front/menu.php'); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container" data-aos="zoom-in-down" data-aos-duration="1000" data-aos-once="true">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container" data-aos="flip-right" data-aos-duration="1500" data-aos-once="true">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Display food that are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count= mysqli_num_rows($res);

                //Check whether the food are available or not
                if($count>0)
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price =  $row['price'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="food-menu-box">
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Buy Online</a>
                                <a href="<?php echo SITEURL; ?>cart-insert.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "Food not available";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
</script>

    <?php include('partials-front/footer.php'); ?>