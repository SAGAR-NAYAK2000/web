<?php include('partials-front/menu.php'); ?>

   <?php
     //check whether shoe id is set or not
     if(isset($_GET['shoe_id']))
     {
         //get the shoe id and details of the selected shoe
         $shoe_id = $_GET['shoe_id'];

         //get the details odf the selected shoe
         $sql = "SELECT * FROM tbl_shoe WHERE id=$shoe_id";
         //execute the query
         $res = mysqli_query($conn,$sql);
         //count the rows
         $count = mysqli_num_rows($res);
         //check whether the data is available or not
         if($count==1)
         {
             //we have data
             //get the data from db
             $row = mysqli_fetch_assoc($res);
             $title = $row['title'];
             $price = $row['price'];
             $image_name=$row['image_name'];
         }
         else
         {
             //shoe not avialable
             //redirect to home page
             header('location:'.SITEURL);
         }
     }
     else
     {
         //redirect to homepage
         header('location:'>SITEURL);
     }
   ?>

    <!-- shoe sEARCH Section Starts Here -->
    <section class="shoe-search1">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected item</legend>

                    <div class="shoe-menu-img">
                        <?php
                           //check whether the image is avialable ornot
                           if($image_name=="")
                           {
                               //image not available
                               echo "<div class='error'>IMage not available.</div>";
                           }

                           else
                           {
                               //image available
                               ?>

                                <img src="<?php echo SITEURL;?>images/shoe/<?php echo $image_name; ?>" alt="CROCS" class="img-responsive img-curve">
                               <?php
                           }
                        ?>
                        
                    </div>
    
                    <div class="shoe-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="shoe" value="<?php echo $title; ?>">
                        
                        <p class="shoe-price">Rs.<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label ">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Sagar Nayak" class="input-responsive" required>

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
              //chck whether the submit button is clicked or not
              if(isset($_POST['submit']))
              {
                  //get all the details from the form
                  $shoe = $_POST['shoe'];
                  $price = $_POST['price'];
                  $qty = $_POST['qty'];

                  $total = $price * $qty ; //total = price 8 qty

                  $order_date = date("y-m-d h:i:sa");//order date

                  $status = "order"; //order on delivery ,delivered,cancelled

                  $customer_name = $_POST['full-name'];
                  $customer_contact=$_POST['contact'];
                  $customer_email = $_POST['email'];
                  $customer_address = $_POST['address'];

                  //save the order in dataabase
                  //create sql to save the data
                  $sql2 = "INSERT INTO tbl_order SET 
                      shoe='$shoe',
                      price=$price,
                      qty = $qty,
                      total = $total,
                      order_date='$order_date',
                      status = '$status',
                      customer_name='$customer_name',
                      customer_contact='$customer_contact',
                      customer_email='$customer_email',
                      customer_address='$customer_address'
                  ";

                  //echo $sql2; die();

                  //execute the query
                  $res2 = mysqli_query($conn,$sql2);

                  //chwck whether query executed successfully or not
                  if($res2==true)
                  {
                      //qery executed and order saved
                      $_SESSION['order'] = "<div class='success text-center'>Shoe ordered successfully.</div>";
                      header('location:'.SITEURL);
                  }
                  else
                  {
                      //failed to save
                      $_SESSION['order'] = "<div class='error'>Failed to  order shoe.</div>";
                      header('location:'.SITEURL);
                  }
              }
            ?>

        </div>
    </section>
    <!-- SHOE sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>