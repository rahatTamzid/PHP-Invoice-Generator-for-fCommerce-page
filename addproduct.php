
<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Insert data into database
    $sql = "INSERT INTO products (product_name, product_price) VALUES ('$productName', '$productPrice')";

    if (mysqli_query($conn, $sql)) {
        // Set session variable to indicate success
        $_SESSION['success'] = true;
        // Redirect to prevent form resubmission
        header("Location: addproduct.php");
        exit(); // Make sure to exit after redirection
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Clear success message on subsequent page loads
if (isset($_SESSION['success'])) {
    unset($_SESSION['success']);
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






<!-- Product Add Form  -->
<div class="container mt-5">
    <h1>Add New Product</h1>
    <!-- Product Add Form -->
    <form method="POST">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="productPrice">Product Price</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
    </form>
</div>






    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>