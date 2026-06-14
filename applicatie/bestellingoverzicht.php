<?php 
    require_once 'includes/session.php';
    require_once 'database-connection.php';
    require_once 'includes/functions.php';

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

    require 'includes/header.php';
?>

    <aside>
        <h2 id="filter-heading">Filters</h2>

        <form>
        <fieldset>
            <legend>Filter op datum</legend>

            <label for="startdatum">Van</label>
            <input type="date" id="startdatum" name="startdatum">

            <label for="einddatum">Tot</label>
            <input type="date" id="einddatum" name="einddatum">
        </fieldset>

        <fieldset>
            <legend>Filter op status</legend>

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Open" <?= $status === 'Open' ? 'selected' : '' ?>>Open bestellingen</option>
                <option value="All" <?= $status === 'All' ? 'selected' : '' ?>>Alle statussen</option>
                <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Nieuw</option>
                <option value="2" <?= $status === '2' ? 'selected' : '' ?>>In behandeling</option>
                <option value="3" <?= $status === '3' ? 'selected' : '' ?>>Onderweg</option>
                <option value="4" <?= $status === '4' ? 'selected' : '' ?>>Voltooid</option>
                <option value="5" <?= $status === '5' ? 'selected' : '' ?>>Geannuleerd</option>
            </select>
        </fieldset>

        <button type="submit" class="aside-button">Filters toepassen</button>
        <a href="bestellingoverzicht.php" class="aside-button">Filters wissen</a>
        </form>
  </aside>

    <main>
  <section>
    <h1>Overzicht van bestellingen</h1>

    <?php if (empty($orders)): ?>
    <p>Er zijn geen bestellingen gevonden.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <article class="order">
                <header>
                    <h2>Bestelling #<?= htmlspecialchars($order['order_id']) ?></h2>
                </header>

                <dl>
                    <dt>Datum</dt>
                    <dd><?= htmlspecialchars($order['datetime']) ?></dd>

                    <dt>Klant</dt>
                    <dd><?= htmlspecialchars($order['client_name']) ?></dd>

                    <dt>Adres</dt>
                    <dd><?= htmlspecialchars($order['address']) ?></dd>

                    <dt>Totaal</dt>
                    <dd>€<?= number_format($order['total'], 2, ',', '.') ?></dd>

                    <dt>Status</dt>
                    <dd>
                        <form action="update-status.php" method="post">
                            <input 
                                type="hidden" 
                                name="order_id" 
                                value="<?= htmlspecialchars($order['order_id']) ?>"
                            >

                            <select class="status-select" name="status">
                                <option value="1" <?= $order['status'] == 1 ? 'selected' : '' ?>>Nieuw</option>
                                <option value="2" <?= $order['status'] == 2 ? 'selected' : '' ?>>In behandeling</option>
                                <option value="3" <?= $order['status'] == 3 ? 'selected' : '' ?>>Onderweg</option>
                                <option value="4" <?= $order['status'] == 4 ? 'selected' : '' ?>>Voltooid</option>
                                <option value="5" <?= $order['status'] == 5 ? 'selected' : '' ?>>Geannuleerd</option>
                            </select>

                            <button type="submit">Opslaan</button>
                        </form>
                    </dd>
                </dl>

                <a href="details.php?id=<?= htmlspecialchars($order['order_id']) ?>">Bekijk bestelling</a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>


  </section>
</main>
<?php require 'includes/footer.php'; ?>