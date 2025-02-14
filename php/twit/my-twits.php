<?php
require '../config/init.php';
require '../auth/auth.php';
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
                                <a href="">
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

                <div class="header-add-twit-form" style="display: flex; align-items: center;">
                    <form action="add-twit.php" style="margin-right: 15px;">
                        <button>Add twit</button>
                    </form>

                    <?php displayAuthButtons(); ?>
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

                            <li style="<?php if (!isset($_SESSION['username'])) { echo 'display: none;'; } ?>">
                                <a class="menu__item" href="">My twits</a>
                            </li>
                        </ul>

                        <div class="burger-add-twit-form" style="display: flex; align-items: center;">
                            <form action="add-twit.php">
                                <button>Add twit</button>
                            </form>
                        </div>
					</div>
				</div>
            </div>
        </header>

        <div class="main-page">
            <div class="container">
                <main>
                    <h1 class="main-title">- My twits -</h1>

                    <?php require 'user-twits.php'; ?>
                </main>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Add your own <a href="add-twit.php">twit</a></p>
            </div>
        </footer>
    </div>
</body>
</html>
