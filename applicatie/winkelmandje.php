<?php include 'includes/header.php'; ?>

    <main>
        <h1>Welkom bij het winkelmandje van Pizzeria Sole Machina</h1>

        <form action="#" method="post">
          <section>
            <h2>Winkelmandje</h2>

            <article class="menu-item">
                <h3>Pizza Hawaii</h3>
                <p>€12,95</p>

                <input type="hidden" name="product[]" value="pizza-hawaii">

                <label for="pizza-hawaii-amount">Aantal</label>

                <div class="amount-control">
                <button type="button">−</button>
                <input type="number" id="pizza-hawaii-amount" name="amount[]" min="0" value="1">
                <button type="button">+</button>
                </div>

                <button type="button">Verwijderen</button>
            </article>

            <article class="menu-item">
                <h3>Pizza Margherita</h3>
                <p>€12,95</p>

                <input type="hidden" name="product[]" value="pizza-margherita">

                <label for="pizza-margherita-amount">Aantal</label>

                <div class="amount-control">
                <button type="button">−</button>
                <input type="number" id="pizza-margherita-amount" name="amount[]" min="0" value="2">
                <button type="button">+</button>
                </div>

                <button type="button">Verwijderen</button>
            </article>
            </section>

            <section>
            

            <fieldset>
                <h2>Verzendgegevens</h2>
                
                <input type="radio" id="delivery" name="delivery-method" value="delivery" checked>
                <label for="delivery">Bezorgen</label>

                <input type="radio" id="pickup" name="delivery-method" value="pickup">
                <label for="pickup">Ophalen</label><br>
                
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name">

                <section id="address-fields">
                    <label for="address">Adres:</label>
                    <input type="text" id="address" name="address">

                    <label for="postal-code">Postcode:</label>
                    <input type="text" id="postal-code" name="postal-code">

                    <label for="city">Plaats:</label>
                    <input type="text" id="city" name="city">
                </section>
            </fieldset>
            </section>

            <section class="details">
              <h2>Bestellingsoverzicht</h2>

              <dl>
                  <dt>Subtotaal</dt>
                  <dd>€38,85</dd>

                  <dt>Bezorgkosten</dt>
                  <dd>€3,50</dd>

                  <dt>Totaal</dt>
                  <dd><strong>€42,35</strong></dd>
              </dl>

              <button type="submit">Bestelling plaatsen</button>
          </section>
        </form>
    </main>

    <footer>
      <p>&copy; 2026 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
      <p><a href="privacy-policy.html">Privacy Policy</a></p>
    </footer>
  </body>
</html>