<?php
$servername = "localhost";
$username = "maxim";
$password = "admin";
$dbname = "user_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password, user_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password, $user_id);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Початок сесії
        session_start();

        // Збереження username та user_id у сесії
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;

        // Перенаправлення на індексну сторінку
        header("Location: ../../index.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>