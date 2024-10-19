<?php
session_start();
include('db_config.php');
require_once('time_calculator.php');

// Assuming user is logged in
$user_id = $_SESSION['user_id'];

// Fetch user information
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

// Fetch saved posts
$postQuery = "SELECT p.* FROM saved_posts sp
              JOIN posts p ON sp.post_id = p.id
              WHERE sp.user_id = ?";
$stmt = $conn->prepare($postQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$savedPostsResult = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>

<a href="index.php">Back to Home</a>

<div class="profile-container">
    <!-- Profile Picture Section -->
    <div class="profile-picture">
        <img src="<?php echo $user['image_path'] ? $user['image_path'] : 'assets/default_user.png'; ?>" alt="Profile Picture">
        <form action="upload_profile_picture.php" method="POST" enctype="multipart/form-data">
            <label for="profile-pic-upload" class="upload-btn">Upload New Picture</label>
            <input type="file" name="profile_picture" id="profile-pic-upload" onchange="this.form.submit()" style="display:none;">
        </form>
    </div>

    <!-- User Info Section -->
    <div class="profile-info">
        <h2><?php echo $user['username']; ?></h2>
        <p>Email: <?php echo $user['email']; ?></p>
        <!-- <p>Phone: <?php echo $user['phone']; ?></p> -->
    </div>

    <!-- Saved Posts Section -->
    <div class="saved-posts">
    <h3>Saved Posts</h3>
    <?php if ($savedPostsResult->num_rows > 0) { ?>
        <ul>
            <?php while ($post = $savedPostsResult->fetch_assoc()) { ?>
                <li>
                    <article class="post">
                        <div class="post-header">
                            <div class="post-title">
                                <h3><?php echo $post['title']; ?></h3>
                            </div>
                        </div>
                        <div class="posted-time" style="color: #71797E; margin-top: 5px; margin-left: 5px">
                            <p><?php echo simple_time_ago($post['created_at']); ?></p>
                        </div>

                        <!-- Display post image if available -->
                        <?php if ($post['image_path']) { ?>
                            <div class="post-image">
                                <img src="<?php echo $post['image_path']; ?>" alt="Post Image" style="width: 100%; max-height: 400px; object-fit: cover;">
                            </div>
                        <?php } ?>

                        <div class="post-content"><?php echo $post['content']; ?></div>
                    </article>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>No saved posts yet.</p>
    <?php } ?>
</div>

</div>

</body>
</html>
