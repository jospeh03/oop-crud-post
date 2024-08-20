<?php
require 'Database.php';
require 'Post.php';

$db = new Database();
$conn = $db->connect();
$post = new Post($conn);

if (isset($_GET['id'])) {
    $postDetails = $post->read($_GET['id']);
    if (!$postDetails) {
        echo "Post not found!";
        exit();
    }
} else {
    echo "No post ID provided!";
    exit();
}

ob_start();
?>

<h1><?php echo htmlspecialchars($postDetails['title']); ?></h1>
<p><strong>Author:</strong> <?php echo htmlspecialchars($postDetails['author']); ?></p>
<p><strong>Created At:</strong> <?php echo htmlspecialchars($postDetails['created_at']); ?></p>
<p><?php echo nl2br(htmlspecialchars($postDetails['content'])); ?></p>
<a href="index.php" class="btn btn-secondary">Back to Posts</a>

<?php
$content = ob_get_clean();
$title = 'View Post';
include 'layout.php';
