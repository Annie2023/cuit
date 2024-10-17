<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        /* CSS 美化 */
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: 0 auto; padding-top: 50px; }
        h1 { color: #4CAF50; }
        p { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
        <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
        <p>QQ: <?php echo htmlspecialchars($user['qq']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>