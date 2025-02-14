<?php
require_once '../config/db.php';
require_once 'fetch_twits.php';

$db = new Database();
$twitObj = new Twit($db);
$twits = $twitObj->getUserTwits();

foreach ($twits as $twit) {
    echo '<div class="twit">';
    echo '<h2 class="twit-title">' . htmlspecialchars($twit['title']) . '</h2>';
    echo '<p class="twit-content">' . htmlspecialchars($twit['content']) . '</p>';
    echo '<div class="twit-about">';
    echo '<div class="user">';
    echo '<div class="user-logo">';
    echo '<img src="../../images/user.png" alt="user-logo">';
    echo '</div>';
    echo '<p class="name">' . htmlspecialchars($twit['username']) . '</p>';
    echo '</div>';
    echo '<div class="date">';
    echo '<p>' . htmlspecialchars($twit['date']) . '</p>';
    echo '</div>';
    echo '</div>'; // .twit-about

    echo '<div class="twit-actions">';
    echo '<a href="edit-twit.php?twit_id=' . $twit['twit_id'] . '" class="edit-button">Edit</a>';
    echo '</div>'; // .twit-actions

    echo '</div>'; // .twit
}
?>