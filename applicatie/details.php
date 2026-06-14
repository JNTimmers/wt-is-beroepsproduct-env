<?php 
  require 'includes/header.php'; 
  require_once 'database_connection.php';
?>

    <main>
  <section>
    <h1>Bestelling #1024</h1>

    <h2>Bestelde items</h2>

    <article class="menu-item">
      <h3>Pizza Hawaii</h3>
      <p>Aantal: 1</p>
      <p>Prijs per stuk: €12,95</p>
      <p>Subtotaal: €12,95</p>
    </article>

    <article class="menu-item">
      <h3>Pizza Margherita</h3>
      <p>Aantal: 2</p>
      <p>Prijs per stuk: €12,95</p>
      <p>Subtotaal: €25,90</p>
    </article>

    <section class="details">
      <header>
        <h3>Klantgegevens</h3>
      </header> 
      <dl>
        <dt>Naam</dt>
        <dd>Jan Jansen</dd>

        <dt>Bezorgmethode</dt>
        <dd>Bezorgen</dd>

        <dt>Adres</dt>
        <dd>Pizzastraat 12</dd>

        <dt>Postcode</dt>
        <dd>1234 AB</dd>

        <dt>Plaats</dt>
        <dd>Nijmegen</dd>
      </dl>

    </section>

    <section  class="details">
      <header>
        <h3>Bestellingsoverzicht</h3>
      </header>
      <dl>
        <dt>Subtotaal</dt>
        <dd>€38,85</dd>

        <dt>Bezorgkosten</dt>
        <dd>€3,50</dd>

        <dt>Totaal</dt>
        <dd><strong>€42,35</strong></dd>
      </dl>

    </section>

    <section class="details">
      <header>
        <h3>Status wijzigen</h3>
      </header>

      <form action="update-status.php" method="post">
        <input type="hidden" name="order_id" value="1024">

        <label for="status">Status</label>

        <select id="status" name="status">
          <option value="nieuw" selected>Nieuw</option>
          <option value="in-behandeling">In behandeling</option>
          <option value="onderweg">Onderweg</option>
          <option value="voltooid">Voltooid</option>
          <option value="geannuleerd">Geannuleerd</option>
        </select>

        <button type="submit">Opslaan</button>
      </form>
    </section>

    <a href="bestellingoverzicht.html" class="button">Terug naar overzicht</a>
  </section>
</main>

<?php require 'includes/footer.php'; ?>