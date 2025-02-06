<?php
require '../config/db.php';

$conn = new mysqli($host, $username, $password, $dbname);

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
        session_start();

        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;

        header("Location: ../../index.php");
        exit;
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>