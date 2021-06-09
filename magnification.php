<?php include('partials-front/menu.php'); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
   
   <link rel="stylesheet" href="css/zoom-main.css">
    <title>Hello, world!</title>
  </head>
  <body>
    <section>
        <div class="container">
           <div class="row">
           <div class="col-md-12 mt-5">
             <div class="card">
                <div class="card-header">
                   <h4>Product view/Gallery zoom - image in jquery</h4>
                </div>
             </div>
           </div>
              <div class="col-md-12 mt-4">
                 <div class="card">
                     <div class="row">
                        <div class="col-md-4">
                        <div class="show" href="images/sneakers.jpg">
                             <img src="images/sneakers.jpg" id="show-img" class="w-100">
                        </div>
                        </div>
                        <div class="col-md-8 bg-warning">
                        <div class="card-body ">
                        <h4>Nike sneakers</h4>
                      <p>This is nike zoom for sports.</p>
                      <h5>Rs.7999</h5>
                   </div>               
                 </div>
                </div>
            </div>
         </div>
               
           </div>
        </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="js/zoom-image.js"></script>
    <script src="js/zoom-main.js"></script>
    
  </body>
</html>
<?php include('partials-front/footer.php'); ?>