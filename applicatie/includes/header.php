<?php
 Require_once __DIR__ . '/session.php';
 ?>

<!DOCTYPE html>
<html lang="nl">

  <head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <meta charset="utf-8">
    <title>Pizzeria Sole Machina</title>
  </head>
  <body class="menu">
    <header>
      <nav>
        <a href="index.php">
          <img src="images/pizza-48x48.png" alt="Pizza Logo" class="logo">
        </a>

        <ul class="nav-links">
          <li><a href="index.php">Menu</a></li>
          <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Client'): ?>
          <li><a href="profiel.php">Profiel</a></li>
          <?php endif; ?>
          <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Personnel'): ?>
            <li><a href="bestellingoverzicht.php">Bestellingen</a></li>
          <?php endif; ?>
        </ul>

        <div class="nav-actions">
          <a href="winkelmandje.php" class="nav-button">Winkelmandje</a>
          <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php" class="nav-button">Logout</a>
          <?php else: ?>
            <a href="login.php" class="nav-button">Login</a>
          <?php endif; ?>
        </div>
      
      </nav>
    </header>