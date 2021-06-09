<?php include('../config/constants.php');?>


<html>

<head>
   <title>Login - Shoe Order System</title>
   <link rel="stylesheet" href = "../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
           <br> <br>

           <?php
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
             }

             if(isset($_SESSION['no-login-message']))
             {
                 echo $_SESSION['no-login-message'];
                 unset($_SESSION['no-login-message']);
             }
           ?>
           <br><br>
        <!--login Form Starts Here-->
         <form action="" method="POST" class="text-center">
         Username: <br>
         <input type="text" name="username" placeholder="Enter Username"><br><br>
         Password: <br>
         <input type="password" name="password" placeholder="Enter Password"><br><br>
         <input type="submit" name="submit" value="Login" class="btn-primary">
         <br><br>
         </form>

        <!--login Form Ends Here-->

        <p class="text-center">Created By - <a href="www.sagarnayak.com">Sagar Nayak</a></p>
    
    </div>
</body>
</html>

<?php
 //Check whether the submit button is clicked or not
 if(isset($_POST['submit']))
 {
     //process for login
     //1.get the data from login form
     $username = $_POST['username'];
     $password =md5($_POST['password']);


     //2.sql query to check whether wthe user with username and password wxist or not
     $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
     //3.execute the qery
     $res = mysqli_query($conn,$sql);

     //4. count rows to check whether the user exist or not
     $count=mysqli_num_rows($res);

     if($count==1)
     {
        //USer available and login success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;//check whether the user is logged in or not and logout will unset it
        //REdirect to HOme page/dashboard
        header('location:'.SITEURL.'admin/');
     }
     else
     {
         //User not available and login failed
         $_SESSION['login'] = "<div class='error text-center'>Username or Password did not matched.</div>";
        //REdirect to HOme page/dashboard
        header('location:'.SITEURL.'admin/login.php');
     }
 }

?>