<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $realname = $_POST['realname'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $updateQuery = "UPDATE users SET realname='$realname', password='$password' WHERE id='$user_id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "个人信息更新成功！";
    } else {
        echo "更新失败: " . $conn->error;
    }
}

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($query);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>个人信息</title>
</head>
<body>
    <h2>个人信息</h2>
    <form method="post">
        用户名: <input type="text" name="username" value="<?php echo $user['username']; ?>" readonly><br>
        真实姓名: <input type="text" name="realname" value="<?php echo $user['realname']; ?>" required><br>
        密码: <input type="password" name="password" required><br>
        <input type="submit" value="更新">
    </form>
    <a href="new_article.php">发布博客</a>
    <a href="article_list.php">查看博客列表</a>
    <a href="logout.php">退出</a>
</body>
</html>
