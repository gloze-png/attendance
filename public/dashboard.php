<?php
session_start();
require '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// If admin, fetch all records; if employee, fetch their records
$userId = $_SESSION['user_id'];
$role = $_SESSION['role'];

if ($role === 'admin') {
    $stmt = $pdo->query("SELECT * FROM attendance");
} else {
    $stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
}

$attendanceRecords = $stmt->fetchAll();
?>

<!-- HTML to display records and a form for employees to mark attendance -->
<table>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Date</th>
        <th>Check In</th>
        <th>Check Out</th>
    </tr>
    <?php foreach ($attendanceRecords as $record): ?>
    <tr>
        <td><?= $record['id']; ?></td>
        <td><?= $record['user_id']; ?></td>
        <td><?= $record['date']; ?></td>
        <td><?= $record['check_in']; ?></td>
        <td><?= $record['check_out']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if ($role === 'employee'): ?>
    <form method="POST" action="attendance.php">
        <button type="submit" name="check_in">Check In</button>
        <button type="submit" name="check_out">Check Out</button>
    </form>
<?php endif; ?>
