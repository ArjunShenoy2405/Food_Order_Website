<?php include('partials-front/menu.php'); ?>

<?php

$id = $_GET['food_id'];
$sql = "INSERT INTO tbl_cart SET
                        id = $id,
                        qty = '2'
                    ";
$res = mysqli_query($conn, $sql);
if($res==TRUE)
{
    
    $_SESSION['cart'] = "<div class='text-center' style='color: green;'>Added to cart</div>";
    header('location:'.SITEURL.'index.php');
}
else
{
    echo "Failed to add";
}

?>

<?php include('partials-front/footer.php'); ?>