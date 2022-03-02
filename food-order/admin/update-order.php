<?php include ('partials/menu.php'); ?>

<div class= "main-content">
    <div class = "wrapper">
        <h1>Update order</h1>
        <br><br>

        <?php

            //check if id is set or not
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                //Sql querry to get all the detail
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_fetch_assoc($res);

                if($count==1)
                {
                    //Detail available
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $ccustomer_addresse = $row['customer_addresse'];

                }
                else
                {
                    // Not available and redirect to home
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }



        ?>






        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food name</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?></b></td>

                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="On delivery">On delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="">
                    </td>
                </tr>

                <tr>
                    <td>Customer address</td>
                    <td>
                        <textarea name="customer_address" id="" cols="30" rows="5"></textarea>
                    </td>
                </tr>





                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class= "btn-secondary">
                    </td>
                <tr>

                </tr>


            </table>



        </form>






    </div>
</div>


<?php include ('partials/footer.php'); ?>