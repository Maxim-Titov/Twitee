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

// Перевіряємо, чи переданий twit_id
if (!isset($_GET['twit_id'])) {
    die("Невірний запит.");
}

$twit_id = $_GET['twit_id'];

// Отримуємо твіт для редагування
$query = "SELECT title, content FROM twits WHERE twit_id = :twit_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':twit_id', $twit_id, PDO::PARAM_INT);
$stmt->execute();
$twit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$twit) {
    die("Твіт не знайдено.");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitee</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <div class="logo">
                    <img src="../../images/logo.png" alt="logo">
                </div>

                <div class="menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="../../index.php">
                                    Twits

                                    <div class="selected">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="my-twits.php">
                                    My twits

                                    <div class="selected">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="login-form" style="display: flex; align-items: center;">
                    <?php
                        session_start();

                        if (isset($_SESSION['username'])) {
                            echo '<p style="margin-right: 15px;">' . htmlspecialchars($_SESSION['username']) . '</p>';

                            echo '<div class="logout">';
                            echo '<form action="../auth/logout.php" method="post">';
                            echo '<button type="submit">Logout</button>';
                            echo '</form>';
                            echo '</div>';

                        }
                    ?>
                </div>
            </div>
        </header>

        <div class="main-page">
            <div class="container">
                <main>
                    <h1 class="main-title">- Edit twit -</h1>

                    <div class="edit-twit-form">
                        <form action="update-twit.php" method="post">
                            <input type="hidden" name="twit_id" value="<?= htmlspecialchars($twit_id) ?>">

                            <input type="text" name="title" value="<?= htmlspecialchars($twit['title']) ?>" required> <br/>

                            <textarea name="content" required><?= htmlspecialchars($twit['content']) ?></textarea> <br/>

                            <button type="submit">Save</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Login into your account</p>
            </div>
        </footer>
    </div>
</body>
</html>