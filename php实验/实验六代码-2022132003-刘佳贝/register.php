<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $realname = $_POST['realname'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $checkUserQuery = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        echo "用户名已存在，请选择其他用户名。";
    } else {
        $insertQuery = "INSERT INTO users (username, realname, password) VALUES ('$username', '$realname', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "注册成功！";
        } else {
            echo "注册失败: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>注册</title>
</head>
<body>
    <h2>注册</h2>
    <form method="post">
        用户名: <input type="text" name="username" required><br>
        真实姓名: <input type="text" name="realname" required><br>
        密码: <input type="password" name="password" required><br>
        <input type="submit" value="注册">
    </form>
    <a href="index.php">登录</a>
</body>
</html>
