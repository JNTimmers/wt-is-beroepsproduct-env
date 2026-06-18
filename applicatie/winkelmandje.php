<?php
require_once __DIR__ . '/logic/winkelmandje-logic.php';

require 'includes/header.php';
?>


<main>
    <h1>Welkom bij het winkelmandje van Pizzeria Sole Machina</h1>

    <form action="winkelmandje.php" method="post">
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
                <?php if (isset($_SESSION['user'])): ?>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']) ?>">
                <?php else: ?>
                    <input type="text" id="name" name="name">
                <?php endif; ?>

                <section id="address-fields">
                    <label for="address">Adres:</label>
                    <?php if (isset($_SESSION['user'])): ?>
                        <input type="text" id="address" name="address" value="<?= htmlspecialchars($_SESSION['user']['address']) ?>">
                    <?php else: ?>
                        <input type="text" id="address" name="address">
                    <?php endif; ?>

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

                <dt class="ShippingCosts">Bezorgkosten</dt>
                <dd class="ShippingCosts">€<?= number_format($deliveryCosts, 2, ',', '.') ?></dd>

                <dt>Totaal</dt>
                <dd><strong>€<?= number_format($total, 2, ',', '.') ?></strong></dd>
            </dl>

            <button type="submit" name="place-order" formaction="place-order.php">Bestelling plaatsen</button>
        </section>
    </form>
</main>

<?php require 'includes/footer.php'; ?>