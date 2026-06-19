<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/database-connection.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['product'] as $index => $productName) {
            $amount = (int) $_POST['amount'][$index];
            updateBasket($productName, $amount);
        }
    }

    if (isset($_POST['remove'])) {
        removeFromBasket($_POST['remove']);
    }
}

$db = maakverbinding();

$basket = $_SESSION['basket'] ?? [];

$products = [];
$subtotal = 0;
$deliveryCosts = 3.50;

if (!empty($basket)) {
    $productNames = array_keys($basket);

    $placeholders = implode(',', array_fill(0, count($productNames), '?'));

    $productQuery = "SELECT name, price FROM Product WHERE name IN ($placeholders)";
    $productStmt = $db->prepare($productQuery);
    $productStmt->execute($productNames);

    $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);
}

