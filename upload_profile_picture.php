<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $user_id = $_SESSION['user_id'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Update user profile picture
            $query = "UPDATE users SET image_path = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $target_file, $user_id);
            $stmt->execute();
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Redirect back to the profile page
header("Location: profile.php");
exit;
?>
