<?php include("partials/menu.php")?>

<div class="main-content">
    <div class="wrapper">
        <h1>Order</h1>

        <br />
                <br />

                <!---- Button to Add Admin ---->
                <a href="#" class="btn-primary"></a>
                
                <br />
                <br />
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>

                    </tr>

                    <?php

                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create

                        if($count>0)
                        {
                            //order available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td></td>
                                        <td><?php echo $total; ?></td></td>
                                        <td><?php echo $status; ?></td></td>
                                        <td><?php echo $customer_name; ?></td></td>
                                        <td><?php echo $customer_contact; ?></td></td>
                                        <td><?php echo $customer_email; ?></td></td>
                                        <td><?php echo $customer_address; ?></td></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                        </td>
                                    </tr>

                                <?php





                            }
                        }
                        else
                        {
                            echo "<tr><td rd coldspan='12' class'error'> Orders not available. </td></tr>";
                        }

                    ?>

                    

                    


                </table>

        </div>
</div>
        
    


<?php include("partials/footer.php")?>