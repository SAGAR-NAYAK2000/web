<?php include('partials/menu.php'); ?>

<div class = "main-content">
    <div class="wrapper">
       <h1>Add Shoe</h1>

       <br><br>

       <?php
        if(isset($_SESSION['upload']))
        {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }
       ?>

       <form action="" method="POST" enctype="multipart/form-data">
          
           <table class="tbl-30">
              <tr>
                 <td>Title:</td>
                 <td>
                    <input type="text" name="title" placeholder="Title of the food">
                 </td>
              </tr>

              <tr>
                 <td>Description:</td>
                 <td>
                   <textarea name="description"  cols="30" rows="5" placeholder="Description of the food"></textarea>
                 </td>
              </tr>

              <tr>
                <td>Price:</td>
                <td>
                   <input type="number" name="price">
                </td>
              </tr>

              <tr>
                <td>Select Image:</td>
                <td>
                   <input type="file" name="image">
                </td>
              </tr>

              <tr>
                <td>Category:</td>
                <td>
                   <select name="category" >
                   
                   <?php 
                    //Create php code to display categories from database
                    //1.create sql to get all active categories from data base
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    //Executing query

                    $res = mysqli_query($conn,$sql);

                    //count rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    //If count is greater than zero we have category else we dont have categories
                    if($count>0)
                    {
                      //We have categories
                      while($row=mysqli_fetch_assoc($res))
                      {
                        //get the details of the categories
                        $id = $row['id'];
                        $title = $row['title'];

                        ?>
                         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                        <?php
                      }
                    }
                    else
                    {
                      //We do not have categories
                      ?>
                      <option value="0">No Category Found.</option>
                      <?php
                    }

                    //2.display on drop down 
                   ?>
                                        
                   </select>
                </td>
              </tr>
             
              <tr>
                <td>Featured:</td>
                <td>
                  <input type="radio" name="featured" value="Yes">Yes
                  <input type="radio" name="featured" value="No">No
                </td>
              </tr>

              <tr>
                <td>Active:</td>
                <td>
                  <input type="radio" name="active" value="Yes">Yes
                  <input type="radio" name="active" value="No">No
                </td>
              </tr>

              <tr>
                <td colspan="2">
                   <input type="submit" name="submit" value="Add Shoe" class="btn-secondary">
                </td>
              </tr>

           </table>
        
       </form>
     
        <?php
         
          //check whether the button is clickd or not
          if(isset($_POST['submit']))
          {
            //Add the shoe in database
            //echo "Clicked";

            //1.Get the data from form
            $title= $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //checK WHEther radio button is clicked or not
            if(isset($_POST['featured']))
            {
              $featured = $_POST['featured'];
            }
            else
            {
              $featured = "No"; //setting the default value
            }

            if(isset($_POST['active']))
            {
              $active = $_POST['active'];
            }
            else
            {
              $active = "No";//setting the default value
            }

            //2.Upload the image if selected
            //check whether thw select button is clicked or not
            if(isset($_FILES['image']['name']))
            {
              //Get the details of the selected image
              $image_name = $_FILES['image']['name'];

              //check whether the image is selected or not and upload image only if selected
              if($image_name!="")
              {
                //Image is selected
                //A.Rename the image
                //Get the extension of selected image (jpg,png,gif etc...) 
                $ext = end(explode('.', $image_name));

                //Create New Name for image
                $image_name = "Shoe-Name-".rand(0000,9999).".".$ext; //New image name may be "Shoe-name-657.jpg"


                //B.UPloAD THE IMAGE
                //get the src path and destination

                //source path is the current locaton of image
                $src = $_FILES['image']['tmp_name'];

                //destination path for the image to be uploaded
                $dst = "../images/shoe/".$image_name;

                //Finally upload the food image
                $upload = move_uploaded_file($src,$dst);

                //check whether image uploaded or not
                if($upload == false)
                {
                  //failed to upload the image
                  //redirect to add shoe page with error message
                  $_SESSION['upload'] = "<div class ='error'>Failed to upload image.</div>";
                  header('location:'.SITEURL.'admin/add-shoe.php');
                  //stop the process
                  die();
                }
              }

            }
            else
            {
              $image_name = ""; //setting default value as blank
            }

            //3..Insert into database

            //create a sql query to save shoe
            $sql2 = "INSERT INTO tbl_shoe SET
              title = '$title',
              description = '$description',
              price = $price,
              image_name = '$image_name',
              category_id = $category,
              featured = '$featured',
              active = '$active'
            ";

             //execute the query
             $res2 = mysqli_query($conn,$sql2);
             //check whether data inserted or not
              //4.Redirect with message to manage-shoe page

             if($res2 == true)
             {
               //data inserted successfully
               $_SESSION['add'] = "<div class ='success'>Shoe Added SUccessfully.</div>";
               header('location:'.SITEURL.'admin/manage-shoe.php');
             }
             else
             {
              $_SESSION['add'] = "<div class ='error'>Failed To Add Shoe.</div>";
              header('location:'.SITEURL.'admin/manage-shoe.php');
             }
           
          }
         
        ?>


    </div>
 
</div>

<?php include('partials/footer.php'); ?>