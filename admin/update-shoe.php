<?php include('partials/menu.php'); ?>

<?php
  //check whether id is set or not
  if(isset($_GET['id']))
  {
      //Get all the details
      $id = $_GET['id'];

      //sql query to get the selected shoe
      $sql2 = "SELECT * FROM tbl_shoe WHERE id=$id";
      //execute the query
      $res2 = mysqli_query($conn,$sql2);

      //get the value based on query exectued
      $row2 = mysqli_fetch_assoc($res2);

      //get the individual value of selected shoe
      $title = $row2['title'];
      $description = $row2['description'];
      $price = $row2['price'];
      $current_image = $row2['image_name'];
      $current_category = $row2['category_id'];
      $featured = $row2['featured'];
      $active = $row2['active'];
  }
  else
  {
      //redirect to manage shoe
      header('location:'.SITEURL.'admin/manage-shoe.php');
  }

?>


<div class="main-content">
    <div class="wrapper">
         <h1>Update Shoe</h1>
         <br><br>

         <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
              <tr>
                 <td>Title:</td>
                 <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                 </td>
              </tr>

              <tr>
                 <td>Description:</td>
                 <td>
                   <textarea name="description"  cols="30" rows="5"><?php echo $description; ?></textarea>
                 </td>
              </tr>

              <tr>
                <td>Price:</td>
                <td>
                   <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
              </tr>

              <tr>
                <td>Current Image:</td>
                <td>
                   <?php
                     if($current_image=="")
                     {
                         //image not avilable
                         echo "<div class='error'>Image not available.</div>";
                     }
                     else
                     {
                         //image available
                         ?>
                         <img src="<?php echo SITEURL; ?>images/shoe/<?php echo $current_image; ?>"width="150px">
                         <?php
                     }
                   ?>
                </td>
              </tr>

              <tr>
                <td>Select New Image:</td>
                <td>
                   <input type="file" name="image">
                </td>
              </tr>

              <tr>
                <td>Category:</td>
                <td>
                   <select name="category">

                   <?php
                   //Query to get active cateory
                       $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                       //exectue the query
                       $res = mysqli_query($conn,$sql);
                       //count rows
                       $count = mysqli_num_rows($res);

                       //check whether category avaiable or not
                       if($count>0)
                       {
                           //category available
                           while($row= mysqli_fetch_assoc($res))
                           {
                               $category_title = $row['title'];
                               $category_id = $row['id'];

                               //echo "<option value='$category_id'>$category_title</option>";
                              ?>
                              <option <?php if($current_category==$category_id){ echo "selected";} ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>0
                              <?php
                           }
                       }
                       else
                       {
                           //category not available
                           echo "<option value='0'>Category Not Available.</option>";
                       }

                   ?>

                     
                   </select>
                </td>
              </tr>

              <tr>
                <td>Featured:</td>
                <td>
                   <input <?php if($featured=="Yes"){ echo "Checked";} ?> type="radio" name="featured" value="Yes">Yes
                   <input <?php if($featured=="No"){ echo "Checked";} ?> type="radio" name="featured" value="No">No
                </td>
              </tr>

              <tr>
                <td>Active:</td>
                <td>
                   <input <?php if($active=="Yes"){ echo "Checked";} ?> type="radio" name="active" value="Yes">Yes
                   <input <?php if($active=="No"){ echo "Checked";} ?> type="radio" name="active" value="No">No
                </td>
              </tr>

              <tr>
               <td>
                 <input type="hidden" name="id" value="<?php echo $id;  ?>">
                 <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">
                 <input type="submit" name="submit" value="Update Shoe" class="btn-secondary">
               </td>
              </tr>

           </table>
          
         </form>
         <?php
           if(isset($_POST['submit']))
           {
               //echo "button clicked.";

               //1.get all the details from the form
               $id = $_POST['id'];
               $title = $_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $current_image = $_POST['current_image'];
               $category = $_POST['category'];

               $featured=$_POST['featured'];
               $active=$_POST['active'];

               //2. upload the image selected

               //check wheter upload button is clicke dor not
               if(isset($_FILES['image']['name']))
               {
                   //upload button is clicked
                   $image_name = $_FILES['image']['name']; //new image name

                   //check whether the file is available or not
                   if($image_name!="")
                   {
                       //image is available
                       //A.uploading new imag

                       //rename the image
                       $ext = end(explode('.',$image_name)); //gets the extension

                       $image_name = "Shoe-Name-".rand(0000,9999).'.'.$ext;

                       //get the source path and destination path
                       $src_path = $_FILES['image']['tmp_name'];
                       $dest_path = "../images/shoe/".$image_name;

                       //upload the imgae
                       $upload = move_uploaded_file($src_path, $dest_path);

                       //check whether the image is uploadd or not
                       if($upload==false)
                       {
                           //failed to upload
                           $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
                           //redirect to manage shoe
                           header('location:'.SITEURL.'admin/manage-shoe.php');
                           //stop the process
                           die();
                       }
                       //3.remove the image if new image is uploaded and current image exists
                       //B.remove current image if available
                       if($current_image!="")
                       {
                           //current image is available
                           //remove the image
                           $remove_path="../images/shoe/".$current_image;

                           $remove = unlink($remove_path);

                           //check whether the image is removd or not
                           if($remove==false)
                           {
                               //failed to remove current image
                               $_SESSION['remove-failed']="<div class='error'>Failed to remove current image.</div>";
                               //redirect to manage shoe
                               header('location:'.SITEURL.'admin/manage-shoe.php');
                               //stop the process
                               die();

                           }
                       }
                   }
                   else
                   {
                     $image_name = $current_image;//default image when image is not selected
                   }
               }
               else
                   {
                     $image_name = $current_image;//default image when image is not clicked
                   }

               

               //4. update the shoe in database
               $sql3 = "UPDATE tbl_shoe SET
                 title = '$title',
                 description = '$description',
                 price = $price,
                 image_name = '$image_name',
                 category_id = '$category',
                 featured = '$featured',
                 active = '$active'
                 WHERE id=$id
               ";

               //exectue the sql querry
               $res3 = mysqli_query($conn,$sql3);

               //check whether the query is executed or not
               if($res3==true)
               {
                   //query executed and shoe updated
                   $_SESSION['update'] = "<div class='success'>Shoe updated successfully.</div>";
                   header('location:'.SITEURL.'admin/manage-shoe.php');
               }
               else
               {
                   //failed to update shoe
                   $_SESSION['update'] = "<div class='error'>Failed to  updated Shoe.</div>";
                   header('location:'.SITEURL.'admin/manage-shoe.php');
               }
               }

                
           
         ?>

    </div>
</div>


<?php include('partials/footer.php'); ?>