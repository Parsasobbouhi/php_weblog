<?php
require 'db.php';
$stmt = $conn->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
</head>
<body>
    <h1>Blog</h1>
    <a href="create.php">Write a new blog</a>
    <ul>
    <?php foreach ($posts as $post): ?>
        <li>
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $post['id']; ?>">Delete</a>
            <h3>Comments</h3>
            <?php
            $stmt = $conn->prepare('SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC');
            $stmt->execute([$post['id']]);
            $comments = $stmt->fetchAll();
            ?>
            <ul>
            <?php foreach ($comments as $comment): ?>
                <li><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></li>
            <?php endforeach; ?>
            </ul>
            <form action="comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <textarea name="comment" required></textarea>
                <button type="submit">Send comment</button>
            </form>
        </li>
    <?php endforeach; ?>
    </ul>
</body>
</html>
