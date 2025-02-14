<?php
require_once '../config/db.php';

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Перевірка, чи поля не порожні
    if (empty($username) || empty($password)) {
        die("Username and password are required.");
    }

    // Перевірка довжини імені користувача
    if (strlen($username) < 3 || strlen($username) > 20) {
        die("Username must be between 3 and 20 characters.");
    }

    try {
        // Перевірка унікальності імені користувача
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            die("Username is already taken. Please choose another one.");
        }

        // Хешування пароля
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Додавання нового користувача
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Registration successful! You can now <a href='../../html/auth/login.html'>login</a>.";
        } else {
            echo "Error: Unable to register.";
        }

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>
