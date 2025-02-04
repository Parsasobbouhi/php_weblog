<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $conn->prepare('INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())');
    $stmt->execute([$title, $content]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>New blog</title>
</head>
<body>
    <h1>Write a new blog</h1>
    <form method="post">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Inhalt:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">Back to home page</a>
</body>
</html>
