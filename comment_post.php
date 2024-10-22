<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disable error display for now

include('db_config.php');
session_start();

// Get the current user ID from session
$user_id = $_SESSION['user_id'];

// Get the post ID and comment content from the request
$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'];
$comment = $data['comment'];

if ($post_id && $user_id && $comment) {
    // Insert the comment into the database
    $query = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iis', $post_id, $user_id, $comment);

    if ($stmt->execute()) {
        // Return a success response along with the new comment's info
        echo json_encode([
            'success' => true,
            'comment' => [
                'content' => $comment,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add comment.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input.']);
}

$conn->close();
