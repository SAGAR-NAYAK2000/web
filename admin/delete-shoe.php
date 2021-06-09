<?php include('partials/menu.php'); ?>

<?php
  //Include Constants
  include('../config/constants.php');

  //echo "Delete shoe";
  if(isset($_GET['id'])&& isset($_GET['image_name'])) //Either use '&&' or 'AND'
  {
      //Process to delete
      //echo "Process to Delete";

      //1.Get id and image name
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      //2.remove the image if available
      //check whether the iage is available or not and delete only if available
      if($image_name != "")
      {
          //It hass image and need to remove from folder
          //get the image path
          $path = "../images/shoe/".$image_name;

          //Remove image file from folder
          $remove = unlink($path);

          //check whether the image is removed or not
          if($remove==false)
          {
              //Failed to remove image
              $_SESSION['upload'] = "<div class = 'error'>Failed to remove image file.</div>";
              //Redirect to manage shoe
              header('location:'.SITEURL.'admin/manage-shoe.php');
              //stop the process of deleting shoe
              die();
          }
      }

      //3.Delete food from database
      $sql = "DELETE FROM tbl_shoe WHERE id = $id";
      //Execute the query
      $res = mysqli_query($conn,$sql);

      //check whether the query executed or not and set the session message respectively
      //4.Redirect to manage food with session message
      if($res==true)
      {
          //Shoe Deleted
          $_SESSION['delete'] = "<div class='success'>Shoe Deleted successfully.</div>";
          header('location:'.SITEURL.'admin/manage-shoe.php');
      }
      else
      {
          //Failed to delete shoe
          $_SESSION['delete'] = "<div class='error'>Failed to delete shoe.</div>";
          header('location:'.SITEURL.'admin/manage-shoe.php');
      }

      
  }
  else
  {
      //Redirect to manage shoe page
      //echo "Redirect";
      $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
      header('location:'.SITEURL.'admin/manage-shoe.php');
  }
?>


<?php include('partials/footer.php'); ?>