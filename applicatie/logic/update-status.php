<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/database-connection.php';

if (!isPersonnel()) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../bestellingsoverzicht.php');
    exit;
}

$orderId = (int) ($_POST['order_id'] ?? 0);
$status = $_POST['status'] ?? '';

$allowedStatuses = ['1', '2', '3', '4', '5'];

if ($orderId <= 0 || !in_array($status, $allowedStatuses, true)) {
    header('Location: ../bestellingoverzicht.php');
    exit;
}

$db = maakverbinding();

$query = "
    UPDATE Pizza_Order
    SET 
        status = ?,
        personnel_username = ?
    WHERE order_id = ?
";

$stmt = $db->prepare($query);
$stmt->execute([
    $status,
    $_SESSION['user']['username'],
    $orderId
]);

header('Location: ../bestellingoverzicht.php');
exit;