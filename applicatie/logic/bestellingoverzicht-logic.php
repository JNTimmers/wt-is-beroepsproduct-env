<?php 
    require_once __DIR__ . '/../includes/session.php';
    require_once __DIR__ . '/../includes/database-connection.php';
    require_once __DIR__ . '/../includes/functions.php';

    if (!isPersonnel()) {
        header('Location: index.php');
        exit;
    }

    $db = maakverbinding();

    $startDate = $_GET['startdatum'] ?? '';
    $endDate = $_GET['einddatum'] ?? '';
    $status = $_GET['status'] ?? 'Open';

    $query = "
        SELECT 
            po.order_id,
            po.client_name,
            po.address,
            po.datetime,
            po.status,
            SUM(pop.quantity * p.price) AS total
        FROM Pizza_Order po
        JOIN Pizza_Order_Product pop ON po.order_id = pop.order_id
        JOIN Product p ON pop.product_name = p.name
        WHERE 1 = 1
    ";

    $params = [];

    if ($startDate !== '') {
        $query .= " AND CAST(po.datetime AS date) >= ?";
        $params[] = $startDate;
    }

    if ($endDate !== '') {
        $query .= " AND CAST(po.datetime AS date) <= ?";
        $params[] = $endDate;
    }

    if ($status === 'Open') {
        $query .= " AND po.status IN (1, 2, 3)";
    }
    elseif ($status !== 'All') {
        $query .= " AND po.status = ?";
        $params[] = $status;
    }

    $query .= "
        GROUP BY po.order_id, po.client_name, po.address, po.datetime, po.status
        ORDER BY po.datetime DESC
    ";

    $stmt = $db->prepare($query);
    $stmt->execute($params);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
