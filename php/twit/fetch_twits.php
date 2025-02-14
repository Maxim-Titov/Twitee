<?php
class Twit {
    private $pdo;

    public function __construct(Database $db) {
        $this->pdo = $db->getConnection();
    }

    public function getAllTwits() {
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

        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserTwits() {
        $user_id = $_SESSION['user_id'];

        $query = "
            SELECT 
                twits.twit_id,
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
            WHERE 
                twits.user_id = :user_id
            ORDER BY 
                twits.created_at DESC
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}




// require 'php/config/db.php';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Помилка підключення до бази даних: " . $e->getMessage());
// }

// $query = "
//     SELECT 
//         twits.title,
//         twits.content, 
//         twits.created_at,
//         twits.date,
//         users.username 
//     FROM 
//         twits 
//     INNER JOIN 
//         users 
//     ON 
//         twits.user_id = users.user_id 
//     ORDER BY 
//         twits.created_at DESC
// ";

// $stmt = $pdo->query($query);
// $twits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach ($twits as $twit) {
//     echo '<div class="twit">';
//     echo '<h2 class="twit-title">' . htmlspecialchars($twit['title']) . '</h2>';
//     echo '<p class="twit-content">' . htmlspecialchars($twit['content']) . '</p>';
//     echo '<div class="twit-about">';
//     echo '<div class="user">';
//     echo '<div class="user-logo">';
//     echo '<img src="images/user.png" alt="user-logo">';
//     echo '</div>';
//     echo '<p class="name">' . htmlspecialchars($twit['username']) . '</p>';
//     echo '</div>';
//     echo '<div class="date">';
//     echo '<p>' . htmlspecialchars($twit['date']) . '</p>';
//     echo '</div>';
//     echo '</div>'; // .twit-about
//     echo '</div>'; // .twit
// }
?>
