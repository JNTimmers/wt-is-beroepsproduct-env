<?php include 'includes/header.php'; ?>

    <main>
      <h1>Login</h1>
      
        <form class="account-form">
            <label for="email">E-mailadres</label>
            <input type="email" id="email" name="email" required>
    
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
    
            <button type="submit">Inloggen</button>
            <!-- vraag docent: Registratielink staat binnen het form voor de opmaak.
            Is het beter om deze buiten het form te plaatsen? -->
            <a href="registreer.html" id="register-button" class="nav-button"> Nog geen account? Registreer hier</a> 
        </form>


      
    </main>
    <footer>
      <p>&copy; 2026 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
      <p><a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
  </body>
</html>