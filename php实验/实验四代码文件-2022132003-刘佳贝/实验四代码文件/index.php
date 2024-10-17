<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        /* CSS 美化 */
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: 0 auto; padding-top: 50px; }
        label, input { display: block; width: 100%; margin-bottom: 10px; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <!-- 可选：图片验证码 -->
            <!-- <label for="captcha">Captcha:</label>
            <input type="text" id="captcha" name="captcha" required>
            <img src="captcha.php" alt="Captcha Image">
            <button type="submit">Login</button> -->
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </div>
</body>
</html>
