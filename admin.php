<?php
// Include the database configuration file
include 'db_config.php';

// Handle form submission for adding a new post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    
    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imageDir = 'uploads/';
        $imagePath = $imageDir . time() . '_' . $imageName; // Add timestamp to avoid conflicts

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // File uploaded successfully
        } else {
            echo "Failed to upload image.";
        }
    }

    // Insert the new post into the database (including image if uploaded)
    $sql = "INSERT INTO posts (title, content, category_id, image_path) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $title, $content, $category, $imagePath);
    $stmt->execute();
}

if(isset($_POST['add_category'])){
    $category_name = $_POST['category_name'];

    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
}

//delete category
if(isset($_GET['delete_category_id'])){
    $delete_category_id= $_GET['delete_category_id'];
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_category_id);
    $stmt->execute();
}

// Handle post deletion
if (isset($_GET['delete_post_id'])) {
    $delete_post_id = $_GET['delete_post_id'];
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_post_id);
    $stmt->execute();
}

// Fetch posts from the database
$sql = "SELECT p.id, p.title, p.content, c.name AS category FROM posts p JOIN categories c ON p.category_id = c.id";
$result_posts = $conn->query($sql);

// Fetch users from the database
$sql_users = "SELECT * FROM users";
$result_users = $conn->query($sql_users);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<header>
    <h1>Admin Panel</h1>
</header>

<div class="container">
    <div class="main">
        <h2>User Management</h2>


        <!-- Form to add a new user -->
        <form method="POST" action="admin.php" enctype="multipart/form-data">
    <h3>Add New Post</h3>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea>

    <label for="category">Category:</label>
    <select id="category" name="category" required>
        <option value="">Select a category</option>
        <!-- Populate categories from database -->
        <?php
        $sql_categories = "SELECT * FROM categories";
        $result_categories = $conn->query($sql_categories);
        while ($category = $result_categories->fetch_assoc()) {
            echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
        }
        ?>
    </select>

    <!-- Image upload field -->
    <label for="image">Upload Image:</label>
    <input type="file" name="image" id="image">

    <button type="submit" name="add_post">Add Post</button>
</form>
        <h2>Category Management</h2>
        <h3>Existing Categories</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql_categories = "SELECT * FROM categories";
            $result_categories = $conn->query($sql_categories);
            if($result_categories->num_rows > 0){
                while($category = $result_categories->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>" . $category['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($category['name']) . "</td>";
                    echo "<td>
                            <a href='?delete_category_id=" . $category['id'] . "' onclick='return confirm(\"Are you sure you want to delete this category?\");'>Delete</a>
                            </td>";
                    echo "</tr>";
                }
                
            }else {
                echo "<tr><td colspan='3'>No categories found.</td></tr>";
            }
            ?>
        </table>
        <form action="" method="post">
            <h2>Add New Category</h2>
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" id="category_name" required>
            <button type="submit" name="add_category">Add Category</button>
        </form>


        <!-- Table to display users -->
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php if ($result_users->num_rows > 0): ?>
                <?php while ($row = $result_users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No users found.</td>
                </tr>
            <?php endif; ?>
        </table>

        <h2>Post Management</h2>

        <!-- Form to add a new post -->
        <form method="POST" action="">
            <h3>Add New Post</h3>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <!-- Populate categories from database -->
                <?php
                $sql_categories = "SELECT * FROM categories";
                $result_categories = $conn->query($sql_categories);
                while ($category = $result_categories->fetch_assoc()) {
                    echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
                }
                ?>
            </select>

            <button type="submit" name="add_post">Add Post</button>
        </form>

        <!-- Table to display posts -->
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php if ($result_posts->num_rows > 0): ?>
                <?php while ($post = $result_posts->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['content']); ?></td>
                        <td><?php echo htmlspecialchars($post['category']); ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a> |
                            <a href="?delete_post_id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No posts found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<footer>
    <p>&copy; Trends Of TUM</p>
</footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
