<?php
require_once __DIR__ . '/logic/place-order-logic.php';


require 'includes/header.php';
?>

<main>
    <h1>Bestelling geplaatst</h1>

    <p>Bedankt voor uw bestelling.</p>

    <dl>
        <dt>Bestelnummer</dt>
        <dd>#<?= htmlspecialchars($orderId) ?></dd>

        <dt>Naam</dt>
        <dd><?= htmlspecialchars($clientName) ?></dd>

        <dt>Aflevermethode</dt>
        <dd><?= $deliveryMethod === 'pickup' ? 'Ophalen' : 'Bezorgen' ?></dd>
    </dl>

    <a href="index.php" class="nav-button">
        Terug naar het menu
    </a>
</main>

<?php require 'includes/footer.php'; ?>