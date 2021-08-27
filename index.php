<?php include('partials-front/menu.php') ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container" data-aos="zoom-in-down" data-aos-duration="1000" data-aos-once="true">
            
            <form action="<?php echo SITEURL; ?>food-search.php?" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php

    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    if(isset($_SESSION['review']))
    {
        echo $_SESSION['review'];
        unset($_SESSION['review']);
    }
    if(isset($_SESSION['cart']))
    {
        echo $_SESSION['cart'];
        unset($_SESSION['cart']);
    }

    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container" data-aos="fade-right" data-aos-duration="1000">
            <h2 class="text-center">Explore Category</h2>

            <?php
                //Create SQl Query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name =  $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                            <?php
                                //Check whether image is available or not
                                if($image_name=="")
                                {
                                    echo "Image not available";
                                }
                                else
                                {
                                    //Image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>    
                            
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "Category not added";
                }
            ?>

            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php">More Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container" data-aos="flip-right" data-aos-duration="1500" data-aos-once="true">
            <h2 class="text-center">Explore Food</h2>

            <?php  

                //Getting food from database that are active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows
                $count2 = mysqli_num_rows($res2);

                //Check whether food is available or not
                if($count2>0)
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name  = $row['image_name'];
                        ?>
                        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //Check whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
                                        echo "Image not available";
                                    }
                                    else
                                    {
                                        //Image available
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
                    //Food not available
                    echo "Food not available";
                }

            ?>

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">More Food</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
</script>

    <?php include('partials-front/footer.php'); ?>

