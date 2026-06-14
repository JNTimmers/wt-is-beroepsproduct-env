<?php 
    require 'includes/header.php'; 
    require_once __DIR__ . '/database-connection.php';

    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
         exit;
    }

    $db = maakverbinding();

    $orderQuery = "
    SELECT order_id, datetime, status
    FROM Pizza_Order
    WHERE client_username = ?
    ORDER BY datetime DESC
    ";

    $orderStmt = $db->prepare($orderQuery);
    $orderStmt->execute([$_SESSION['user']['username']]);

    $orders = $orderStmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <main>
    <h1>Mijn profiel</h1>

    <section class="profile-info">
        <form action="update-profiel.php" method="post">
            <fieldset>
                <legend>Persoonlijke gegevens</legend>

                <label for="voornaam">Voornaam</label>
                <input type="text" id="voornaam" name="voornaam" value="<?= htmlspecialchars($_SESSION['user']['first_name']) ?>">

                <label for="achternaam">Achternaam</label>
                <input type="text" id="achternaam" name="achternaam" value="<?= htmlspecialchars($_SESSION['user']['last_name']) ?>">

            </fieldset>

            <fieldset>
                <legend>Adres</legend>

                <Label>Huidig adres:</label>
                <p><?= htmlspecialchars($_SESSION['user']['address']) ?></p>

                <label for="straat">Straat</label>
                <input type="text" id="straat" name="straat">

                <label for="huisnummer">Huisnummer</label>
                <input type="text" id="huisnummer" name="huisnummer">

                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode">

                <label for="plaats">Plaats</label>
                <input type="text" id="plaats" name="plaats">
            </fieldset>

            <button type="submit">Gegevens opslaan</button>
        </form>
    </section>

    <section>
    <h2>Mijn bestellingen</h2>

    <?php if (empty($orders)): ?>
        <p>Je hebt nog geen bestellingen geplaatst.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
            <article class="order">
                <header>
                    <h3>Bestelling #<?= htmlspecialchars($order['order_id']) ?></h3>
                </header>

                <dl>
                    <dt>Datum</dt>
                    <dd><?= htmlspecialchars($order['datetime']) ?></dd>

                    <dt>Status</dt>
                    <dd><?= htmlspecialchars($order['status']) ?></dd>
                </dl>

                <a 
                    href="details.php?id=<?= htmlspecialchars($order['order_id']) ?>" 
                    class="nav-button"
                >
                    Bekijk bestelling
                </a>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
</main>
<?php require 'includes/footer.php'; ?>