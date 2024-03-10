<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Fetch product price from database
    $sql = "SELECT  product_price FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['product_price'];
    } else {
        echo '0'; // If product not found or price is not available, return 0
    }
}
?>
