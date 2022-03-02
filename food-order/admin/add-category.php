<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!----- Add category form Starts ---->

        <form action="" method="POST" enctype="multipart/form-data"> <!----- 'enctype' allow as to upload file image---->

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No">  No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No">  No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>



            </table>

        </form>
        <!----- Add category form Ends ---->

        <?php 
        
            //Check wheter Submit batton is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";

                //1. Get the value from Category form
                $title = $_POST['title'];

                //For radio input, we need to check is button is selected or not
                if(isset($_POST['featured']))
                {
                        //Get the value from form
                        $featured = $_POST['featured'];
                }
                else
                {
                        //Set the default Value
                        $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = 'No';
                }

                    //check wheter image is selected or not and set the value for image name accoridinly
                    //print_r($_FILES['image']);

                    //die(); //break the code here

                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        //To upload we need image name, source parh and destination path
                        $image_name = $_FILES['image']['name'];

                        //Upload image only if the image is selected
                        if($image_name !="")
                        {

                        
                            //Auto rename our image
                            //Get the extension of our image (jpg) 
                            $ext = end(explode('.', $image_name));

                            //Rename the image
                            $image_name = "Food_category_".rand(000,999).'.'.$ext; // e.g. Food_Category_456.jpg
                            
                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            //Upload image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //Check whether image is upload or not, if image is not upload we will stop the proces and redirect error massage
                            if($upload==false)
                            {
                                //set massage
                                $_SESSION['upload'] = "<div class = 'error'> Failed to upload image. </div>";
                                // Redirect to Add category page
                                header('location:'.SITEURL.'admin/add-category.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        //Dont upload image and set the image_name value as blank
                        $image_name="";
                    }


                    //2. Create sql query to insert Category into database
                    $sql = "INSERT INTO tbl_category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    ";

                    //3. Execute the query
                    $res = mysqli_query($conn, $sql);

                    //4. Check the query executed or not and data added or not
                    if($res==true)
                    {
                        //Query executed and Category Added
                        $_SESSION['add'] = "<div class='success'> Category Added Successfully.</div>";
                        //Redirect category to Category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        //Failed to Add Category
                        $_SESSION['add'] = "<div class='error'> Failed to Add Category.</div>";
                        //Redirect category to Category page
                        header('location:'.SITEURL.'admin/add-category.php');
                    }










            }   
        
        ?>



    </div>



</div>

<?php include('partials/footer.php'); ?>