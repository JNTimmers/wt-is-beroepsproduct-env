<?php
require_once 'includes/session.php';
require_once 'database_connection.php';
require_once 'includes/functions.php';

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

require 'includes/header.php';
?>


<main>
    <h1>Welkom bij het winkelmandje van Pizzeria Sole Machina</h1>

    <form action="#" method="post">
        <section>
            <h2>Winkelmandje</h2>

            <?php if (empty($products)): ?>
                <p>Je winkelmandje is leeg.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <?php
                        $amount = $basket[$product['name']]['amount'];
                        $lineTotal = $product['price'] * $amount;
                        $subtotal += $lineTotal;

                        $inputId = strtolower(str_replace(' ', '-', $product['name'])) . '-amount';
                    ?>

                    <article class="menu-item">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>

                        <p>
                            €<?= number_format($product['price'], 2, ',', '.') ?>
                        </p>

                        <input 
                            type="hidden" 
                            name="product[]" 
                            value="<?= htmlspecialchars($product['name']) ?>"
                        >

                        <label for="<?= htmlspecialchars($inputId) ?>">Aantal</label>

                        <input 
                            type="number" 
                            id="<?= htmlspecialchars($inputId) ?>" 
                            name="amount[]" 
                            min="0" 
                            value="<?= htmlspecialchars($amount) ?>"
                        >
                        <button type="submit" name="update">Aantallen bijwerken</button>

                        <p>
                            Totaal: €<?= number_format($lineTotal, 2, ',', '.') ?>
                        </p>

                        <button type="submit" name="remove" value="<?= htmlspecialchars($product['name']) ?>">
                            Verwijderen
                        </button>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <section>
            <fieldset>
                <legend>Verzendgegevens</legend>

                <input type="radio" id="delivery" name="delivery-method" value="delivery" checked>
                <label for="delivery">Bezorgen</label>

                <input type="radio" id="pickup" name="delivery-method" value="pickup">
                <label for="pickup">Ophalen</label><br>

                <label for="name">Naam:</label>
                <input type="text" id="name" name="name">

                <section id="address-fields">
                    <label for="address">Adres:</label>
                    <input type="text" id="address" name="address">

                    <label for="postal-code">Postcode:</label>
                    <input type="text" id="postal-code" name="postal-code">

                    <label for="city">Plaats:</label>
                    <input type="text" id="city" name="city">
                </section>
            </fieldset>
        </section>

        <?php
            $total = $subtotal + $deliveryCosts;
        ?>

        <section class="details">
            <h2>Bestellingsoverzicht</h2>

            <dl>
                <dt>Subtotaal</dt>
                <dd>€<?= number_format($subtotal, 2, ',', '.') ?></dd>

                <dt>Bezorgkosten</dt>
                <dd>€<?= number_format($deliveryCosts, 2, ',', '.') ?></dd>

                <dt>Totaal</dt>
                <dd><strong>€<?= number_format($total, 2, ',', '.') ?></strong></dd>
            </dl>

            <button type="submit">Bestelling plaatsen</button>
        </section>
    </form>
</main>

<?php require 'includes/footer.php'; ?>