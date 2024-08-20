<?php
require 'Database.php';
require 'Posts.php';

$db = new Database();
$conn = $db->connect();
$post = new Post($conn);

if (isset($_GET['id'])) {
    $post->delete($_GET['id']);
    header('Location: index.php');
    exit();
} else {
    echo "No post ID provided!";
    exit();
}
