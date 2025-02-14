<?php
function getUserSession()
{
    return isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : null;
}

function displayUserName()
{
    $username = getUserSession();

    if ($username) {
        echo '<p>' . $username . '</p>';
    }
}

function displayAuthButtons()
{
    $username = getUserSession();

    if ($username) {
        echo '<div class="logout">';
        echo '<form action="php/auth/logout.php" method="post">';
        echo '<button type="submit">Logout</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<form action="html/auth/login.html"><button>Login</button></form>';
    }
}
?>