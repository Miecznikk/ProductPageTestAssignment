<?php
declare(strict_types=1);
    
    include 'includes/autoloader.inc.php';
    $store = new Store();
    if(isset($_POST['products'])){
      $store->delete_from_db($_POST['products']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Product List</title>
</head>
<body class="h-100" style="background-color:hsl(0, 0%, 95%);">

<nav class="shadow navbar navbar-expand-lg navbar-dark bg-dark w-100" style="z-index:2;position:fixed;top:0;left:0;">
  <div class="container-fluid">
    <span class="navbar-brand fw-bold ms-3" style="font-size:1.6rem">PRODUCT LIST</span>
      <div class="d-flex">
        <a class="btn btn-outline-success me-2 fw-bold" href="./add-product">ADD</a>
        <button class="btn btn-outline-danger fw-bold" form="deleteForm" type="submit">MASS DELETE</button>
      </div>
    </div>
  </div>
</nav>
    <div class="container mt-4 mb-5" style="padding-top:80px;padding-bottom:40px">
        <form class="d-flex flex-row flex-wrap align-items-center" method="post" id="deleteForm">
        <?php
            $store->get_products_cards();
        ?>
        </form>
    </div> 
        <?php
            include "includes/footer.inc.php";
        ?>
   
</body>
</html>


