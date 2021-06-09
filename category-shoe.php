<?php include('partials-front/menu.php'); ?>

    <?php
      //checkwhether id is passed or not
      if(isset($_GET['category_id']))
      {
          //category id is set and get the id
          $category_id = $_GET['category_id'];
          //get the category title based on category id
          $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

          //xecute the query
          $res = mysqli_query($conn,$sql);

          //get the value from the database
          $row = mysqli_fetch_assoc($res);

          //get the title
          $category_title= $row['title'];
      } 
      else
      {
          //category not passed
          //redirect to home page
          header('location:'.SITEURL);
      }
    ?>

    <!-- shoe sEARCH Section Starts Here -->
    <section class="shoe-search text-center">
        <div class="container">
            
            <h2>Shoes on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- shoe sEARCH Section Ends Here -->



    <!-- shoe MEnu Section Starts Here -->
    <section class="shoe-menu">
        <div class="container">
            <h2 class="text-center">Shoe Menu</h2>

            <?php 
               //create sql querry to get shoes based on selected category
               $sql2 = "SELECT * FROM tbl_shoe WHERE category_id=$category_id";

               //execute the query
               $res2 = mysqli_query($conn,$sql2);

               //count the rows
               $count2 = mysqli_num_rows($res2);

               //check whether shoe is available or not
               if($count2>0)
               {
                   //shoe availablew
                   while($row2=mysqli_fetch_assoc($res2))
                   {   $id = $row2['id'];
                       $title=$row2['title'];
                       $price=$row2['price'];
                       $description=$row2['description'];
                       $image_name = $row2['image_name'];
                       ?>
                          <div class="shoe-menu-box">
                          <div class="shoe-menu-img">
                              <?php
                                 if($image_name=="")
                                 {
                                     //image not available
                                     echo "<div class='error'>Image not available.</div>";
                                 }
                                 else{
                                     //image available
                                     ?>
                                       <img src="<?php echo SITEURL?>images/shoe/<?php echo $image_name;?>"  class="img-responsive img-curve">
                                     <?php
                                 }
                              ?>
                           
                            </div>

                                <div class="shoe-menu-desc">
                           <h4><?php echo $title; ?></h4>
                            <p class="shoe-price">RS.<?php echo $price; ?></p>
                            <p class="shoe-detail">
                              <?php echo $description; ?>
                               </p>
                           <br>

                          <a href="<?php echo SITEURL;?>order.php?shoe_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                           </div>
                         </div>
                       <?php
                   }
               }
               else
               {
                   //shoe not available
                   echo "<div class='error'>Shoe not Available.</div>";
               }
            ?>

            

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>