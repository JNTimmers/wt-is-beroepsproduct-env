<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/database-connection.php';

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