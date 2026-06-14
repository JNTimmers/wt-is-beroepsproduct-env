<?php 
  require_once 'includes/session.php';
  require_once 'database-connection.php';
  require_once 'includes/functions.php';

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


  require 'includes/header.php';
?>

    <main>
    <section>
        <h1>Bestelling #<?= htmlspecialchars($order['order_id']) ?></h1>

        <h2>Bestelde items</h2>

        <?php foreach ($orderProducts as $product): ?>
            <article class="menu-item">
                <h3><?= htmlspecialchars($product['product_name']) ?></h3>

                <p>Aantal: <?= htmlspecialchars($product['quantity']) ?></p>

                <p>
                    Prijs per stuk:
                    €<?= number_format($product['price'], 2, ',', '.') ?>
                </p>

                <p>
                    Subtotaal:
                    €<?= number_format($product['line_total'], 2, ',', '.') ?>
                </p>
            </article>
        <?php endforeach; ?>

        <section class="details">
            <header>
                <h3>Klantgegevens</h3>
            </header>

            <dl>
                <dt>Naam</dt>
                <dd><?= htmlspecialchars($order['client_name']) ?></dd>

                <dt>Bezorgmethode</dt>
                <dd><?= $order['address'] === 'Ophalen' ? 'Ophalen' : 'Bezorgen' ?></dd>

                <dt>Adres</dt>
                <dd><?= htmlspecialchars($order['address']) ?></dd>
            </dl>
        </section>

        <section class="details">
            <header>
                <h3>Bestellingsoverzicht</h3>
            </header>

            <dl>
                <dt>Subtotaal</dt>
                <dd>€<?= number_format($subtotal, 2, ',', '.') ?></dd>

                <?php if ($deliveryCosts > 0): ?>
                    <dt>Bezorgkosten</dt>
                    <dd>€<?= number_format($deliveryCosts, 2, ',', '.') ?></dd>
                <?php endif; ?>

                <dt>Totaal</dt>
                <dd><strong>€<?= number_format($total, 2, ',', '.') ?></strong></dd>

                <dt>Status</dt>
                <dd><?= htmlspecialchars($order['status']) ?></dd>
            </dl>
        </section>

        <?php if (isPersonnel()): ?>
            <section class="details">
                <header>
                    <h3>Status wijzigen</h3>
                </header>

                <form action="update-status.php" method="post">
                    <input 
                        type="hidden" 
                        name="order_id" 
                        value="<?= htmlspecialchars($order['order_id']) ?>"
                    >

                    <label for="status">Status</label>

                    <select id="status" name="status">
                        <option value="1" <?= $order['status'] == 1 ? 'selected' : '' ?>>Nieuw</option>
                        <option value="2" <?= $order['status'] == 2 ? 'selected' : '' ?>>In behandeling</option>
                        <option value="3" <?= $order['status'] == 3 ? 'selected' : '' ?>>Onderweg</option>
                        <option value="4" <?= $order['status'] == 4 ? 'selected' : '' ?>>Voltooid</option>
                        <option value="5" <?= $order['status'] == 5 ? 'selected' : '' ?>>Geannuleerd</option>
                    </select>

                    <button type="submit">Opslaan</button>
                </form>
            </section>
        <?php endif; ?>
    </section>
</main>

<?php require 'includes/footer.php'; ?>

<?php require 'includes/footer.php'; ?>