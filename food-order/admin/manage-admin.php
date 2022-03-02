<?php include('partials/menu.php')?>
    <!----- Main Content pocinje ovde ----->
        <div class="main-content">
            <div class="wrapper"> 
                <h1>Manage Admin</h1>
               
                <br />
                

                

                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; 
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }



                ?> 
                <br>
                <br />
                <br />

                <!---- Button to Add Admin ---->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                
                <br />
                <br />
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                            
                            //Execute the Query
                            $res = mysqli_query($conn, "SELECT * FROM tbl_admin");

                            $sn=1; 

                            if(mysqli_num_rows($res) > 0)
                                {
    

                                        //We have data in database
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            //Using while to get all the data from database
                                            $id=$rows['id'];
                                            $full_name=$rows['full_name'];
                                            $username=$rows['username'];

                                        //display the vaules in our table
                                        ?>

                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name ?></td>
                                            <td><?php echo $username  ?></td>
                                            <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id?>" class= "btn-primary"> Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                                            </td>
                                        </tr> 



                                        <?php

             

                                        }

                                        
                                    
                                    
                                }
                                
                                else {
                                    echo "No data do display";
                                }
                                        
                        ?>

                                        

                                        
        

                </table>


            </div>
        </div>

    <!----- Main Content zavrsava ovde ----->

<?php include('partials/footer.php')?>