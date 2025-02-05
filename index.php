<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitee</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:ital,wght@0,100..900;1,100..900&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="container">
                <div class="logo">
                    <img src="images/logo.png" alt="logo">
                </div>

                <div class="menu">
                    <nav>
                        <ul>
                            <li>
                                <a href="">
                                    Twits

                                    <div class="selected">
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </li>

                            <li style="<?php session_start(); if (!isset($_SESSION['username'])) { echo 'display: none;'; } ?>">
                                <a href="php/twit/my-twits.php">
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
                        // Перевірка, чи користувач увійшов у систему
                        if (isset($_SESSION['username'])) {
                            // Якщо користувач увійшов у систему, виводимо ім'я користувача
                            echo '<p style="margin-right: 15px;">' . htmlspecialchars($_SESSION['username']) . '</p>';

                            echo '<div class="logout">';
                            echo '<form action="php/auth/logout.php" method="post">';
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
                    <h1 class="main-title">- Twits -</h1>

                    <div class="filter">
                        <select>
                            <option>All twits</option>
                            <option>By date</option>
                        </select>
                    </div>

                    <?php
                        // Параметри підключення до бази даних
                        $host = 'localhost';
                        $dbname = 'user_database';
                        $username = 'maxim';
                        $password = 'admin';

                        // Підключення до бази даних
                        try {
                            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            die("Помилка підключення до бази даних: " . $e->getMessage());
                        }

                        // Запит для отримання твітів, відсортованих за датою створення (від новіших до старіших)
                        $query = "
                            SELECT 
                                twits.title,
                                twits.content, 
                                twits.created_at, 
                                users.username 
                            FROM 
                                twits 
                            INNER JOIN 
                                users 
                            ON 
                                twits.user_id = users.user_id 
                            ORDER BY 
                                twits.created_at DESC
                        ";
                        $stmt = $pdo->query($query);

                        // Отримання результатів
                        $twits = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Виведення твітів
                        foreach ($twits as $twit) {
                            echo '<div class="twit">';
                            echo '<h2 class="twit-title">' . htmlspecialchars($twit['title']) . '</h2>';
                            echo '<p class="twit-content">' . htmlspecialchars($twit['content']) . '</p>';
                            echo '<div class="twit-about">';
                            echo '<div class="user">';
                            echo '<div class="user-logo">';
                            echo '<img src="images/user.png" alt="user-logo">';
                            echo '</div>';
                            echo '<p class="name">' . htmlspecialchars($twit['username']) . '</p>';
                            echo '</div>';
                            echo '<div class="date">';
                            echo '<p>' . htmlspecialchars($twit['created_at']) . '</p>';
                            echo '</div>';
                            echo '</div>'; // .twit-about
                            echo '</div>'; // .twit
                        }
                    ?>
                </main>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Add your own <a href="php/twit/add-twit.php">twit</a></p>
            </div>
        </footer>
    </div>
</body>
</html>