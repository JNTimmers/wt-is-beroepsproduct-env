<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../database-connection.php';

$db = maakverbinding();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: winkelmandje.php');
    exit;
}

$basket = $_SESSION['basket'] ?? [];

if (empty($basket)) {
    header('Location: winkelmandje.php');
    exit;
}

$clientUsername = $_SESSION['user']['username'] ?? null;
$clientName = trim($_POST['name'] ?? '');
$deliveryMethod = $_POST['delivery-method'] ?? 'delivery';
$address = trim($_POST['address'] ?? '');

if ($deliveryMethod === 'pickup') {
    $address = 'Ophalen';
}

if ($clientName === '') {
    header('Location: winkelmandje.php');
    exit;
}

try {
    $db->beginTransaction();

    $orderQuery = "
        INSERT INTO Pizza_Order (
            client_username,
            client_name,
            personnel_username,
            datetime,
            status,
            address
        )
        OUTPUT INSERTED.Order_id
        VALUES (?, ?, NULL, GETDATE(), ?, ?)
    ";

    $orderStmt = $db->prepare($orderQuery);
    $orderStmt->execute([
        $clientUsername,
        $clientName,
        '1', // Status 'Nieuw'
        $address
    ]);

    $orderId = $orderStmt->fetchColumn();

    if (!$orderId) {
        throw new Exception('Failed to create order.');
    }

    $orderProductQuery = "
        INSERT INTO Pizza_Order_Product (
            order_id,
            product_name,
            quantity
        )
        VALUES (?, ?, ?)
    ";

    $orderProductStmt = $db->prepare($orderProductQuery);

    foreach ($basket as $productName => $item) {
        $orderProductStmt->execute([
            $orderId,
            $productName,
            $item['amount']
        ]);
    }

    $db->commit();

    unset($_SESSION['basket']);

} catch (Exception $e) {
    $db->rollBack();
    die('Database error: ' . $e->getMessage());
}

