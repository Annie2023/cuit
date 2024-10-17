<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: personal.php");
            exit();
        } else {
            echo "密码错误。";
        }
    } else {
        echo "用户不存在。";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>登录</title>
</head>
<body>
    <h2>登录</h2>
    <form method="post">
        用户名: <input type="text" name="username" required><br>
        密码: <input type="password" name="password" required><br>
        <input type="submit" value="登录">
    </form>
    <a href="register.php">注册</a>
</body>
</html>
