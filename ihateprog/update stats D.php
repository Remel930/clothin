<?php
session_start();

// Connect to the orderformanu database
$product_connection = mysqli_connect("localhost", "root", "", "orderforretailer");

// Check if connection was successful
if (!$product_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_ids'])) {
    $notification_ids = $_POST['notification_ids'];

    foreach ($notification_ids as $id) {
        // Update order status to "ARRIVED ON DESTINATION"
        $update_query = "UPDATE retailerorders SET status='ORDER HAS ARRIVED' WHERE id=$id";

        if (!mysqli_query($product_connection, $update_query)) {
            $_SESSION['message'] = "Error updating status: " . mysqli_error($product_connection);
            header("Location: retailer.php");
            exit;
        }
    }

    $_SESSION['message'] = "Status updated successfully!";
    header("Location: retailer.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch order details
    $order_query = "SELECT * FROM retailerorders WHERE id=$id";
    $order_result = mysqli_query($product_connection, $order_query);

    if (!$order_result) {
        $_SESSION['message'] = "Error fetching order details: " . mysqli_error($product_connection);
        header("Location: transactionhistoryD.php");
        exit;
    }

    $order = mysqli_fetch_assoc($order_result);
    $item = $order['item'];
    $quantity = $order['quantity'];
    $gender = $order['gender'];
    $size = $order['size'];

    // Switch to the clothes database
    mysqli_select_db($product_connection, "clothes");

    // Update stock of the chosen item, gender, and size
    $update_stock_query = "UPDATE clothesm SET stocks = stocks - $quantity WHERE items='$item' AND gender='$gender' AND sizes='$size'";

    if (!mysqli_query($product_connection, $update_stock_query)) {
        $_SESSION['message'] = "Error updating stock: " . mysqli_error($product_connection);
    } else {
        $_SESSION['message'] = "Status updated successfully and stock reduced!";
    }

    // Switch back to the orderformanu database
    mysqli_select_db($product_connection, "orderforretailer");

    // Update order status to "DELIVERED"
    $update_query = "UPDATE retailerorders SET status='DELIVERED' WHERE id=$id";

    if (!mysqli_query($product_connection, $update_query)) {
        $_SESSION['message'] = "Error updating status: " . mysqli_error($product_connection);
    }

    // Redirect back to the main page after updating
    header("Location: transactionhistoryD.php");
    exit;
}

// Close database connections
mysqli_close($product_connection);

?>
