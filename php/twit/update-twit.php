<?php
session_start();

// Підключення до БД
$host = 'localhost';
$dbname = 'user_database';
$username = 'maxim';
$password = 'admin';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}

// Перевіряємо, чи передані потрібні дані
if (!isset($_POST['twit_id'], $_POST['title'], $_POST['content'])) {
    die("Невірний запит.");
}

$twit_id = $_POST['twit_id'];
$title = $_POST['title'];
$content = $_POST['content'];

// Оновлюємо твіт у базі даних
$query = "UPDATE twits SET title = :title, content = :content WHERE twit_id = :twit_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->bindParam(':content', $content, PDO::PARAM_STR);
$stmt->bindParam(':twit_id', $twit_id, PDO::PARAM_INT);

if ($stmt->execute()) {
    header("Location: my-twits.php");
    exit();
} else {
    echo "Помилка при оновленні твіта.";
}
