<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection for registration
    $reg_conn = new mysqli("localhost", "root", "", "reg");
    if ($reg_conn->connect_error) {
        die("Failed to connect to registration database: " . $reg_conn->connect_error);
    }

    // Prepare and execute SQL query to retrieve user data from registration database
    $stmt_reg = $reg_conn->prepare("SELECT roles, password FROM registration WHERE email = ?");
    $stmt_reg->bind_param("s", $email);
    $stmt_reg->execute();
    $stmt_result_reg = $stmt_reg->get_result();

    if ($stmt_result_reg->num_rows > 0) {
        $row = $stmt_result_reg->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) { 
            echo "User authenticated. ";
            // Redirect to respective page based on role
            switch ($row['roles']) {
                case 'm':
                    header("Location: manufacturer.php");
                    break;
                case 'd':
                    header("Location: distributer.php");
                    break;
                case 'r':
                    header("Location: retailer.php");
                    break;
                case 's':
                    header("Location: supplier.php");
                    break;
                case 'a': 
                    header("Location: admin.php");
                    break;
                default:
                    // Handle other roles or redirect to a default page
            }
            exit(); // Stop further execution
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt_reg->close();
    $reg_conn->close();
}
?>
