<?php
require_once '../config/db.php';

session_start();

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    try {
        $stmt = $pdo->prepare("SELECT password, user_id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id'];

            // Захист від XSS та Clickjacking
            header("X-Frame-Options: DENY");
            header("Content-Security-Policy: default-src 'self';");

            header("Location: ../../index.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        die("Помилка: " . $e->getMessage());
    }
}
?>
