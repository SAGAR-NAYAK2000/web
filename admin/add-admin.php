<?php include('partials/menu.php');?>


<div class="main-content">
   <div class="wrapper">
      <h1>Add Admin</h1>
        <br><br>
   
      <?php
        if(isset($_SESSION['add'])) //checking whether the session is set or not
        {
            echo $_SESSION['add'];//display the session message
            unset($_SESSION['add']);//remove the session message
        }
      ?>

      <form action="" method="POST">
         <table class="tbl-30">
            <tr>
              <td>Full Name:</td>
              <td><input type="text" name="full_name" placeholder="Enter your name"></td>
            </tr>

            <tr>
                <td>User Name:</td>
                <td>
                    <input type="text" name="username" placeholder="Your USer Name">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" placeholder="Your password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                   <input type="submit" name="submit" value="Add Admin" class="btn-secondary">                 
                </td>
            </tr>
         </table>
      
      </form>
   </div>
</div>

<?php include('partials/footer.php')?>

<?php
   //Process the value from form and save it in daatabase
   //Check whether the submit button is clicked or not

   if(isset($_POST['submit'])){
       // Button clicked
      // echo "Button CLicked";
       //1.Get The Data From Form

        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password =md5($_POST['password']);  //Password Encryption with MD5

        //2.SQL queery to save the data into database
         $sql = "INSERT INTO tbl_admin SET
             full_name='$full_name',
             username='$username',
             password='$password'
         ";
        //Executing queery and saving data into the database
        
          
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
         //Check whether the (queery is executed) or not
         if($res==TRUE)
         {
             //DATA INSERTED
             //echo "Data inserted";
             //create a session variable to display message 
             $_SESSION['add'] = "Admin Added Successfully";
             //redirect page to manage admin
             header("location:".SITEURL.'admin/manage-admin.php');
         }
         else{
            // echo "failed to insert data";
            //create a session variable to display message 
            $_SESSION['add'] = "Failed To Add Admin";
            //redirect page to Add admin
            header("location:".SITEURL.'admin/add-admin.php');
         }
   }
  

?> 
