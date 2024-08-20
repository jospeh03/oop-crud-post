<?php
require 'Database.php';
require 'Posts.php';

$db = new Database();
$conn = $db->connect();
$post = new Post($conn);

$errors = [];

if (isset($_GET['id'])) {
    $postToEdit = $post->read($_GET['id']);
    if (!$postToEdit) {
        echo "Post not found!";
        exit();
    }
} else {
    echo "No post ID provided!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required';
    }
    if (empty($_POST['content'])) {
        $errors['content'] = 'Content is required';
    }

    if (empty($errors)) {
        $post->id = $_GET['id'];
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->author = $_POST['author'] ?? 'Anonymous';

        if ($post->update()) {
            header('Location: index.php');
            exit();
        } else {
            $errors['general'] = 'Failed to update the post.';
        }
    }
}

ob_start();
?>

<h1>Edit Post</h1>

<?php if (!empty($errors['general'])): ?>
    <div class="alert alert-danger">
        <?php echo $errors['general']; ?>
    </div>
<?php endif; ?>

<form action="edit_post.php?id=<?php echo $postToEdit['id']; ?>" method="POST">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($postToEdit['title']); ?>">
        <?php if (isset($errors['title'])): ?>
            <span class="error"><?php echo $errors['title']; ?></span>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea id="content" name="content" class="form-control"><?php echo htmlspecialchars($postToEdit['content']); ?></textarea>
        <?php if (isset($errors['content'])): ?>
            <span class="error"><?php echo $errors['content']; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" class="form-control" value="<?php echo htmlspecialchars($postToEdit['author']); ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update Post</button>
</form>

<?php
$content = ob_get_clean();
$title = 'Edit Post';
include 'layout.php';
