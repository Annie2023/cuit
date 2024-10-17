<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$article_id = $_GET['id'];
$query = "DELETE FROM articles WHERE id='$article_id' AND user_id='{$_SESSION['user_id']}'";
if ($conn->query($query) === TRUE) {
    header("Location: article_list.php");
} else {
    echo "删除失败: " . $conn->error;
}
?>
