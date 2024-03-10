<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if shop ID is provided via POST method
if(isset($_POST['shop_id'])) {
    $shopId = $_POST['shop_id'];
    
    // Fetch shop details from database based on shop ID
    $sql = "SELECT * FROM shops WHERE shopid = '$shopId'";
    $result = mysqli_query($conn, $sql);

    // Check if shop exists
    if(mysqli_num_rows($result) > 0) {
        $shopData = mysqli_fetch_assoc($result);
    } else {
        echo "Shop not found.";
        exit();
    }
} else {
    echo "Shop ID not provided.";
    exit();
}

// Handle form submission for updating shop details
if (isset($_POST['submit'])) {
    $shopName = $_POST['shopName'];
    $shopAddress = $_POST['shopAddress'];
    $shopPhone = $_POST['shopPhone'];
    $currierID = $_POST['currierID'];

    // Update shop details in the database
    $sql = "UPDATE shops SET shopname='$shopName', shopaddress='$shopAddress', shopnumber='$shopPhone', currierid='$currierID' WHERE shopid='$shopId'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = true;
        header("Location: shoplist.php");
        exit();
    } else {
        $error_message = "Error updating shop: " . mysqli_error($conn);
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
    <title>Edit Shop</title>
</head>
<body>

<!-- Edit Shop Form -->
<div class="container mt-5">
    <h2>Edit Shop</h2>
    <form action="" method="POST">
    <div class="form-group">
        <label for="shopName">Shop Name</label>
        <input type="text" class="form-control" id="shopName" name="shopName" value="<?php echo $shopData['shopname']; ?>" required>
    </div>
    <div class="form-group">
        <label for="shopAddress">Shop Address</label>
        <input type="text" class="form-control" id="shopAddress" name="shopAddress" value="<?php echo $shopData['shopaddress']; ?>" required>
    </div>
    <div class="form-group">
        <label for="shopPhone">Phone Number</label>
        <input type="number" class="form-control" id="shopPhone" name="shopPhone" value="<?php echo $shopData['shopnumber']; ?>" required>
    </div>
    <div class="form-group">
        <label for="currierID">Courier ID</label>
        <input type="number" class="form-control" id="currierID" name="currierID" value="<?php echo $shopData['currierid']; ?>" required>
    </div>
    <!-- Hidden input for shop ID -->
    <input type="hidden" name="shop_id" value="<?php echo $shopData['shopid']; ?>">
    <button type="submit" class="btn btn-primary" name="submit">Update Shop</button>
</form>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
