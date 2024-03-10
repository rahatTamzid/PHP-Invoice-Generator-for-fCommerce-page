<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if shop ID is provided via POST
if (isset($_POST['shop_id'])) {
    // Sanitize the shop ID to prevent SQL injection
    $shop_id = mysqli_real_escape_string($conn, $_POST['shop_id']);
    
    // Delete shop from database
    $sql = "DELETE FROM shops WHERE shopid = '$shop_id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = true;
    } else {
        $_SESSION['error'] = "Error deleting shop: " . mysqli_error($conn);
    }
} else {
    $_SESSION['error'] = "Shop ID not provided.";
}

// Redirect back to shop list page
header("Location: shoplist.php");
exit();
?>