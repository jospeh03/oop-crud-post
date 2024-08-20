<?php
require 'Database.php';
require 'Posts.php';

$db = new Database();
$conn = $db->connect();
$post = new Post($conn);

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required';
    }
    if (empty($_POST['content'])) {
        $errors['content'] = 'Content is required';
    }

    $old['title'] = $_POST['title'] ?? '';
    $old['content'] = $_POST['content'] ?? '';

    if (empty($errors)) {
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->author = $_POST['author'] ?? 'Anonymous';

        if ($post->create()) {
            header('Location: index.php');
            exit();
        } else {
            $errors['general'] = 'Failed to create the post.';
        }
    }
}

ob_start();
?>

<h1>Create New Post</h1>

<?php if (!empty($errors['general'])): ?>
    <div class="alert alert-danger">
        <?php echo $errors['general']; ?>
    </div>
<?php endif; ?>

<form action="create_post.php" method="POST">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($old['title'] ?? ''); ?>">
        <?php if (isset($errors['title'])): ?>
            <span class="error"><?php echo $errors['title']; ?></span>
        <?php endif; ?>
    </div>
    
    <div class="form-group">
        <label for="content">Content:</label>
        <textarea id="content" name="content" class="form-control"><?php echo htmlspecialchars($old['content'] ?? ''); ?></textarea>
        <?php if (isset($errors['content'])): ?>
            <span class="error"><?php echo $errors['content']; ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" class="form-control" value="<?php echo htmlspecialchars($old['author'] ?? ''); ?>">
    </div>

    <button type="submit" class="btn btn-primary">Create Post</button>
</form>

<?php
$content = ob_get_clean();
$title = 'Create New Post';
include 'layout.php';
