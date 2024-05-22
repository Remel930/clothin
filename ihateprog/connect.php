<?php
$Fname = $_POST['Fname'];
$Lname = $_POST['Lname'];
$roles = $_POST['roles'];
$email = $_POST['email'];
$password = $_POST['password'];
$number = $_POST['number'];

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$conn = new mysqli('localhost', 'root', '', 'reg');
if ($conn->connect_error) {
    die('Connection failed :' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registration(firstname, lastname, roles, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $Fname, $Lname, $roles, $email, $hashedPassword, $number);
    $stmt->execute();
    echo "Registration success";
    $stmt->close();
    $conn->close();
}
?>
