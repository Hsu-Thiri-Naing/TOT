<?php
include('db_config.php');

// Start the session to get user information
session_start();

// Check if the user is logged in and the post ID is provided
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

// Get the JSON payload (postId)
$data = json_decode(file_get_contents('php://input'), true);
$postId = isset($data['id']) ? $data['id'] : null;

if (!$postId) {
    echo json_encode(['success' => false, 'message' => 'No post ID provided']);
    exit;
}

// Check if the user has already liked the post
$stmt = $conn->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
$stmt->bind_param("ii", $user_id, $postId);
$stmt->execute();
$result = $stmt->get_result();

// If the user has already liked the post, we will unlike it
if ($result->num_rows > 0) {
    // Unlike the post: remove the like entry and decrement the like count
    $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
    $stmt->bind_param("ii", $user_id, $postId);
    $stmt->execute();

    // Decrease the likes count in the posts table
    $stmt = $conn->prepare("UPDATE posts SET likes = likes - 1 WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    // Get the new like count
    $stmt = $conn->prepare("SELECT likes FROM posts WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->bind_result($newLikeCount);
    $stmt->fetch();

    // Respond with success and the updated like count
    echo json_encode(['success' => true, 'liked' => false, 'newLikeCount' => $newLikeCount]);

} else {
    // Like the post: insert a new entry in the likes table and increment the like count
    $stmt = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $postId);
    $stmt->execute();

    // Increase the likes count in the posts table
    $stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    // Get the new like count
    $stmt = $conn->prepare("SELECT likes FROM posts WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->bind_result($newLikeCount);
    $stmt->fetch();

    // Respond with success and the updated like count
    echo json_encode(['success' => true, 'liked' => true, 'newLikeCount' => $newLikeCount]);
}

// Close the prepared statement and connection
$stmt->close();
$conn->close();
?>
