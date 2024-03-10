
<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Check if there are any products
if (mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $products = array(); // Empty array if no products found
}

mysqli_close($conn);
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Invoice Ninja</title>
</head>
<body>







<!-- Started Navbar -->


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="create_bills.php">Home <span class="sr-only"></span></a>
        </li>
        

        <li class="nav-item active">
            <a class="nav-link " href="addproduct.php"  role="button"  aria-haspopup="true" aria-expanded="false">
            Add New Product
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link " href="addshop.php" role="button" aria-haspopup="true" aria-expanded="false">
            Add New Shop
            </a>
          </li>

        <li class="nav-item active">
            <a class="nav-link " href="productlist.php"  role="button" aria-haspopup="true" aria-expanded="false">
            All Product List
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link " href="shoplist.php"  role="button" aria-haspopup="true" aria-expanded="false">
            All Shop List
            </a>
          </li>
      </ul>
    </div>
  </nav>

  <!-- Navbar Finished -->

<h1> Available Products</h1>


 <?php foreach ($products as $product): ?>
    <div class="col-md-4 mb-4" style="float:left; margin: 10px; width:400px;" >
        <div class="card" style="float:left; margin: 10px; width:400px;" >
            <div class="card-body">
                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                <p class="card-text">Price: BDT <?php echo $product['product_price']; ?></p>
                <form action="editproduct.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
                <form action="deleteproduct.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>