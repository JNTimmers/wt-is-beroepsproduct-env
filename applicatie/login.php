<?php
require_once __DIR__ . '/includes/session.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/database-connection.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['wachtwoord'];

    $db = maakverbinding();

    $query = "SELECT username, password, first_name, last_name, address, role
              FROM UserAccount
              WHERE username = ?";

    $stmt = $db->prepare($query);
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = [
        'username' => $user['username'],
        'first_name' => $user['first_name'],
        'last_name' => $user['last_name'],
        'address' => $user['address'],
        'role' => $user['role']
    ];

    header('Location: index.php');
    exit;

    } else {
        $error = 'Ongeldige gebruikersnaam of wachtwoord.';
    }
}

require __DIR__ . '/includes/header.php';
?>

<main>
    <h1>Login</h1>

    <?php if ($error !== null): ?>
        <p class="error-message"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form class="account-form" method="post">
        <label for="username">Gebruikersnaam</label>
        <input type="text" id="username" name="username" required>

        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required>

        <button type="submit">Inloggen</button>

        <a href="registreer.php" id="register-button" class="nav-button">
            Nog geen account? Registreer hier
        </a>
    </form>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>