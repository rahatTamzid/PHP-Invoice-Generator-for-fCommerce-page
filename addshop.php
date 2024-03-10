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
    $shopName = $_POST['shopName'];
    $shopAddress = $_POST['shopAddress'];
    $shopPhone = $_POST['shopPhone'];
    $currierID = $_POST['currierID'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["shopLogo"]["name"]);

    if (move_uploaded_file($_FILES["shopLogo"]["tmp_name"], $target_file)) {
        // Insert data into database
        $sql = "INSERT INTO shops (shopname, shopaddress, shopnumber, currierid, shoplogo)
                VALUES ('$shopName', '$shopAddress', '$shopPhone', '$currierID', '$target_file')";
        
        if (mysqli_query($conn, $sql)) {
            // Set session variable to indicate success
            $_SESSION['success'] = true;
            // Redirect to prevent form resubmission
            header("Location: addshop.php");
            exit(); // Make sure to exit after redirection
        } else {
            $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $error_message = "Sorry, there was an error uploading your file.";
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




<!-- Log in Controll -->

<section style="margin: 30px;" class="loginSection">
    <form class="has-validation" action="addshop.php" method="POST" enctype="multipart/form-data">
        <div class="form-group row has-validation">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Shop Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" name="shopName" placeholder="Choose a Shop Name" required>
            </div>
        </div>
        <div class="form-group row has-validation">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Shop Address</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword3" name="shopAddress" placeholder="Enter Shop Address" required>
            </div>
        </div>
        <div class="form-group row has-validation">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Phone Number</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="inputPassword3" name="shopPhone" placeholder="Give Phone Number" required>
            </div>
        </div>
        <div class="form-group row has-validation">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Stead Fast ID</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="inputPassword3" name="currierID" placeholder="Enter Steadfast ID" required>
            </div>
        </div>
        <div class="form-group row has-validation">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Shop Logo</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="inputPassword3" name="shopLogo" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <input type="submit" name="submit" value="Submit" class="btn btn-success">
            </div>
        </div>
    </form>
</section>





<h1> Welcome to add shop</h1>

<!-- Success message div -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success" role="alert">
        Shop added successfully.
    </div>
<?php endif; ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>