<?php   include('partials/menu.php')?>


        <!----- Main Content start here ----->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Dashboard</h1>

                <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                ?>
                <br><br>



            <div class="col-4 text-center">

                <?php 
                    //Sql query
                    $sql = "SELECT * FROM tbl_category";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);
                
                ?>
                <h1><?php echo $count;?></h1>
                <br />
                Categories
            </div>

            <div class="col-4 text-center">

                <?php 
                    //Sql query
                    $sql2 = "SELECT * FROM tbl_food";

                    $res2 = mysqli_query($conn, $sql2);

                    $count2 = mysqli_num_rows($res2);
                
                ?>

                <h1><?php echo $count2; ?></h1>
                <br />
                Foods
            </div>

            <div class="col-4 text-center">

                <?php 
                    //Sql query
                    $sql3 = "SELECT * FROM tbl_order";

                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);
                
                ?>

                <h1><?php echo $count3;?></h1>
                <br />
                Total Orders
            </div>

            <div class="col-4 text-center">

                <?php 
                
                    //Create sql querry to get revenue
                    //Aggregate function in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order ";

                    //eXECUTE THE QUERRY
                    $res4 = mysqli_query($conn, $sql4);

                    //Get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    //Get the revenue
                    $total_revenue = $row4['Total'];
                
                ?>

                <h1>$<?php echo $total_revenue; ?></h1>
                <br />
                Revenue
            </div>

            <div class="clearfix"></div>

        </div>

        <!----- Main content end here ----->



<?php include('partials/footer.php')?>