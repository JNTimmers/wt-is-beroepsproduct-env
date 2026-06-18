<?php
    require_once __DIR__ . '/logic/login-logic.php';

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