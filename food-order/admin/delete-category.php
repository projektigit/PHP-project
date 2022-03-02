<?php 
    include('../config/constants.php');
    
    //Check whether the id and image_name vaule it set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the vaule and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //Remove the image file is available
        if($image_name !="")
        {
            //Image is Available so remove it
            $path = "../images/category".$image_name;
            //remove the image
            unlink($path);

            //if failed to remove image then add an error massage and stop the proces
            if($remove==false)
            {
                $_SESSION['remove'] = "<div class='error'> Failed to remove Category image.</div>";
                
                header('location:'.SITEURL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        //Delete data from DB
        $sql = "DELETE FROM tbl_category WHERE id=$id";  
        
        //execute the querry
        $res = mysqli_query($conn, $sql);

        //Check if the data is delete from DB
        if($res==TRUE)
        {
            // Set success massage and redirect
            $_SESSION['delete'] = "<div class='success'> Category deleted successfuly.</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set fail massage and redirect
            $_SESSION['delete'] = "<div class='error'> Failed to delete category.</div>";
            //Redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        //Redirect to manage category with masage
    }
    else
    {
        //Redirect to manage Category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>