<?php
// Include the database configuration file
include 'db_config.php';

// Get the post ID from the URL
$post_id = $_GET['id'];

// Fetch the post details from the database
$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated post details from the form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    
    // Check if an image has been uploaded
    if ($_FILES['image']['name']) {
        $imageName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = "uploads/" . $imageName;

        // Move the uploaded image to the uploads folder
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Update the post with the new image
            $sql = "UPDATE posts SET title = ?, content = ?, category_id = ?, image_path = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssisi", $title, $content, $category, $imagePath, $post_id);
        } else {
            echo "Failed to upload image.";
        }
    } else {
        // Update the post without changing the image
        $sql = "UPDATE posts SET title = ?, content = ?, category_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $content, $category, $post_id);
    }

    // Execute the query
    if ($stmt->execute()) {
        header('Location: admin.php?message=Post+updated+successfully');
        exit();
    } else {
        echo "Failed to update post.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<header>
    <h1>Edit Post</h1>
</header>

<div class="container">
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <?php
            $sql_categories = "SELECT * FROM categories";
            $result_categories = $conn->query($sql_categories);
            while ($category = $result_categories->fetch_assoc()) {
                $selected = ($category['id'] == $post['category_id']) ? 'selected' : '';
                echo '<option value="' . $category['id'] . '" ' . $selected . '>' . htmlspecialchars($category['name']) . '</option>';
            }
            ?>
        </select>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <p>Current image: <?php echo htmlspecialchars($post['image_path']); ?></p>
        <img src="<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image" style="max-width: 300px; display: block; margin-top: 10px;">

        <button type="submit">Update Post</button>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
