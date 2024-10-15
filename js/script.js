function toggleCommentBox(postId) {
    const commentBox = document.getElementById('comment-box-' + postId);
    commentBox.style.display = commentBox.style.display === 'none' ? 'block' : 'none';
}