<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if product ID is provided via POST method
if(isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    // Fetch product details from database based on product ID
    $sql = "SELECT * FROM products WHERE product_id = '$productId'";
    $result = mysqli_query($conn, $sql);

    // Check if product exists
    if(mysqli_num_rows($result) > 0) {
        $productData = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}

// Handle form submission for updating product details
if (isset($_POST['submit'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];

    // Update product details in the database
    $sql = "UPDATE products SET product_name='$productName', product_price='$productPrice' WHERE product_id='$productId'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = true;
        header("Location: productlist.php");
        exit();
    } else {
        $error_message = "Error updating product: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Edit Product</title>
</head>
<body>

<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="" method="POST">
    <div class="form-group">
        <label for="productName">Product Name</label>
        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $productData['product_name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="productPrice">Product Price</label>
        <input type="number" class="form-control" id="productPrice" name="productPrice" value="<?php echo $productData['product_price']; ?>" required>
    </div>
    <!-- Hidden input for product ID -->
    <input type="hidden" name="product_id" value="<?php echo $productData['product_id']; ?>">
    <button type="submit" class="btn btn-primary" name="submit">Update Product</button>
</form>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
