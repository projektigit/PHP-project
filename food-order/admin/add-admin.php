<?php include('partials/menu.php');?>

<div class="main-content"></div>
<div class="wrapper">
    <h1>Add Admin</h1>

    <br /><br /> 


    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; 
            unset($_SESSION['add']); //Removing massage
        }
    ?> 

    <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name: </td>
                <td>
                    <input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
            </tr>

            <tr>
                <td>Username: </td>
                <td>
                    <input type="text" name="username" placeholder="Your Username">
                </td>
            </tr>

            <tr>
                <td>Password: </td>
                <td>
                    <input type="password" name="password" placeholder="Your Password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>

        </table>

    </form>


</div>




<?php include('partials/footer.php');?>




<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        //Button clicked
        //echo "Button Clicked";
    }
    

        //Get the Data from form
        $full_name = $_POST['full_name'] ??'';
        $username = $_POST['username'] ??'';
        $password = md5($_POST['password'] ??''); //Encryption with md5

        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";


        //3. Executing query and saving in database
       $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));


        //4. Check whether the (query is executed) data is inserted or not and display message

        if($res==TRUE)
        {
            echo "Data Inserted";
            //Create a Sesion Variable to display massage
            //$_SESSION['add'] = "Admin Added Successfully";
            //redirect page to manage Admin
            //header("location:".SITEURL.'admin/manage-admin.php');
            
            
        }
        else
        {
            echo "Failed to Insert Data";
            //$_SESSION['add'] = "Failed to Add Admin";
            //redirect page to Add Admin
            //header("location:".SITEURL.'admin/add-admin.php');
            
        }



?>



