<?php include 'includes/header.php'; ?>

    <main>
    <h1>Mijn profiel</h1>

    <section class="profile-info">
        <form action="update-profiel.php" method="post">
            <fieldset>
                <legend>Persoonlijke gegevens</legend>

                <label for="naam">Naam</label>
                <input type="text" id="naam" name="naam" value="Jan Jansen">

                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" value="jan@example.com">
            </fieldset>

            <fieldset>
                <legend>Adres</legend>

                <label for="straat">Straat</label>
                <input type="text" id="straat" name="straat" value="Dorpsstraat">

                <label for="huisnummer">Huisnummer</label>
                <input type="text" id="huisnummer" name="huisnummer" value="12A">

                <label for="postcode">Postcode</label>
                <input type="text" id="postcode" name="postcode" value="1234 AB">

                <label for="plaats">Plaats</label>
                <input type="text" id="plaats" name="plaats" value="Druten">
            </fieldset>

            <button type="submit">Gegevens opslaan</button>
        </form>
    </section>

    <section>
        <h2>Mijn bestellingen</h2>

        <article class="order">
            <header>
                <h3>Bestelling #1024</h3>
            </header>

            <dl>
                <dt>Datum</dt>
                <dd>6 juni 2026</dd>

                <dt>Status</dt>
                <dd>Nieuw</dd>

                <dt>Totaal</dt>
                <dd>€24,90</dd>
            </dl>

            <a href="bestelling-detail.php?id=1024" class="nav-button">Bekijk bestelling</a>
        </article>
    </section>
</main>
    <footer>
      <p>&copy; 2026 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
      <p><a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
  </body>
</html>