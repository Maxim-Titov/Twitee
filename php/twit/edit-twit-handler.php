<?php
require '../config/db.php';

$db = new Database();
$pdo = $db->getConnection();

if (!isset($_GET['twit_id'])) {
    die("Невірний запит.");
}

$twit_id = $_GET['twit_id'];

$query = "SELECT title, content FROM twits WHERE twit_id = :twit_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':twit_id', $twit_id, PDO::PARAM_INT);
$stmt->execute();
$twit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$twit) {
    die("Твіт не знайдено.");
}
?>
