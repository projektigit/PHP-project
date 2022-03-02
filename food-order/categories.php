<?php include('partials-front/menu.php')  ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
                //Display all the category
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";

                //execute sql
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Category available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id;?>"> <!---- This line is the same for the conn purposes ---->
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name == "")
                                    {
                                        //Image not available
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
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
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php') ?>