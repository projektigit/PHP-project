<?php include('partials-front/menu.php')  ?>

        <?php 

        //Check if food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the food detalies
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //We have data
                $row = mysqli_fetch_assoc($res);

                $id=$row['id'];
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }
            else
            {
                //Food not available
                header('location:'.SITEURL);
            }


        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }

        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 

                            if($image_name=="")
                            {
                                //Image not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            { 
                                //Image available
                                echo "<img src='images/category/".$row["image_name"]."' class='img-responsive img-curve' /><br />";
                            }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php $title; ?>">
                        <p class="food-price"><?php echo $price?></p>
                        <input type="hidden" name="price" value="<?php $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                //Check if button submit is clicked
                if(isset($_POST['submit']))
                {
                    //Get data from form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $row['qty'] * $row['price']; //total qty * price
                    $order_date = date("Y-m-d- h:i:sa");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_adresse = $_POST['address'];

                    //Save the order in DB
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = price,
                        qty = '$qty',
                        total = '$total',
                        order_date = '$order_date',
                        statuus = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_adresse  = '$customer_adresse'
                    ";

                    echo $sql2, die(); 

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        //Query executed and ordered
                        $_SESSION['order'] = "<div class='success'> Food ordered successfuly. </div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='error'> Failed to order. </div>";
                        header('location:'.SITEURL);
                    }


                }




            ?>




        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php') ?>