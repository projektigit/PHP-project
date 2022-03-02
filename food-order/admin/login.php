<?php include('../config/constants.php') ?>


<html>
    <head>
        <title>Login - Food order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1> <br> <br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-massage']))
                {
                    echo $_SESSION['no-login-massage'];
                    unset($_SESSION['no-login-massage']);
                }
            
            
            ?>

            <br><br>

            <!---- Login form start here ----->
            <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"> <br> <br>
            
            Password: <br>
            <input type="password" name="password" placeholder="Password"> <br> <br>
            
            <input type="submit" name="submit" value="Login" class="btn-primary">

                <br><br>

            <button type="submit" formaction="http://localhost/food-order/" class="btn-primary">Back to site</button>

            </form>

            <!------ Login form ends here ----->

            <br>
            <p class="text-center">Created by Marko Stefanovic</p>
        </div>
    </body>


</html>

<?php 

    //Check if the submit botton is clicked //
    if(isset($_POST['submit']))
    {
        // Process for Login form//
        //1. Get the data from Login //
        $username = $_POST['username'];
        $password = md5($_POST['username']);

        //2. SQL to check whether username and paswword exists or not//
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //3. Execute the query//
        $res = mysqli_query($conn, $sql);

        //4. Count rows to check is user exists or not//
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User Avaiable and Login Success//
            $_SESSION['login'] = "<div class='success'>Login Successful.</div";
            $_SESSION['user'] = $username; //To check is user login or not and logout will unset it//
            //Redirect to Home page/ Dashboard//
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available Login fail//
            $_SESSION['login'] = "<div class='error text-center'>Username and Password did not match.</div";
            //Redirect to Home page/ Dashboard//
            header('location:'.SITEURL.'admin/login.php');
        }


    }


?>