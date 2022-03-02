<?php 
    include ('../config/constants.php');

    // 1. get the ID of admin to be delited
     
    $id = $_GET['id'];
    
    
     // 2. Create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check the query
    if($res==TRUE){

        //echo "admin deleted";
        //Create season to display massage
        $_SESSION['delete'] = "<div class = 'success'>Admin deleted successfuly </div>";

        header('location:'.SITEURL. 'admin/manage-admin.php');

    }   
    else {
        //failed to delete admin
        //echo "failed to delete";

        $_SESSION['delete'] = "<div class='error'>Failed to delele admin. Try again later </div>";

        header('location:'.SITEURL. 'admin/manage-admin.php');
    }
    
    


?>