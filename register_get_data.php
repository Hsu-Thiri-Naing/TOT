<?php
 include 'db_config.php';

 $username = $_POST['uname'];
 $email = $_POST['email'];
 $password = $_POST['psw'];
 $hashed_password = password_hash( $password, PASSWORD_DEFAULT );

 $query = "INSERT INTO users( username, email, password )
           VALUES( '$username', '$email', '$hashed_password' ) ";
        
 mysqli_query( $conn, $query );

 header( "location: login.php" ); 
?>

<!-- <?php
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
    echo "Username already taken. Please choose another one.";
} else {
    // Proceed with inserting the new user
    $insertQuery = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();

// Close the connection
header( "location: login.php" ); 
?> -->
