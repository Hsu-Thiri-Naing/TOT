<?php
include('db_config.php');
require_once('time_calculator.php');
$category = isset($_GET['category']) ? $_GET['category'] : null;


// Assuming the user ID is stored in the session
$user_id = $_SESSION["user_id"];
if ($category) {
    $query = "SELECT * FROM posts WHERE category_id = '$category'";
} else {
    $query = "SELECT * FROM posts ORDER BY created_at DESC";
}

$result = $conn->query($query);




while ($post = $result->fetch_assoc()) {
    // Check if the current user has liked this post
    $post_id = $post['id'];
    $likeQuery = "SELECT * FROM likes WHERE post_id = $post_id AND user_id = $user_id";
    $likeResult = $conn->query($likeQuery);
    $isLiked = $likeResult->num_rows > 0;  // True if the user has liked the post
    $commentQuery = "SELECT c.content, u.username, c.created_at FROM comments c
                    JOIN users u ON c.user_id = u.id
                    WHERE c.post_id = $post_id
                    ORDER BY c.created_at ASC";
    $commentResult = $conn->query($commentQuery);
?>
    <article class="post" id="post-<?php echo $post['id'] ?>">
        <div class="post-header">
            <div class="post-title">
                <h3><?php echo $post['title'] ?></h3>
            </div>
            <div class="close-btn" onclick="hidePost(<?php echo $post['id']; ?>)">
                <img src="Close.png" width="30" height="30" alt="Close">
            </div>


            <!-- <p>Posted by <?php echo $post['author'] ?> on <?php echo $post['date'] ?></p> -->
        </div>
        <div class="posted-time" style="color :#71797E; margin-top : 5px; margin-left: 5px">
            <p><?php echo simple_time_ago($post['created_at']) ?></p>
        </div>

        <!-- Display post image if available -->
        <?php if ($post['image_path']) { ?>
            <div class="post-image">
                <img src="<?php echo $post['image_path']; ?>" alt="Post Image"">
            </div>
        <?php } ?>


        <div class=" post-content"><?php echo $post['content'] ?>
            </div>
            <div class="post-actions">
                <!-- Like button with thumbs-up icon -->
                <button id="like-button-<?php echo $post['id'] ?>" class="<?php echo $isLiked ? 'liked' : 'not-liked'; ?>" onclick="likePost(<?php echo $post['id'] ?>)">
                    <i class="fa <?php echo $isLiked ? 'fa-thumbs-up' : 'fa-thumbs-o-up'; ?>"></i>
                    <span id="like-count-<?php echo $post['id'] ?>"><?php echo $post['likes'] ?></span>
                </button>


                <button onclick="savePost(<?php echo $post['id'] ?>)">Save</button>
                <button onclick="toggleCommentBox(<?php echo $post['id'] ?>)">Comment</button>


            </div>

            <div id="comment-box-<?php echo $post['id'] ?>" class="comment-box" style="display: none;">
                <button class="showComments" id="showAll-<?php echo $post['id']; ?>" onclick="toggleComments(<?php echo $post['id']; ?>)">
                    Show Comments
                </button>
                <div class="comments" id="commentList-<?php echo $post['id']; ?>" style="display: none;">
                    <?php while ($comment = $commentResult->fetch_assoc()) { ?>
                        <div class="comment">
                            <strong><?php echo $comment['username']; ?>:</strong>
                            <p><?php echo $comment['content']; ?></p>
                            <small><?php echo $comment['created_at']; ?></small>
                        </div>
                    <?php } ?>
                </div>
                <textarea id="comment-<?php echo $post['id'] ?>" placeholder="Enter your comment..."></textarea>
                <button onclick="commentPost(<?php echo $post['id'] ?>)"><i class="fa-solid fa-paper-plane"></i></button>
            </div>

    </article>

<?php }



?>