<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$date = date('Y-m-d');

if (isset($_POST['check_in'])) {
    $stmt = $pdo->prepare("INSERT INTO attendance (user_id, check_in, date) VALUES (:user_id, NOW(), :date)");
    $stmt->execute(['user_id' => $userId, 'date' => $date]);
    header("Location: dashboard.php");
}

if (isset($_POST['check_out'])) {
    $stmt = $pdo->prepare("UPDATE attendance SET check_out = NOW() WHERE user_id = :user_id AND date = :date");
    $stmt->execute(['user_id' => $userId, 'date' => $date]);
    header("Location: dashboard.php");
}
?>
