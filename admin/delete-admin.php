<?php

   //include constants.php file here
    include('../config/constants.php');

   //1.Get the id of the admin to the deleted
    $id=$_GET['id'];
   //2.create sql query to delete admin
   $sql= "DELETE FROM tbl_admin WHERE id=$id";

   //Execute the query
   $res = mysqli_query($conn,$sql);

   //check whether the query executed successfully or not
   if($res==TRUE)
   {
       //query executed successfully and admin deleted
       //echo "admin deleted";
       //create session variable to display message 
       $_SESSION['delete'] = "<div class = 'success'>Admin Deleted successfully.</div>";
       //redirect to manage admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
   }

   else{
     //failed to delete
     //echo "failed to delete admin";

     $_SESSION['delete'] = "<div class = 'error'>Failed to delete Admin. try again later.</div>";
     header('location:'.SITEURL.'admin/manage-admin.php');
   }
   
   //3.redirect to manage admin page with message(success or error)
?>