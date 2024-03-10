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
    
    // Delete product from the database
    $sql = "DELETE FROM products WHERE product_id='$productId'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = true;
        header("Location: productlist.php");
        exit();
    } else {
        $error_message = "Error deleting product: " . mysqli_error($conn);
    }
} else {
    echo "Product ID not provided.";
    exit();
}

mysqli_close($conn);
?>
