<?php include('partials-front/menu.php')  ?>

<?php 

    //Check if id is passed
    if(isset($_GET['category_id']))
    {
        //Categort ID is set and get the ID
        $category_id = $_GET['category_id'];
        // Get the Category title based on category ID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        //Get the title
        $category_title = $row['title'];
    }
    else
    {
        //Redirect to home page
        header('location:'.SITEURL);  
    }


?>    







<!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);

                $count = mysqli_num_rows($res2);

                if($count>0)
                {
                    //Food is available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        $id = $row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'> Food not available. </div>";
                                    }
                                    else
                                    {
                                        echo "<img src='images/food/".$row["image_name"]."' class='img-responsive' /><br />";
                                    }

                                   
                                ?>
                                <
                            </div>
        
                            <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
        
                                <a href="<?php echo SITEURL; ?>order.php" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                    <?php

                    }

                }
                else
                {
                    //Food not available
                    echo "<div class='error'> Food not available. </div>";
                }











            ?>






            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>