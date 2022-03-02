<?php include('partials/menu.php') ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
        
            $id=$_GET['id'];

            $sql="SELECT * FROM tbl_admin WHERE id=$id";


            $res=mysqli_query($conn, $sql);

            if($res==TRUE)
            {
                $count = mysqli_num_rows($res);

                //check thether we have admin or not
                if($count==1)
                {
                    //echo "Admin Avialable";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>

        <form action="" method="POST">
            
            <table class = "tbl_30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan ="2">
                        <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>











            </table>
        </form>



    </div>
</div>

<?php 

            //check if the submit button is clicked or not
            if(isset($_POST['submit'])){
                
                //Get all the values from form to update
                $id = $_POST['id'];
                $full_name = $_POST['full_name'];
                $username = $_POST['username'];

                //Create a SQL query to update admin
                $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                username = '$username'
                WHERE id='$id'
                ";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //check if execute or not
                if($res==TRUE)
                {
                    //query executed and admin updated
                    $_SESSION['update'] = "<div class = 'success'>Admin Updated successfuly </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    //failed to update admin
                    $_SESSION['update'] = "<div class = 'error'>Failed to Delete Admin </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }


            }

?>



<?php include('partials/footer.php') ?>