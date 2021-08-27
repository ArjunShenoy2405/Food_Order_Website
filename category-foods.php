    <?php include('partials-front/menu.php'); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <?php
        //Check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            //Get the category title
            $sql = "SELECT title FROM tbl_category WHERE id='$category_id'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from database
            $row = mysqli_fetch_assoc($res);

            $category_title = $row['title'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container" data-aos="zoom-in" data-aos-duration="1200">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container" data-aos="slide-left" data-aos-duration="1000" data-aos-once="true">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Create SQL Query to get food based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id OR title LIKE '%$category_title%' OR description LIKE '%$category_title%'";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the row
                $count2 = mysqli_num_rows($res2);

                //Check whether food is available or not
                if($count2>0)
                {
                    //Food is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                if($image_name=="")
                                {
                                    //Image not available
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
    <!-- Food Menu Ends Here -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
</script>

    <?php include('partials-front/footer.php'); ?>