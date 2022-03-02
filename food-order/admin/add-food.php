<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        
        
        
        ?>





        <form action="" method="POST" enctype="multipart/form-data">
    
        <table class="tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                    <input type="text" name="title" placeholder="Title of the food">
                </td>
            </tr>
            
            <tr>
            <td>Description: </td>
                <td>
                    <textarea name="description" id="" cols="30" rows="5" placeholder="Descriptions of the food"></textarea>
                </td>
            </tr>
           
            <tr>
                <td>Price: </td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select image: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category" >

                        <?php 
                        
                            //Create php to display category from DB
                            //1. Sql querry to get all active categories
                            
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            //Execute the querry
                            $res = mysqli_query($conn, $sql);

                            //Count row to check are we have categories or not
                            $count = mysqli_num_rows($res);

                            //IF count is >0 we have categories
                            if($count>0)
                            {
                                //We have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //Get the value of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?>></option>
                                    
                                    
                                    <?php
                                }
                            }
                            else
                            {
                                //We dont have categories
                                ?>
                                
                                
                                <option value="0">No category found</option>
                                <?php
                            }
                            
                            //2. Display on dropdown

                        ?>



                      
                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured: </td>
                <td>
                    <input type="radio" name= "featured" value="Yes" > Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Active: </td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
                
            

        </table>
    
        
    
        </form>


        <?php 
        
                //Checked if the button is clicked ot not
            if(isset($_POST['submit']))
            {
                //Add food in DB

                //1. Get the data from form
                
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                
                //Check the radio botton is checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting deafult value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];

                }
                else
                {
                    $active = "No"; 
                }

                //2. Upload the image if selected

                //Check if select image is clicked or not and upload image if selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the deta of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Checked is image selected and upload iamge if selected
                    if($image_name !="")
                    {
                        //Image is selected
                        //A. rename the image
                        $ext = (explode('.', $image_name)); //end will select last part of the ext
                        $file_extension = end($ext);
                        //Create a new name for image
                        $image_name = "Food_Name".rand(0000,9999).".".$text; // New image = Food-Name-456
                        //B.Upload the image
                        //Get the Src path and Dest path

                        //Source path is the current location image
                        $src=$_FILES['image']['tmp_name'];

                        //Destionation path
                        $dst = "../images/food".$image_name;

                        //Upload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //Check if image is upload or not
                        if($upload==false)
                        {
                            //Failed to upload the image

                            //Redirect to Add food page with massage
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('Location:'.SITEURL."admin/add-food.php");
                            die();
                        }




                    }
                }
                else
                {
                    $image_name = ""; //Setting default value as blank
                }

                //3. Insert into DB

                //Create sql querry to save or Add food
                //For numerical value we dont need to pass value inside '' but for string you must
                $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                ";

                //execute the sql
                $res2 = mysqli_query($conn, $sql2);

                //4. Redirect with massage
                //if data is insert or not
                if($res2==true)
                {
                    //Data inserted
                    $_SESSION['add'] = "<div class='success'> Food added successfuly</div>";
                    header('Location:'.SITEURL."admin/manage-food.php");
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'> Failed to add food</div>";
                    header('Location:'.SITEURL."admin/manage-food.php");
                }






                
            }
            else
            {

            }
        
        ?>



    </div>
</div>










<?php include('partials/footer.php'); ?>