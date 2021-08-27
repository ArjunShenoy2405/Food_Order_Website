<?php include('partials-front/menu.php'); ?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container" data-aos="flip-down" data-aos-duration="800" data-aos-once="true">
            <h2 class="text-center">Categories Menu</h2>

            <?php
                //Create SQl Query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

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
    </section>
    <!-- Categories Section Ends Here -->

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
</script>

<?php include('partials-front/footer.php'); ?>




        