<?php include('partials-front/menu.php'); ?>

    <!-- shoe sEARCH Section Starts Here -->
    <section class="shoe-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>shoe-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for shoe.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- shoe sEARCH Section Ends Here -->



    <!-- shoeMEnu Section Starts Here -->
    <section class="shoe-menu">
        <div class="container">
            <h2 class="text-center">shoe Menu</h2>

            <?php
              //display shoe that are active
              $sql = "SELECT * FROM tbl_shoe WHERE active='Yes'";

              //execute the query
              $res = mysqli_query($conn,$sql);

              //count rows
              $count = mysqli_num_rows($res);

              //check whether the shoes are available or not
              if($count>0)
              {
                  //Shoe available
                  while($row=mysqli_fetch_assoc($res))
                  {
                      //Get the values 
                      $id = $row['id'];
                      $title = $row['title'];
                      $description = $row['description'];
                      $price = $row['price'];
                      $image_name=$row['image_name'];
                      ?>
                       <div class="shoe-menu-box">
                <div class="shoe-menu-img">
                    <?php
                       //check whether image available or not
                       if($image_name=="")
                       {
                           //image not available
                           echo "<div class='error'>IMage not available.</div>";
                       }
                       else
                       {
                           //image avialable
                           ?>
                             <img src="<?php echo SITEURL; ?>images/shoe/<?php echo $image_name; ?>" alt="crocs" class="img-responsive img-curve">
                           <?php
                       }
                    ?>
                    
                 </div>
     
                 <div class="shoe-menu-desc">
                     <h4><?php echo $title; ?></h4>
                     <p class="shoe-price">Rs.<?php echo $price; ?></p>
                     <p class="shoe-detail"><?php echo $description; ?></p>
                     <br>
                     <a href="<?php echo SITEURL;?>order.php?shoe_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                 </div>
                
             </div>
                      <?php
                  }
              }
              else
              {
                  //Shoe not avialable
                  echo "<div class='error'>Shoe not found.</div>";
              }
            ?>

           
     
             
     
             <div class="clearfix"></div>
     
             
     
            
     
     
         </div>
         </section>
    <!-- shoe Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>