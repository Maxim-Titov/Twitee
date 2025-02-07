<?php
session_start(); 
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

                            <li style="<?php if (!isset($_SESSION['username'])) { echo 'display: none;'; } ?>">
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

                <div class="header-login-form" style="display: flex; align-items: center;">
                    <?php
                        if (isset($_SESSION['username'])) {
                            echo '<p style="margin-right: 15px;">' . htmlspecialchars($_SESSION['username']) . '</p>';

                            echo '<div class="logout">';
                            echo '<form action="php/auth/logout.php" method="post">';
                            echo '<button type="submit">Logout</button>';
                            echo '</form>';
                            echo '</div>';

                        } else {
                            echo '<form action="html/auth/login.html"><button>Login</button></form>';
                        }
                    ?>
                </div>

                <div class="hamburger-menu">
					<input id="menu__toggle" type="checkbox"/>
					<div class="button">
						<label class="menu__btn" for="menu__toggle">
							<span></span>
						</label>
					</div>
					<div class="menu__box">
                        <div class="burger-login-form" style="display: flex; align-items: center;">
                            <?php
                                if (isset($_SESSION['username'])) {
                                    echo '<div class="logout" style="margin-right: 15px;">';
                                    echo '<form action="php/auth/logout.php" method="post">';
                                    echo '<button type="submit">Logout</button>';
                                    echo '</form>';
                                    echo '</div>';

                                    echo '<p>' . htmlspecialchars($_SESSION['username']) . '</p>';

                                } else {
                                    echo '<form action="html/auth/login.html"><button>Login</button></form>';
                                }
                            ?>
                        </div>

                        <ul>
                            <li>
                                <a class="menu__item" href="">Twits</a>
                            </li>

                            <li style="<?php if (!isset($_SESSION['username'])) { echo 'display: none;'; } ?>">
                                <a class="menu__item" href="php/twit/my-twits.php">My twits</a>
                            </li>
                        </ul>
					</div>
				</div>
            </div>
        </header>

        <div class="main-page">
            <div class="container">
                <main>
                    <h1 class="main-title">- Twits -</h1>

                    <?php
                        require 'php/config/db.php';

                        try {
                            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        } catch (PDOException $e) {
                            die("Помилка підключення до бази даних: " . $e->getMessage());
                        }

                        $query = "
                            SELECT 
                                twits.title,
                                twits.content, 
                                twits.created_at,
                                twits.date,
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

                        $twits = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                            echo '<p>' . htmlspecialchars($twit['date']) . '</p>';
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
                <p>Add your own <?php if (!isset($_SESSION['username'])) { echo '<a href="html/auth/login.html">twit</a>'; } else { echo '<a href="php/twit/add-twit.php">twit</a></p>'; } ?>
            </div>
        </footer>
    </div>
</body>
</html>