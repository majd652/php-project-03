document.getElementById("fileInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById("preview");
            preview.src = e.target.result;
            preview.style.display = "block";
            document.querySelector(".upload-text").style.display = "none";
        };
        reader.readAsDataURL(file);
    }
});
// Post functions
function toggleLike(postId) {
    fetch('like_post.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ post_id: postId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Find the like button and count element
            const post = document.querySelector(`.post[data-post-id="${postId}"]`);
            const likeBtn = post.querySelector('.like-btn');
            const likeCount = post.querySelector('.like-count');

            // Update like count and button state
            likeCount.textContent = data.likes;
            likeBtn.classList.toggle('liked', data.hasLiked);
            
            // Update button text
            const likeText = likeBtn.querySelector('.like-text');
            if (likeText) {
                likeText.textContent = data.hasLiked ? 'Liked' : 'Like';
            }
        } else {
            console.error('Like error:', data.error);
        }
    })
    .catch(error => {
        console.error('Network error:', error);
    });
}

function toggleComments(postId) {
    const commentsSection = document.getElementById(`comments-${postId}`);
    const isHidden = commentsSection.style.display === 'none';
    commentsSection.style.display = isHidden ? 'block' : 'none';
    if (isHidden) {
        loadComments(postId);
    }
}

function loadComments(postId) {
    fetch(`get_comments.php?post_id=${postId}`)
    .then(response => response.json())
    .then(comments => {
        const commentsList = document.getElementById(`comments-list-${postId}`);
        commentsList.innerHTML = comments.map(comment => `
            <div class="comment">
                <strong>${comment.username}</strong>
                <p>${comment.content}</p>
                ${comment.user_id == userId ? 
                    `<button onclick="deleteComment(${comment.id})">Delete</button>` : 
                    ''}
            </div>
        `).join('');
    });
}

function addComment(event, postId) {
    event.preventDefault();
    const form = event.target;
    const input = form.querySelector('input');
    
    fetch('add_comment.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 
            post_id: postId, 
            content: input.value 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            loadComments(postId);
        }
    });
}

function deleteComment(commentId) {
    if (confirm('Are you sure you want to delete this comment?')) {
        fetch('delete_comment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ comment_id: commentId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadComments(data.post_id);
            }
        });
    }
}

function deletePost(postId) {
    if (confirm('Are you sure you want to delete this post?')) {
        fetch('delete_post.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ post_id: postId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const post = document.querySelector(`.post[data-post-id="${postId}"]`);
                post.remove();
            } else {
                alert('Error deleting post: ' + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting post');
        });
    }
}