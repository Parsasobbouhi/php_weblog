<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];

    $stmt = $conn->prepare('INSERT INTO comments (post_id, comment, created_at) VALUES (?, ?, NOW())');
    $stmt->execute([$post_id, $comment]);

    header('Location: index.php');
    exit;
}
?>
