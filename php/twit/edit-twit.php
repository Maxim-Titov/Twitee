<?php
require '../config/init.php';
require '../auth/auth.php';
require 'edit-twit-handler.php';
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

                <div class="header-login-form" style="display: flex; align-items: center;">
                    <?php 
                        displayUserName();
                        displayAuthButtons();
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
                                displayAuthButtons();
                                displayUserName();
                            ?>
                        </div>

                        <ul>
                            <li>
                                <a class="menu__item" href="../../index.php">Twits</a>
                            </li>

                            <li>
                                <a class="menu__item" href="my-twits.php">My twits</a>
                            </li>
                        </ul>
					</div>
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

                            <button id="edit-twit-submit" type="submit">Save</button>
                        </form>
                    </div>
                </main>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Edit your twit</p>
            </div>
        </footer>
    </div>

    <script type="text/javascript" src="../../dist/edit-twit-res.bundle.js"></script>
</body>
</html>