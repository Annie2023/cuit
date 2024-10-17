<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$article_id = $_GET['id'];
$query = "SELECT * FROM articles WHERE id='$article_id'";
$result = $conn->query($query);
$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>查看博客</title>
</head>
<body>
    <h2><?php echo $article['title']; ?></h2>
    <p><?php echo nl2br($article['content']); ?></p>
    <a href="article_list.php">返回博客列表</a>
</body>
</html>
