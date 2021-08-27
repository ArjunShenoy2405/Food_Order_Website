<?php include('partials-front/menu.php'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/alternate.css">
<style>
    .checked
    {
        color: orange;
    }
</style>

<form action="" method="POST" class="text-center">

<table class="tbl-rate">
        <tr>
        <td>Quality & Taste:</td>
        <td>
        <input type="radio" name="qualtaste" value="1"> 1
        <input type="radio" name="qualtaste" value="2"> 2
        <input type="radio" name="qualtaste" value="3"> 3 
        <input type="radio" name="qualtaste" value="4"> 4
        <input type="radio" name="qualtaste" value="5"> 5
        </td>
        </tr>

        <tr>
        <td>Hygiene:</td>
        <td>
        <input type="radio" name="hygiene" value="1"> 1
        <input type="radio" name="hygiene" value="2"> 2
        <input type="radio" name="hygiene" value="3"> 3 
        <input type="radio" name="hygiene" value="4"> 4
        <input type="radio" name="hygiene" value="5"> 5
        </td>
        </tr>

        <tr>
        <td>Delivery:</td>
        <td>
        <input type="radio" name="delivery" value="1"> 1
        <input type="radio" name="delivery" value="2"> 2
        <input type="radio" name="delivery" value="3"> 3 
        <input type="radio" name="delivery" value="4"> 4
        <input type="radio" name="delivery" value="5"> 5
        </td>
        </tr>

        <tr>
        <td>Overall:</td>
        <td>
        <input type="radio" name="overall" value="1"> 1
        <input type="radio" name="overall" value="2"> 2
        <input type="radio" name="overall" value="3"> 3 
        <input type="radio" name="overall" value="4"> 4
        <input type="radio" name="overall" value="5"> 5
        </td>
        </tr>

        <tr>
            <td>Suggestion:</td>
            <td>
                <textarea name="suggestion" cols="20" rows="5" placeholder="Type your valuable suggestion"></textarea>
            </td>
        </tr>

        <tr>
            <td><input type="submit" name="submit" value="Submit"></td>
        </tr>

</table>
</form>


<?php

    if(isset($_POST['submit']))
    {
        $id = $_GET['id'];

        if(isset($_POST['qualtaste']))
        {
            $qualtaste = $_POST['qualtaste'];
        }
        else
        {
            $qualtaste = 0;
        }
        if(isset($_POST['hygiene']))
        {
            $hygiene = $_POST['hygiene'];
        }
        else
        {
            $hygiene = 0;
        }
        if(isset($_POST['delivery']))
        {
            $delivery = $_POST['delivery'];
        }
        else
        {
            $delivery = 0;
        }
        if(isset($_POST['overall']))
        {
            $overall = $_POST['overall'];
        }
        else
        {
            $overall = 0;
        }
        $suggestion= $_POST['suggestion'];
        if($suggestion!=NULL)
        {
            $sql = "INSERT INTO tbl_review SET
                        id = $id,
                        suggestion = '$suggestion',
                        qualtaste = $qualtaste,
                        hygiene = $hygiene,
                        delivery = $delivery,
                        overall = $overall
                    ";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE)
            {
                //echo "Success";
                $_SESSION['review'] = "Thank you for reviewing us!";
                header('location:'.SITEURL.'index.php');
            }
            else
            {
                //echo "Failure";
            }
        }
        else
        {
            echo "Please type your valuable suggestion";
        }
        

    }

?>


<?php include('partials-front/footer.php'); ?>