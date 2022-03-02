<?php 
    //Start Session
    session_start();


    //Create constants to store non repeatin vaules
    define('SITEURL', 'http://localhost/food-order/');
    define('LOCALHOST', 'localhost:3306');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
     
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
    
    $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error($conn));

?>