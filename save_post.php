<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    // Check if the post is already saved
    $checkQuery = "SELECT * FROM saved_posts WHERE user_id = ? AND post_id = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ii", $user_id, $post_id);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows == 0) { // If not already saved
        // Insert into saved_posts table
        $insertQuery = "INSERT INTO saved_posts (user_id, post_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ii", $user_id, $post_id);
        $stmt->execute();
    }

    echo "Post saved successfully";
}
?>
