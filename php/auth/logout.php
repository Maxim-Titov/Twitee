<?php
session_start();
session_unset(); // Очистити всі змінні сесії
session_destroy(); // Знищити сесію

// Перенаправлення на головну сторінку
header("Location: ../../index.php");
exit();
