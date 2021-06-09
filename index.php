<?php include('partials-front/menu.php'); ?>

    <!--Shoe search section starts here-->
    <section class="shoe-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>shoe-search.php" method="POST">
            <input type="search" name="search" placeholder="search for shoe.."> 
            <input type="submit" name="submit" value="search" class="btn btn-primary">
        </form>
    </div>
    </section>
    <!--Shoe search section ends here-->

    <?php
       if(isset($_SESSION['order']))
       {
           echo $_SESSION['order'];
           unset($_SESSION['order']);
       }
    ?>
      
    <!--categories section starts here-->
    <section class="categories">
    <div class="container">
        <h2 class ="text-center">Categories</h2>
         
        <?php
           //create sql to display categories from database
           $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
           //execute the query
           $res = mysqli_query($conn,$sql);
            //count to check whether the category is available or not
           $count = mysqli_num_rows($res);

           if($count>0)
           {
               //categories available
               while($row=mysqli_fetch_assoc($res))
               {
                   //get the values like id,title,image
                   $id = $row['id'];
                   $title = $row['title'];
                   $image_name = $row['image_name'];
                   ?>
                   <a href="<?php echo SITEURL; ?>category-shoe.php?category_id=<?php echo $id; ?>">
                   <div class="box-3 float-container">
                       <?php
                       //check whether the image is available or not 
                          if($image_name=="")
                          {
                              //display the messsage
                              echo "<div class='error'>Image Not Available.</div>";
                          }
                          else
                          {
                              //image available
                              ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" alt="crocs" class="img-responsive img-curve">
                              <?php
                          }
                       ?>
                   
                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                   </div>
                   </a>
        
                   <?php
               }
           }
           else
           {
               //categories not available
               echo "<div class='error'>Category Not Added.</div>";
           }
        ?>
        
        

        

          <div class="clearfix"></div>

    </div>
    </section>
    <!--categories section ends here-->

    <!--shoe menu section starts here-->
    <section class="shoe-menu">
    <div class="container">
        <h2 class="text-center">Explore shoes</h2>

        <?php
           
           //getting shoes from database that are active and featured
           //sql query
           $sql2 = "SELECT * FROM tbl_shoe WHERE active='Yes' AND featured='Yes' LIMIT 6";

           //execute the query
           $res2 = mysqli_query($conn,$sql2);

           //count the rows
           $count2 = mysqli_num_rows($res2);

           //check whether she available or not
           if($count2>0)
           {
               //shoe available
               while($row=mysqli_fetch_assoc($res2))
               {
                   //Get all the values
                   $id =$row['id'];
                   $title = $row['title'];
                   $price = $row['price'];
                   $description = $row['description'];
                   $image_name = $row['image_name'];
                   ?>

          <div class="shoe-menu-box">
            <div class="shoe-menu-img">
                <?php
                  //check whether image avialable or not
                  if($image_name=="")
                  {
                      //image not avaialble
                      echo "<div class='error'>Image not available.</div>";
                  }
                  else
                  {
                      //image available
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
               //shoe not avialable
               echo "<div class='error'>Shoe not available.</div>";
           }

        ?>


        <div class="clearfix"></div>


    </div>
    </section>
    <!--shoe menu section ends here-->



    <?php include('partials-front/footer.php'); ?>