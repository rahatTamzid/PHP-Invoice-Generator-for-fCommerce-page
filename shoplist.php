<?php
// Start or resume the session
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch shop data from the database
$sql = "SELECT * FROM shops";
$result = mysqli_query($conn, $sql);

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




<!-- Display existing shops in cards -->
<?php
// Loop through each row of the result set
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="card" style="width: 250px; float:left; margin: 10px">
        <img src="<?php echo $row['shoplogo']; ?>" class="card-img-top" alt="Shop Logo">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['shopname']; ?></h5>
            <p class="card-text"><?php echo $row['shopaddress']; ?></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><?php echo $row['shopnumber']; ?></li>
            <li class="list-group-item">
                <form action="edit_shop.php" method="post">
                    <input type="hidden" name="shop_id" value="<?php echo $row['shopid']; ?>">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </li>
            <li class="list-group-item">
                <form action="delete_shop.php" method="post">
                    <input type="hidden" name="shop_id" value="<?php echo $row['shopid']; ?>">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this shop?')">Delete</button>
                </form>
            </li>
        </ul>
    </div>
    <?php
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>