<?php
require 'php/config/init.php';
require 'php/auth/auth.php';
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
                            <li style="<?php echo getUserSession() ? '' : 'display: none;'; ?>">
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
                                <a class="menu__item" href="">Twits</a>
                            </li>
                            <li style="<?php echo getUserSession() ? '' : 'display: none;'; ?>">
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
                    <?php require 'php/twit/twits.php'; ?>
                </main>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Add your own 
                <?php 
                    echo getUserSession() 
                        ? '<a href="php/twit/add-twit.php">twit</a>' 
                        : '<a href="html/auth/login.html">twit</a>';
                ?>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
