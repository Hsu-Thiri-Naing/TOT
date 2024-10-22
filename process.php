<?php
// Allow requests from any origin (for CORS purposes)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

// Get the incoming JSON data
$data = file_get_contents("php://input");
$postData = json_decode($data, true); // Convert JSON into PHP array

// Check if data exists
if ($postData) {
    // Prepare the response
    $response = array(
        "status" => "success",
        "message" => "Post received!",
        "data" => $postData
    );
} else {
    // If no data received, send an error response
    $response = array(
        "status" => "error",
        "message" => "No post data received!"
    );
}

// Send the response back as JSON
echo json_encode($response);
?>
