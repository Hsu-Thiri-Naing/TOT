function hidePost(postId) {
  const postElement = document.getElementById("post-" + postId);
  if (postElement) {
    postElement.style.display = "none"; // Hide the post
  }
}

function toggleCommentBox(postId) {
  const commentBox = document.getElementById("comment-box-" + postId);

  commentBox.style.display =
    commentBox.style.display === "none" ? "block" : "none";
}

function toggleComments(postId) {
  const commentList = document.getElementById("commentList-" + postId);
  const showCommentsButton = document.getElementById("showAll-" + postId);

  // Toggle the comment list visibility
  if (
    commentList.style.display === "none" ||
    commentList.style.display === ""
  ) {
    commentList.style.display = "block";
    showCommentsButton.textContent = "Hide Comments";
  } else {
    commentList.style.display = "none";
    showCommentsButton.textContent = "Show Comments";
  }
}

function likePost(postId) {
  fetch("like_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: postId }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const likeButton = document.querySelector(`#like-button-${postId}`);
        const likeCountDisplay = document.querySelector(
          `#like-count-${postId}`
        );
        const likeIcon = likeButton.querySelector("i");

        // Toggle button text and style
        if (data.liked) {
          likeIcon.classList.remove("fa-thumbs-o-up");
          likeIcon.classList.add("fa-thumbs-up"); // Change to filled thumbs-up
          likeButton.classList.add("liked");
          likeButton.classList.remove("not-liked");
        } else {
          likeIcon.classList.remove("fa-thumbs-up");
          likeIcon.classList.add("fa-thumbs-o-up"); // Change back to outline thumbs-up
          likeButton.classList.add("not-liked");
          likeButton.classList.remove("liked");
        }

        // Update the like count
        if (likeCountDisplay && data.newLikeCount !== undefined) {
          likeCountDisplay.textContent = `${data.newLikeCount}`;
        } else {
          console.error("Like count is undefined in the server response.");
        }
      } else {
        alert("Failed to like the post. Please try again.");
      }
    })
    .catch((error) => console.error("Error:", error));
}

function savePost(postId) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "save_post.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Optionally handle the response
      
    }
  };
  xhr.send("post_id=" + postId);
}

function commentPost(postId) {
  const commentContent = document.getElementById(`comment-${postId}`).value;

  if (!commentContent) {
    alert("Comment cannot be empty.");
    return;
  }

  fetch("comment_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      post_id: postId,
      comment: commentContent,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        // Get the comment box and append the new comment
        // const commentsContainer = document.querySelector(`#comment-box-${postId}`).previousElementSibling;
        const commentsContainer = document.getElementById(
          "commentList-" + postId
        );
        const newComment = document.createElement("div");
        newComment.classList.add("comment");
        newComment.innerHTML = `
                <strong>You:</strong>
                <p>${data.comment.content}</p>
                <small>${data.comment.created_at}</small>
            `;

        commentsContainer.appendChild(newComment);

        // Clear the textarea
        document.getElementById(`comment-${postId}`).value = "";
      } else {
        alert(data.message || "Failed to add comment.");
      }
    })
    .catch((error) => console.error("Error:", error));
}
