<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
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
        <form action="edit_profile.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            <label for="qq">QQ:</label>
            <input type="text" id="qq" name="qq" value="<?php echo htmlspecialchars($user['qq']); ?>" required>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <button type="submit">Update</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <?php if (isset($success)) echo "<p>$success</p>"; ?>
    </div>
</body>
</html>
