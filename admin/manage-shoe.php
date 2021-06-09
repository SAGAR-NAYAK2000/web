<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
       <h1>Manage Shoe</h1>

       <br> <br> <br>

       <!--Button to Add admin-->
                
       <a href="<?php echo SITEURL;?>admin/add-shoe.php" class="btn-primary">Add Shoe</a>

       <br> <br> <br>

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

         if(isset($_SESSION['upload']))
         {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
         }

         if(isset($_SESSION['unauthorize']))
         {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
         }

         if(isset($_SESSION['update']))
         {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
         }
       ?>

                 <table class="tbl-full">
                    <tr>
                      <th>S.N.</th>
                      <th>Title</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Featured</th>
                      <th>Active</th>
                      <th>Actions</th>
                    </tr>
                    <?php
                      //create sql querry to get all the shoe
                      $sql = "SELECT * FROM tbl_shoe";

                      //execute the query
                      $res = mysqli_query($conn,$sql);

                      //count rows to check whether we have foods or  not
                      $count = mysqli_num_rows($res);

                      //create serial number variable and set default value as 1
                      $sn = 1;

                      if($count>0)
                      {
                         //we have shoe in database
                         //Get the shoe from database and display
                         while($row = mysqli_fetch_assoc($res))
                         {
                            //get the value from individual columns
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                     <tr>
                       <td><?php echo $sn++; ?></td>
                       <td><?php echo $title; ?></td>
                       <td><?php echo $price; ?></td>
                       <td><?php 
                          //check whether we have image or not
                          if($image_name=="")
                          {
                             //we dont have image display error message
                             echo "<div class='error'>Image not added.</div>";
                          }
                          else
                          {
                             //we have image, display image
                             ?>

                             <img src="<?php echo SITEURL; ?>images/shoe/<?php echo $image_name; ?>" width = "100px" >
                             <?php
                          }
                       ?></td>
                       <td><?php echo $featured; ?></td>
                       <td><?php echo $active; ?></td>
                       <td>
                         <a href="<?php echo SITEURL; ?>admin/update-shoe.php?id=<?php echo $id;?>" class="btn-secondary">Update Shoe</a>
                         <a href="<?php echo SITEURL; ?>admin/delete-shoe.php?id=<?php echo $id;?> &image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Shoe</a>
                       </td>
                    </tr>


                            <?php
                         }
                      }
                      else
                      {
                         //shoe not added in the database
                         echo "<tr><td colspan='7' class= 'error'>Shoe Not Added Yet.</td></tr>";
                      }
                    ?>
                 

                    
                 </table>
    </div>
</div>

<?php include('partials/footer.php')?>