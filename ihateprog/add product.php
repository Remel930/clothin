<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['items'];
    $gender = $_POST['gender'];
    $sizes = implode(',', $_POST['sizes']); // Convert array to comma-separated string
    $cost = $_POST['cost'];
    $stocks = $_POST['stocks']; // Corrected: Missing semicolon added
    $productlevel = $_POST['productlevel'];

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password set
    $database = "clothes"; // Replace 'your_database_name' with your actual database name

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'clothes');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO clothessup (items, gender, sizes, cost, stocks, productlevel) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters and execute
    $stmt->bind_param("ssssis", $name, $gender, $sizes, $cost, $stocks, $productlevel);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>
                if (confirm('Product added successfully! Click OK to go back.')) {
                    window.history.back(); // Go back to the previous page
                } else {
                    window.history.back(); // Optionally handle the Cancel button case
                }
              </script>";
    } else {
        echo "Error: Unable to add product.";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
