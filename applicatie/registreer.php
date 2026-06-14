<?php
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/database-connection.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['wachtwoord'];
    $confirmPassword = $_POST['bevestig-wachtwoord'];

    $firstName = trim($_POST['voornaam']);
    $lastName = trim($_POST['achternaam']);

    $address = trim($_POST['straat']) . ' ' .
               trim($_POST['huisnummer']) . ', ' .
               trim($_POST['postcode']) . ' ' .
               trim($_POST['plaats']);

    if ($password !== $confirmPassword) {
        $error = 'De wachtwoorden komen niet overeen.';
    } else {
      $db = maakverbinding();

      $checkQuery = "SELECT username FROM UserAccount WHERE username = ?";
      $checkStmt = $db->prepare($checkQuery);
      $checkStmt->execute([$username]);

      if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
          $error = 'Deze gebruikersnaam bestaat al.';
      } else {
          $passwordHash = password_hash($password, PASSWORD_DEFAULT);

          $query = "INSERT INTO UserAccount
                    (username, password, first_name, last_name, address, role)
                    VALUES (?, ?, ?, ?, ?, ?)";

          $stmt = $db->prepare($query);
          $stmt->execute([
              $username,
              $passwordHash,
              $firstName,
              $lastName,
              $address,
              'Client'
          ]);

          header('Location: login.php');
          exit;
      }
    }
}
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