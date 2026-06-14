<?php
require_once 'includes/session.php';
require_once 'database-connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$firstName = trim($_POST['voornaam']);
$lastName = trim($_POST['achternaam']);

$address =
    trim($_POST['straat']) . ' ' .
    trim($_POST['huisnummer']) . ', ' .
    trim($_POST['postcode']) . ' ' .
    trim($_POST['plaats']);

$db = maakverbinding();

$query = "
    UPDATE [UserAccount]
    SET
        first_name = ?,
        last_name = ?,
        address = ?
    WHERE username = ?
";

$stmt = $db->prepare($query);
$stmt->execute([
    $firstName,
    $lastName,
    $address,
    $_SESSION['user']['username']
]);

$_SESSION['user']['first_name'] = $firstName;
$_SESSION['user']['last_name'] = $lastName;
$_SESSION['user']['address'] = $address;

header('Location: profiel.php');
exit;