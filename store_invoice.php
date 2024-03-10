<?php

// Assuming JSON is sent in the request body
$_POST = json_decode(file_get_contents("php://input"), true);
// store_invoice.php
$host = 'localhost'; // or your host
$username = 'root'; // or your database username
$password = ''; // or your database password
$database = 'invoiceninja'; // your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO invoices (invoice_number, customer_name, customer_address, customer_phone, total_bill, date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $invoice_number, $customer_name, $customer_address, $customer_phone, $total_bill, $date);

// Set parameters and execute
$invoice_number = $_POST['invoiceNumber'];
$customer_name = $_POST['customerName'];
$customer_address = $_POST['customerAddress'];
$customer_phone = $_POST['customerPhone'];
$total_bill = $_POST['totalBill'];
$date = date('Y-m-d'); // Current date or $_POST['date'] if you're sending it from the form

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
