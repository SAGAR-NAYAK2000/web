<?php include('config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--Important to make website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOES HUB</title>

    <!-- Link our css file-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!--Navbar section starts here-->
    <section class="navbar">
    <div class="container">
        <div class="logo">
            <img src="images/images.png" alt="Shoe logo" class="img-responsive">
            <p class="text-right">SHOE HUB</p>
        </div>

        <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL; ?>">Home</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                </li>

                <li>
                    <a href="<?php echo SITEURL; ?>shoes.php">Shoes</a>
                </li>

                <li>
                    <a href="a">Contact</a>
                </li>
            </ul>
    </div>

    <div class="clearfix"></div>
    </section>
    <!--Navbar section ends here-->