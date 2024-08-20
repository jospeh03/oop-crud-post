<?php
require 'Database.php';
require 'Posts.php';
$db = new Database();
$conn = $db->connect();
$post = new Post($conn);

$posts = $post->readAll();

ob_start();
?>

<h1>All Posts</h1>
<a href="create_post.php" class="btn btn-primary">Create New Post</a>
<ul class="post-list">
    <?php foreach ($posts as $post): ?>
        <li>
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <p><strong>Author:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
            <p><strong>Created At:</strong> <?php echo htmlspecialchars($post['created_at']); ?></p>
            <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">View</a>
            <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Edit</a>
            <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>

<?php
$content = ob_get_clean();
$title = 'All Posts';
include 'layout.php';
