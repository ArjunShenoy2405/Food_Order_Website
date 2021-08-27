<?php include('partials-front/menu.php'); ?>
<html>
<div class="main-content1" class="animation">
    <div class="wrapper1">
        <br>
        <h2 class="title">Tell the world how you feel...!</h2>
        <br><br>

        <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
        ?>
        <br><br>

        <form action="" method="POST" class="text-center">
            Enter your Phone Number: <input type="text" name="phone" placeholder="Registered phone number">
            <input type="submit" name="submit" value="Proceed" class="unique" style="height:22px; width:60px">
            <br><br><br>
        </form>
</html>


<?php
    if(isset($_POST['submit']))
    {
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);

        $sql = "SELECT * from tbl_order  WHERE customer_contact='$phone'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if($count>=1)
        {
            ?>
            <table class="tbl-full1">
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                
                <th></th>
                <th></th>
                <th></th>
                
              </tr>

              <?php
              
                $sql = "SELECT * FROM tbl_order WHERE customer_contact='$phone' ORDER BY id DESC"; //Display the latest order first

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows
                $count = mysqli_num_rows($res);

                $sn=1; //Incremental variable

                if($count>0)
                {
                  //Order available
                  while($row=mysqli_fetch_assoc($res))
                  {
                    //Get all the order details from the database
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    //$total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    //$customer_contact = $row['customer_contact'];
                    //$customer_email = $row['customer_email'];
                    //$customer_address =  $row['customer_address'];

                    ?>

                    <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $food; ?></td>
                      <td><?php echo $price; ?></td>
                      <td><?php echo $qty; ?></td>
                      
                      <td><?php echo $order_date; ?></td>

                      <td>
                        <?php
                          if($status=="Ordered")
                          {
                            echo "<label>$status</label>";
                          }
                          elseif($status=="On Delivery")
                          {
                            echo "<label style='color: orange;'>$status</label>";
                          }
                          elseif($status=="Delivered")
                          {
                            echo "<label style='color: green;'>$status</label>";
                          }
                          elseif($status=="Cancelled")
                          {
                            echo "<label style='color: red;'>$status</label>";
                          }
                        ?>
                      </td>

                      <td><?php echo $customer_name; ?></td>
                      
                      <td>
                        <a href="<?php echo SITEURL; ?>review.php?id=<?php echo $id; ?>" class="unique">Review this food</a>
                      </td>

                    </tr>
                  

                    <?php
                  }
                }
                else
                {
                  //Order not available
                  echo "<tr><td colspan='12'>Orders not available</td></tr>";
                }
              ?>

            </table>
<?php
        }
        else
        {
            $_SESSION['order'] = "<div class='text-center' style='color: red;'>No order found</div>";
            //Redirect to Home Page
            header('location:'.SITEURL.'order-review.php');
        }
    }
?>
<br>
</div>
</div>

<?php include('partials-front/footer.php'); ?>