<?php
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$gender = $_POST['gender'];
$size = $_POST['size'];
$shipping_address = $_POST['shipping_address'];
$payment_method = $_POST['payment_method'];
$card_number = $_POST['card_number'];
$expiration_date = $_POST['expiration_date'];
$cvv = $_POST['cvv'];
$shipping_method = $_POST['shipping_method'];

// Get current date and time
$order_date = date('Y-m-d H:i:s');

// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'orderformanu');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    // Prepare SQL statement with default status value
    $stmt = $conn->prepare("INSERT INTO manuorders (name, email, phone, item, quantity, gender, size, shipping_address, payment_method, card_number, expiration_date, cvv, shipping_method, order_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'PENDING')");
    
    if (!$stmt) {
        die('Error in preparing statement: ' . $conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("ssssssssssssss", $name, $email, $phone, $item, $quantity, $gender, $size, $shipping_address, $payment_method, $card_number, $expiration_date, $cvv, $shipping_method, $order_date);
    
    // Execute SQL query
    if (!$stmt->execute()) {
        die('Error in executing statement: ' . $stmt->error);
    }

    echo "Order placed successfully!";
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
