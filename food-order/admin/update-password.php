<?php include ('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            
            if(isset($_GET['id'])){
                    $id=$_GET['id'];
            }

        ?>


            <form action="" method="POST">

                <table class = "tbl-30">
                    <tr>
                        <td>Old password: </td>
                        <td>
                            <input type="password" name="old_password" placeholder="Current password">
                        </td>
                    </tr>

                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New password">
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" placeholder="Change password" class="btn-secondary">
                        </td>
                    </tr>
                </table>


    
            </form>
    </div>
</div>

<?php 

            //Check to see if the submit botton is clicked or not  
            if(isset($_POST['submit']))
            {
                //echo 'Clicked';

                //1. Get the data from form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                
                //2. Check whether the user exists or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                if($res==TRUE)
                {
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //user exicts
                        echo "User found";
                       
                    }
                    else
                    {
                       $_SESSION['user-not-found'] = "<div class='error'> User not found </div>";
                       //Redirect the user
                       header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }











            }

?>







<?php include ('partials/footer.php') ?>