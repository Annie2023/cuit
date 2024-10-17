<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $insertQuery = "INSERT INTO articles (user_id, title, content) VALUES ('$user_id', '$title', '$content')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "博客发布成功！";
    } else {
        echo "发布失败: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>发布博客</title>
</head>
<body>
    <h2>发布博客</h2>
    <form method="post">
        标题: <input type="text" name="title" required><br>
        内容: <textarea name="content" required></textarea><br>
        <input type="submit" value="发布">
    </form>
    <a href="article_list.php">查看博客列表</a>
    <a href="personal.php">个人信息</a>
</body>
</html>
