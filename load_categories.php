<?php
include('db_config.php');

$query = "SELECT * FROM categories";
$result = $conn->query($query);

while ($category = $result->fetch_assoc()) {
    echo "<li><a href='index.php?category=" . $category['id'] . "'>" . $category['name'] . "</a></li>";
}
?>
