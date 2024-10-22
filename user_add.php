<?php
include('db_config.php');

// Get form data
$username = $_POST['uname'];
$password = $_POST['psw'];  // Assuming you are getting this from your form
$email = $_POST['email'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the username already exists
$checkQuery = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username already exists
    echo '<script>alert("Username already taken. Please choose another one.");</script>';
    header("location:register.php");
} else {
    // Proceed with inserting the new user
    $insertQuery = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

header( "location: login.php" ); 

}
$conn->close();

// Close the connection
