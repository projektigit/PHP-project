<?php 

    //Authorization - Access control//
    //Check user is login in or not//
    if(!isset($_SESSION['user'])) //if user seassion is not set//
    {
        //User is not loggen in
        //Redirect to login page with massage
        $_SESSION['no-login-massage'] = "<div class= 'error text-center'> Please login to Admin panel.</div";
        //Redirect to Login page//
        header('location:'.SITEURL.'admin/login.php');
    }


?>