<?php
require 'db.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
    $stmt->execute([$title, $content, $id]);

    header('Location: index.php');
    exit;
} else {
    $stmt = $conn->prepare('SELECT * FROM posts WHERE id = ?');
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    if (!$post) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="index.php">Back to Homepage</a>
</body>
</html>
