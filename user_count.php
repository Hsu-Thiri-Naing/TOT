<?php
include('db_config.php');

$query = "SELECT COUNT(*) as count FROM users";
$result = $conn->query($query);
$row = $result->fetch_assoc();

echo $row['count'];
?>
