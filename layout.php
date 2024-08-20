<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Post Management'; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">Post Management</a>
            <ul class="navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="create_post.php">Create Post</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <?php echo $content ?? ''; ?>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Post Management System</p>
        </div>
    </footer>
</body>
</html>
