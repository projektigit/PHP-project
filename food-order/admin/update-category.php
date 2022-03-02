<?php include ('partials/menu.php') ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php 
        
            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                //Create sql querry to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the querry
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to manage category with massage
                    $_SESSION['No category found'] = "<div class = 'error'>Category not found. </div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //redirect to manage categopry
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        ?>
        
        
        
        
        
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class ="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php 
                            if($current_image !="")
                            {
                                //Display the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px";>
                                <?php
                            }
                            else
                            {
                                //Display the massage
                                echo "<div class = 'error'> Image not added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>

                </tr>
                <tr>
                   <td>
                        <input type="hidden" name="current_image" value="<?php echo "$current_image";?>">
                        <input type="hidden" name="id" value="<?php echo "$id";?>">
                        <input type="submit" name="submit" value="update-category" class="btn-secondary">    
                   </td>
                </tr>
                    
                
            </table>
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //1.Get all the vaules from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Updating new image 
                //Check is image selected or not
                if(isset($_FILES['image']['name']))
                {
                    //Get the image detiles
                    $image_name = $_FILES['image']['name'];

                    //CHeck is image is available
                    if($image_name !="")
                    {
                        //image available
                        //A. Upload the new image


                        //Auto rename our image
                            //Get the extension of our image (jpg) 
                            $ext = (explode('.', $image_name));
                            $fileExtension = end($ext);
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
                                header('location:'.SITEURL.'admin/manage-category.php');
                                //Stop the process
                                die();
                            }

                        //B. remove the current image if available
                        if($current_image == "")
                        {
                            $remove_path = "../images/category".$current_image;
                            
                        
                            $remove = unlink($remove_path);
    
                            //Check image is removed or not
                            // if failed to remove then display massage and stop the process
                            if($remove==false)
                            {
                                //failed to remove the image
                                $_SESSION['failed-remove'] = "<div class = 'error'> Failed to remove current image.</div>";
                                header('Location:'.SITEURL.'admin/manage-category.php');
                                die(); //Stop the process
                            }
                        }
                        
                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }


                //3. Update DB
                $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id = '$id'";
                
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect to manage-category
                //Checked if executed or not
                if($res2==TRUE)
                {
                    //Category updated
                    $_SESSION['update'] = "<div class = 'success'> Category update successfuly. </div>";
                    header('location:'.SITEURL."admin/manage-category.php");
                }
                else
                {
                    //Failed to update category
                    $_SESSION['update'] = "<div class = 'error'> Failed to update successfuly. </div>";
                    header('location:'.SITEURL."admin/manage-category.php");
                }

            }
        
        ?>






    </div>
</div>









<?php include ('partials/footer.php') ?>

