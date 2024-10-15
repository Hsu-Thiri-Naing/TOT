<?php
include('db_config.php');
require_once('time_calculator.php');
$category = isset($_GET['category']) ? $_GET['category'] : null;

if ($category) {
    $query = "SELECT * FROM posts WHERE category_id = '$category'";
} else {
    $query = "SELECT * FROM posts ORDER BY RAND()";  
}

$result = $conn->query($query);

while ($post = $result->fetch_assoc()) { ?>
    <article class="post">
        <div class="post-header">
            <div class="post-title">
                <h3><?php echo $post['title'] ?></h3>
            </div>
            <div class="close-btn">
                <img src="Close.png" width="30" height="30" alt="">
            </div>


            <!-- <p>Posted by <?php echo $post['author'] ?> on <?php echo $post['date'] ?></p> -->
        </div>
        <div class="posted-time" style="color :#71797E; margin-top : 5px; margin-left: 5px">
            <p><?php echo simple_time_ago($post['created_at']) ?></p>
        </div>


        <div class="post-content"><?php echo $post['content'] ?></div>
        <div class="post-actions">
            <button onclick="likePost(<?php echo $post['id'] ?>)">Like</button>
            <button onclick="savePost(<?php echo $post['id'] ?>)">Save</button>
            <button onclick="toggleCommentBox(<?php echo $post['id'] ?>)">Comment</button>


        </div>
        <div id="comment-box-<?php echo $post['id'] ?>" class="comment-box" style="display: none;">
            <textarea id="comment-<?php echo $post['id'] ?>" placeholder="Enter your comment..."></textarea>
            <button onclick="commentPost(<?php echo $post['id'] ?>)">Submit</button>
        </div>
    </article>

<?php }



?>