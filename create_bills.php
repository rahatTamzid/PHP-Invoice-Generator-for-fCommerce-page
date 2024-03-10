<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <title>Invoice Ninja</title>
    <style>
        /* Additional CSS for shop logo */
        #shopLogoContainer {
            position: relative;
            width: 100px;
            height: 100px;
            float: right;
        }

        #shopLogoImg {
            max-width: 100%;
            max-height: 100%;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
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





<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Create New Bill</h2>
            <!-- Shop logo container -->
            <div id="shopLogoContainer">
                <img id="shopLogoImg" src="" alt="Shop Logo">
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="customerName" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName">
                </div>
                <div class="col-md-4">
                    <label for="customerAddress" class="form-label">Customer Address</label><br>
                    <textarea id="customerAddress" class="form-control" name="customerAddress" rows="1" cols="40"></textarea>
           
                </div>
                <div class="col-md-4">
                    <label for="customerPhone" class="form-label">Customer Phone</label>
                    <input type="text" class="form-control" id="customerPhone" name="customerPhone">
                </div>
            </div>
            
            <form id="billForm"  id="billForm" action="create_bills.php" method="POST" >
                <!-- Shop details -->
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="shopSelect" class="form-label">Select Shop</label>
                        <select class="form-select" id="shopSelect" name="shopSelect" required onchange="updateShopDetails()">
                            <option selected disabled value="">Choose Shop</option>
                            <?php
                            // Database connection
                            $conn = mysqli_connect('localhost', 'root', '', 'invoiceninja');
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Fetch shops from database
                            $sql = "SELECT * FROM shops";
                            $result = mysqli_query($conn, $sql);

                            // Populate select options with shop names and data attributes
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['shopid'] . "' data-address='" . $row['shopaddress'] . "' data-number='" . $row['shopnumber'] . "' data-courier='" . $row['currierid'] . "' data-logo='" . $row['shoplogo'] . "'>" . $row['shopname'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="shopAddress" class="form-label">Shop Address</label>
                        <input type="text" class="form-control" id="shopAddress" name="shopAddress" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="shopNumber" class="form-label">Shop Number</label>
                        <input type="text" class="form-control" id="shopNumber" name="shopNumber" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="courierId" class="form-label">Stead Fast ID</label>
                        <input type="text" class="form-control" id="courierId" name="courierId" readonly>
                    </div>
                </div>
                <!-- End of shop details -->
                <!-- Rest of the form -->
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody id="productRows">
                    <!-- Product rows will be dynamically added here -->
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary" onclick="addProductRow()">Add Product</button>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="deliveryChargeSelect" class="form-label">Delivery Charge</label>
                        <select class="form-select" id="deliveryChargeSelect" name="deliveryChargeSelect" onchange="calculateTotal()">
                            <option value="70">70 TK</option>
                            <option value="80">80 TK</option>
                            <option value="100">100 TK</option>
                            <option value="120">120 TK</option>
                            <option value="0">FREE</option>
                            <option value="custom">Custom</option>
                        </select>
                        <input type="number" class="form-control mt-2 d-none" id="customDeliveryCharge" name="customDeliveryCharge" placeholder="Enter Custom Delivery Charge">
                    </div>
                    <div class="col-md-6">
                        <label for="totalBill" class="form-label">Total Due Bill</label>
                        <input type="text" class="form-control" id="totalBill" name="totalBill" readonly>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3"  onclick="generatePDF()">Generate Memo</button>
            </form>
        </div>
    </div>
</div>
<!-- JavaScript libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
    function updateShopDetails() {
        const shopId = document.getElementById('shopSelect').value;
        const selectedShop = document.querySelector(`option[value="${shopId}"]`);
        document.getElementById('shopAddress').value = selectedShop.getAttribute('data-address');
        document.getElementById('shopNumber').value = selectedShop.getAttribute('data-number');
        document.getElementById('courierId').value = selectedShop.getAttribute('data-courier');
        document.getElementById('shopLogoImg').src = selectedShop.getAttribute('data-logo');
    }

    function addProductRow() {
        const productRow = `
            <tr>
                <td>
                    <select class="form-select product-select" required onchange="getProductPrice(this)">
                        <option selected disabled value="">Choose Product</option>
                        <?php
                        // Fetch products from database
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn, $sql);

                        // Populate select options with product names
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input type="number" class="form-control quantity" value="1" min="1" required></td>
                <td><input type="text" id="sizeValue" class="form-control" value="Free Size"></td>
                <td><input type="text" id="colorValue" class="form-control" value="Mix Color"></td>
                <td><input type="number" class="form-control unit-price" value="0" min="0" required ></td>
                <td class="amount">0</td> <!-- Amount will be calculated dynamically -->
            </tr>
        `;
        document.getElementById('productRows').insertAdjacentHTML('beforeend', productRow);
    }

    async function getProductPrice(selectElement) {
        const productId = selectElement.value;
        const unitPriceInput = selectElement.closest('tr').querySelector('.unit-price');
        try {
            const response = await fetch(`get_product_price.php?product_id=${productId}`);
            const price = await response.text();
            unitPriceInput.value = price;
            updateAmount(selectElement.closest('tr'));
        } catch (error) {
            console.error('Error fetching product price:', error);
        }
    }

    function updateAmount(row) {
        const quantity = parseFloat(row.querySelector('.quantity').value);
        const unitPrice = parseFloat(row.querySelector('.unit-price').value);
        const amountCell = row.querySelector('.amount');
        amountCell.textContent = (quantity * unitPrice).toFixed(2);
        calculateTotal(); // Update total after updating amount
    }

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('#productRows tr').forEach(row => {
            total += parseFloat(row.querySelector('.amount').textContent);
        });
        const deliveryChargeSelect = document.getElementById('deliveryChargeSelect');
        let deliveryCharge = parseFloat(deliveryChargeSelect.value);
        if (deliveryChargeSelect.value === 'custom') {
            deliveryCharge = parseFloat(document.getElementById('customDeliveryCharge').value) || 0;
        }
        total += deliveryCharge;
        document.getElementById('totalBill').value = total.toFixed(2);
    }

    document.getElementById('productRows').addEventListener('change', function (e) {
        if (e.target.classList.contains('product-select') || e.target.classList.contains('quantity') || e.target.classList.contains('unit-price')) {
            updateAmount(e.target.closest('tr'));
        }
    });

    document.getElementById('deliveryChargeSelect').addEventListener('change', function (e) {
        const customDeliveryChargeInput = document.getElementById('customDeliveryCharge');
        if (e.target.value === 'custom') {
            customDeliveryChargeInput.classList.remove('d-none');
        } else {
            customDeliveryChargeInput.classList.add('d-none');
            calculateTotal();
        }
    });

    document.getElementById('customDeliveryCharge').addEventListener('input', function (e) {
        calculateTotal();
    });



    // Function To Generate PDF
    function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Fetch selected shop details
    const shopSelect = document.getElementById('shopSelect');
    const selectedOption = shopSelect.options[shopSelect.selectedIndex];
    const shopName = selectedOption.text;
    const shopAddress = selectedOption.getAttribute('data-address');
    const shopNumber = selectedOption.getAttribute('data-number');
    const steadfastID = selectedOption.getAttribute('data-courier');
    const shopLogoURL = selectedOption.getAttribute('data-logo');

    // Auto-generate invoice number (timestamp for simplicity)
    const now = new Date();
    const invoiceNumber = `INV-${now.getDate()}${now.getMonth() + 1}${String(now.getFullYear()).substr(-2)}-${Math.floor(1000 + Math.random() * 9000)}`;
    // const invoiceNumber = `INV-${Date.now()}`;

    // Real-time invoice date
    const invoiceDate = new Date().toLocaleDateString();

    // Fetch subtotal, shipping, and total
    // const subtotal = document.getElementById('totalBill').value;
    // const shipping = document.getElementById('deliveryChargeSelect').value;
    // const total = parseFloat(subtotal) + parseFloat(shipping);


    // Fetch subtotal
    const subtotal1 = parseFloat(document.getElementById('totalBill').value);
    

    // Determine shipping charge
    const deliveryChargeSelect = document.getElementById('deliveryChargeSelect');
    let shipping = 0;
    if (deliveryChargeSelect.value === 'custom') {
        shipping = parseFloat(document.getElementById('customDeliveryCharge').value) || 0;
    } else {
        shipping = parseFloat(deliveryChargeSelect.value);
    }

    const subtotal = subtotal1 - shipping;

    // Calculate total
    const total = subtotal + shipping;

// Now use the 'shipping' and 'total' for displaying in the PDF






  // Fetching color size data
   const color =  document.getElementById('totalBill').value;





// Database Storing Block

const formData = {
        invoiceNumber: invoiceNumber, // Example invoice number generation
        customerName: document.getElementById('customerName').value,
        customerAddress: document.getElementById('customerAddress').value,
        customerPhone: document.getElementById('customerPhone').value,
        totalBill: total,
        // Add any other required fields
    };

    // Send form data to store_invoice.php
    fetch('store_invoice.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(formData),
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.text();
})
.then(data => console.log(data))
.catch((error) => {
    console.error('Fetch error:', error);
});


// End Database Storing Block
     // Adding shop logo
   
        const logoWidth = 20; // Example logo width in mm
        const logoHeight = 20; // Example logo height in mm
        const pageWidth = 210; // A4 width in mm
        const xPosition = (pageWidth - logoWidth) / 2; // Center the logo
        doc.addImage(shopLogoURL, 'JPEG', xPosition, 5, logoWidth, logoHeight);
        //doc.addImage(shopLogoURL, 'JPEG', 150, 5, 10, 10); // Adjust format and dimensions as needed
    // Adding shop details to the PDF
    doc.setFontSize(12);
    doc.text(shopName, 150, 10);
    doc.text(shopAddress, 150, 15);
    doc.text(`Phone: +880${shopNumber}`, 150, 20);
    doc.text(`Steadfast ID: ${steadfastID}`, 150, 25);

    // Invoice number and date
    doc.text(`Invoice Number: ${invoiceNumber}`, 10, 10);
    doc.text(`Date: ${invoiceDate}`, 10, 15);

    // Customer details
    const customerName = document.getElementById('customerName').value;
    const customerAddress = document.getElementById('customerAddress').value;
    const customerPhone = document.getElementById('customerPhone').value;
    doc.text(`Bill To: ${customerName}`, 10, 25);
    doc.text(`Address : ${customerAddress}`, 10, 35);
    doc.text(`Phone : ${customerPhone}`, 10, 50);

    // Products header
    doc.text("Item", 10, 70);
    doc.text("Quantity", 60, 70);
    doc.text("Size", 80, 70);
    doc.text("Color", 110, 70);
    doc.text("Price", 140, 70);
    doc.text("Amount", 170, 70);

    // Iterate through product rows and add them to the PDF
    const productRows = document.querySelectorAll('#productRows tr');
    let yPos = 75;
    productRows.forEach(row => {
        const productName = row.cells[0].querySelector('select').selectedOptions[0].text;
        const quantity = row.cells[1].querySelector('input').value;
        const size = row.cells[2].querySelector('input').value; // Assuming size is input value
        const color = row.cells[3].querySelector('input').value; // Assuming color is input value
        const price = row.cells[4].querySelector('input').value;
        const amount = row.cells[5].textContent;

        // Adjust the yPos as needed to fit your layout
        doc.text(productName, 10, yPos);
        doc.text(quantity, 60, yPos);
        doc.text(size, 80, yPos); // Position size accordingly
        doc.text(color, 110, yPos); // Position color accordingly
        doc.text(`Tk ${price}`, 140, yPos);
        doc.text(`Tk ${amount}`, 170, yPos);

        yPos += 6; // Increase yPos for the next product line
    });

    // Totals
    yPos += 6; // Ensure this adjusts based on your products section
    doc.text(`Subtotal: Tk${subtotal}`, 140, yPos);
    yPos += 6;
    doc.text(`Shipping: Tk${shipping}`, 140, yPos);
    yPos += 6;
    doc.text(`Total: Tk${total}`, 140, yPos);
    // Save the created PDF
    doc.save(`${invoiceNumber}.pdf`);
 //// Sending To database
}
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
