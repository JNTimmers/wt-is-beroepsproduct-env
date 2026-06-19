<?php 
  require_once __DIR__ . '/includes/session.php';
  require_once __DIR__ . '/includes/database-connection.php';
  require_once __DIR__ . '/includes/functions.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addToBasket(
        $_POST['product'],
        (int)$_POST['amount']
    );
  }


  $db = maakverbinding();

  $productQuery = "SELECT name, price, type_id FROM Product";
  $productStmt = $db->prepare($productQuery);
  $productStmt->execute();
  $products = $productStmt->fetchAll(PDO::FETCH_ASSOC);
  
  $productTypeQuery = "SELECT name FROM ProductType";
  $productTypeStmt = $db->prepare($productTypeQuery);
  $productTypeStmt->execute();
  $productTypes = $productTypeStmt->fetchAll(PDO::FETCH_ASSOC);

  require 'includes/header.php'; 
?>

    <aside>
      <h2>Menu opties</h2>

      <ul>
        <?php foreach ($productTypes as $productType): ?>
          <?php $sectionId = strtolower($productType['name']); ?>

          <li>
            <a href="#<?= htmlspecialchars($sectionId) ?>">
              <?= htmlspecialchars($productType['name']) ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>
    
    <main>
    <h1>Welkom bij Pizzeria Sole Machina</h1>

    <?php foreach ($productTypes as $productType): ?>
        <?php $sectionId = strtolower($productType['name']); ?>

        <section id="<?= htmlspecialchars($sectionId) ?>">
            <h2><?= htmlspecialchars($productType['name']) ?></h2>

            <?php foreach ($products as $product): ?>
                <?php if ($product['type_id'] === $productType['name']): ?>
                    <article class="menu-item">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>€<?= number_format($product['price'], 2, ',', '.') ?></p>

                        <form action="#" method="post" class="amount-control">
                            <input 
                                type="hidden" 
                                name="product" 
                                value="<?= htmlspecialchars($product['name']) ?>"
                            >

                            <label for="<?= htmlspecialchars($product['name']) ?>-amount">
                                Aantal
                            </label>

                            <input 
                                type="number" 
                                id="<?= htmlspecialchars($product['name']) ?>-amount"
                                name="amount" 
                                min="1" 
                                value="1"
                            >

                            <button type="submit">Toevoegen</button>
                        </form>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</main>
    
<?php include 'includes/footer.php'; ?>