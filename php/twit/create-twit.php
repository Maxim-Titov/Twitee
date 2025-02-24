<?php
session_start();

require '../config/db.php';

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        die("Unauthorized");
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO twits (title, content, created_at, date, user_id) VALUES (:title, :content, NOW(), NOW(), :user_id)");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../../index.php");
        exit;
    } else {
        die("Error adding twit.");
    }
}
?>