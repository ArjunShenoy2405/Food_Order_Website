<?php include('partials-front/menu.php'); ?>

<section class="categories">
        <div class="container" data-aos="flip-down" data-aos-duration="800" data-aos-once="true">
            <h2 class="text-center">Cart Details</h2>


            <?php
                //$id = $_GET['food_id'];
                $sql = "SELECT * from tbl_cart";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                ?>  

                <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                </table>

                <?php


                

                }
                else
                {
                    echo "No food in your cart";
                }
                
            ?>
        </div>
</section>

<?php include('partials-front/footer.php'); ?>