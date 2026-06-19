<?php
require_once __DIR__ . '/logic/registreer-logic.php';

require __DIR__ . '/includes/header.php';
?>

    <main>
      <?php if ($error !== null): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
      <h1>Welkom bij de Pizzeria Sole Machina registreer</h1>
      
        <form class="account-form" method="post">
            <label for="username">Gebruikersnaam</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
    
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>

            <label for="bevestig-wachtwoord">Bevestig wachtwoord</label>
            <input type="password" id="bevestig-wachtwoord" name="bevestig-wachtwoord" required>

            <label for="voornaam">Voornaam</label>
            <input type="text" id="voornaam" name="voornaam" value="<?= htmlspecialchars($_POST['voornaam'] ?? '') ?>" required>

            <label for="achternaam">Achternaam</label>
            <input type="text" id="achternaam" name="achternaam" value="<?= htmlspecialchars($_POST['achternaam'] ?? '') ?>" required>

            <label for="straat">Straat</label>
            <input type="text" id="straat" name="straat" value="<?= htmlspecialchars($_POST['straat'] ?? '') ?>" required>

            <label for="huisnummer">Huisnummer</label>
            <input type="text" id="huisnummer" name="huisnummer" value="<?= htmlspecialchars($_POST['huisnummer'] ?? '') ?>" required>

            <label for="postcode">Postcode</label>
            <input type="text" id="postcode" name="postcode" value="<?= htmlspecialchars($_POST['postcode'] ?? '') ?>" required>

            <label for="plaats">Plaats</label>
            <input type="text" id="plaats" name="plaats" value="<?= htmlspecialchars($_POST['plaats'] ?? '') ?>" required>  
    
            <button type="submit">Registreer</button>
        </form>

    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>