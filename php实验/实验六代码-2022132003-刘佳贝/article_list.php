<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$query = "SELECT * FROM articles WHERE user_id='$user_id' LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$totalQuery = "SELECT COUNT(*) AS total FROM articles WHERE user_id='$user_id'";
$totalResult = $conn->query($totalQuery);
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
    <title>博客列表</title>
</head>
<body>
    <h2>博客列表</h2>
    <table border="1">
        <tr>
            <th>标题</th>
            <th>操作</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td>
                <a href="view_article.php?id=<?php echo $row['id']; ?>">查看</a>
                <a href="delete_article.php?id=<?php echo $row['id']; ?>">删除</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="article_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>
    <a href="personal.php">个人信息</a>
</body>
</html>
