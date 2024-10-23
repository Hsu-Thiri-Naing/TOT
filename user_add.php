<?php
include('db_config.php');

// Get form data
$username = $_POST['uname'];
$password = $_POST['psw'];
$email = $_POST['email'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the username or email already exists
$checkQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the result to determine if it's the username or email that already exists
    $existingUser = $result->fetch_assoc();
    
    if ($existingUser['username'] === $username) {
        // Username already exists
        header("location:register.php?message=Username+already+exists.&type=error");
    } elseif ($existingUser['email'] === $email) {
        // Email already exists
        header("location:register.php?message=Email+already+exists.&type=error");
    }
} else {
    // Proceed with inserting the new user
    $insertQuery = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
       
        header("location: login.php?message=Successfully+registered!&type=success");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
