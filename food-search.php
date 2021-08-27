    <?php include('partials-front/menu.php'); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container" data-aos="zoom-in" data-aos-duration="1200" data-aos-once="true">

        <?php
            //Get the search keyword
            //$search = $_POST['search'];
            $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container" data-aos="slide-left" data-aos-duration="1200" data-aos-once="true">
            <h2 class="text-center">Food Menu</h2>

            <?php
                
                //SQL Query to get food based on search keyword 
                //Let's assume $search = South'
                //Then $sql="Select * FROM tbl_food WHERE title LIKE '%South'%' OR description LIKE '%South'%'";
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check whether food available or not
                if($count>0)
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details of food
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
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
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">₹<?php echo $price ?></p>
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
                    echo "Food not found";
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