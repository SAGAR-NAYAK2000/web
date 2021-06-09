<?php include('partials-front/menu.php'); ?>

    <!-- Shoe sEARCH Section Starts Here -->
    <section class="shoe-search text-center">
        <div class="container">
        <?php
            //get the search keyword
            $search = $_POST['search'];
        ?>
            
            <h2 class="text-blue">shoes on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Shoe sEARCH Section Ends Here -->



    <!-- shoe MEnu Section Starts Here -->
    <section class="shoe-menu">
        <div class="container">
            <h2 class="text-center">Shoe Menu</h2>

            <?php 
              

              //sql query to get shoe based on search keyword
              $sql = "SELECT * FROM tbl_shoe WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
              //Execute the query
              $res = mysqli_query($conn,$sql);

              //count rows 
              $count = mysqli_num_rows($res);

              //check whether shoe available or not
              if($count>0)
              {
                  //shoe available
                  while($row=mysqli_fetch_assoc($res))
                  {
                      //get the details 
                      $id=$row['id'];
                      $title = $row['title'];
                      $price = $row['price'];
                      $description = $row['description'];
                      $image_name = $row['image_name'];
                      ?>
                       <div class="shoe-menu-box">
                            <div class="shoe-menu-img">
                            <?php
                               //check whether the image name is available or not
                               if($image_name=="")
                               {
                                   //image not available
                                   echo "<div class='error'>Image not available.</div>";
                               }
                               else
                               {
                                   //image available
                                   ?>
                                       <img src="<?php echo SITEURL; ?>images/shoe/<?php echo $image_name; ?>" alt="Best LEAther shoe" class="img-responsive img-curve">
                                   <?php
                               }
                            ?>
                              
                            </div>

                         <div class="shoe-menu-desc">
                         <h4><?php echo $title; ?></h4>
                         <p class="shoe-price">Rs.<?php echo $price; ?></p>
                         <p class="shoe-detail">
                          <?php echo $description; ?>
                         </p>
                         <br>

                          <a href="#" class="btn btn-primary">Order Now</a>
                          </div>
                        </div>
                      <?php
                  }
              }
              else
              {
                  //shoe not available
                  echo "<div class='error'>Shoe not found.</div>";
              }
            ?>

            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- shoe Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>