<?php 
  require_once __DIR__ . '/../includes/session.php';
  require_once __DIR__ . '/../includes/database-connection.php';
  require_once __DIR__ . '/../includes/functions.php';

  $db = maakverbinding();

  if (!isset($_GET['id'])) {
      header('Location: index.php');
      exit;
  }

  $orderId = (int) $_GET['id'];

  $orderQuery = "
      SELECT order_id, client_username, client_name, personnel_username, datetime, status, address
      FROM Pizza_Order
      WHERE order_id = ?
  ";

  $orderStmt = $db->prepare($orderQuery);
  $orderStmt->execute([$orderId]);
  $order = $orderStmt->fetch(PDO::FETCH_ASSOC);

  if (!isPersonnel() && $order['client_username'] !== $_SESSION['user']['username']) {
    header('Location: profiel.php');
    exit;
  }

  if (!$order) {
      header('Location: index.php');
      exit;
  }

  $productQuery = "
      SELECT 
          pop.product_name,
          pop.quantity,
          p.price,
          pop.quantity * p.price AS line_total
      FROM Pizza_Order_Product pop
      JOIN Product p ON pop.product_name = p.name
      WHERE pop.order_id = ?
  ";

  $productStmt = $db->prepare($productQuery);
  $productStmt->execute([$orderId]);
  $orderProducts = $productStmt->fetchAll(PDO::FETCH_ASSOC);

  $subtotal = 0;

  foreach ($orderProducts as $product) {
      $subtotal += $product['line_total'];
  }

  $deliveryCosts = $order['address'] === 'Ophalen' ? 0 : 3.50;
  $total = $subtotal + $deliveryCosts;

