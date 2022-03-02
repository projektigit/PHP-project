<?php include ('../config/constants.php') ?>

<?php 

    if(isset($_GET['id']) && isset($_GET['image_name']))
    {
        //Process to delete
        //1. Get ID and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        //2. Remove the image
        if($image_name != "")
        {
            //image path
            $path = "../images/food/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //Check if the image is removed
            if($remove==false)
            {
                //Failed to delete
                $_SESSION['upload'] = "<div class = 'error'> Failed to remove image.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();

            }

        }

        //3. Delete food from DB
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //execute the querry
        $res = mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class = 'success'>Food deleted</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to delete food
            $_SESSION['delete'] = "<div class = 'error'>Failed to delete food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        
    }
    else
    {
        //Redirect to manage-food page
        $_SESSION['unauthorize'] = "<div class = 'error'> Unauhorized access </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }



?>








