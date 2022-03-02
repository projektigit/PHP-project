<?php include('partials-front/menu.php')  ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php 
            
            //Create sql querry to display categories from DB
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                   
                
                    ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>">
                    
                            <div class="box-3 float-container">
                                <?php
                                    //Check if the image is available or not 
                                      
                                    if($image_name = "")
                                    {
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                   else                                        {
                                         //Image available
                                        echo "<img src='images/category/".$row["image_name"]."' class='img-responsive' /><br />";
                                        
                                    }
                                ?>

                            

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>    

                <?php
                

            }

            }
            else
            {
                //category not available
                echo "<div class='error'> Category not available. </div>";
            }


        
            ?>

            
            <form action="<?php echo SITEURL; ?>/food-search.php" method="POST"> 
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php

        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                //Getting food from DB
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0 )
                {
                    //Food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get all the vaules
                        $id=$row['id'];
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
                                            echo "<div class='error'> Image not available. </div>";
                                        }
                                        else
                                        {
                                           //Image available 
                                           echo "<img src='images/food/".$row["image_name"]."' class='img-responsive img-curve' /><br />'";
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                                </div>
                        </div>




                        <?php

                    }
                }
                else
                {
                    //Not available
                    echo "<div class='error'> Food not available. </div>";
                }
            
            
            
            ?>

            <div class="clearfix"></div>   

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php') ?>