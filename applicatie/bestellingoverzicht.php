<?php 
  require 'includes/header.php'; 
  require_once 'database_connection.php';
?>

    <aside>
        <h2 id="filter-heading">Filters</h2>

        <form>
        <fieldset>
            <legend>Filter op datum</legend>

            <label for="startdatum">Van</label>
            <input type="date" id="startdatum" name="startdatum">

            <label for="einddatum">Tot</label>
            <input type="date" id="einddatum" name="einddatum">
        </fieldset>

        <fieldset>
            <legend>Filter op status</legend>

            <label for="status">Status</label>
            <select id="status" name="status">
            <option value="">Alle statussen</option>
            <option value="nieuw">Nieuw</option>
            <option value="in-behandeling">In behandeling</option>
            <option value="onderweg">Onderweg</option>
            <option value="voltooid">Voltooid</option>
            <option value="geannuleerd">Geannuleerd</option>
            </select>
        </fieldset>

        <button type="submit" class="aside-button">Filters toepassen</button>
        <button type="reset" class="aside-button">Filters wissen</button>
        </form>
  </aside>

    <main>
  <section>
    <h1>Overzicht van bestellingen</h1>

    <article class="order">
        <header>
            <h2>Bestelling #1024</h2>
        </header>

            <dl>
                <dt>Datum</dt>
                <dd>6 juni 2026</dd>

                <dt>Klant</dt>
                <dd>Jan Jansen</dd>

                <dt>adres</dt>
                <dd>Hoofdstraat 123, Druten</dd>

                <dt>Totaal</dt>
                <dd>€24,90</dd>

                <dt>Status</dt>
                <dd>
                    <form action="update-status.php" method="post">
                        <input type="hidden" name="order_id" value="1024">

                        <select class="status-select" name="status">
                            <option value="nieuw" selected>Nieuw</option>
                            <option value="in-behandeling">In behandeling</option>
                            <option value="onderweg">Onderweg</option>
                            <option value="voltooid">Voltooid</option>
                            <option value="geannuleerd">Geannuleerd</option>
                        </select>

                        <button type="submit">Opslaan</button>
                    </form>
                </dd>
            </dl>

        <a href="details.html" class="button">
            Bekijk bestelling
        </a>
    </article>
    <article class="order">
        <header>
            <h2>Bestelling #1024</h2>
        </header>

            <dl>
                <dt>Datum</dt>
                <dd>6 juni 2026</dd>

                <dt>Klant</dt>
                <dd>Jan Jansen</dd>

                <dt>adres</dt>
                <dd>Hoofdstraat 123, Druten</dd>

                <dt>Totaal</dt>
                <dd>€24,90</dd>

                <dt>Status</dt>
                <dd>
                    <form action="update-status.php" method="post">
                        <input type="hidden" name="order_id" value="1024">

                        <select class="status-select" name="status">
                            <option value="nieuw" selected>Nieuw</option>
                            <option value="in-behandeling">In behandeling</option>
                            <option value="onderweg">Onderweg</option>
                            <option value="voltooid">Voltooid</option>
                            <option value="geannuleerd">Geannuleerd</option>
                        </select>

                        <button type="submit">Opslaan</button>
                    </form>
                </dd>
            </dl>

        <a href="details.html" class="button">
            Bekijk bestelling
        </a>
    </article>      
    <article class="order">
        <header>
            <h2>Bestelling #1024</h2>
        </header>

            <dl>
                <dt>Datum</dt>
                <dd>6 juni 2026</dd>

                <dt>Klant</dt>
                <dd>Jan Jansen</dd>

                <dt>adres</dt>
                <dd>Hoofdstraat 123, Druten</dd>

                <dt>Totaal</dt>
                <dd>€24,90</dd>

                <dt>Status</dt>
                <dd>
                    <form action="update-status.php" method="post">
                        <input type="hidden" name="order_id" value="1024">

                        <select class="status-select" name="status">
                            <option value="nieuw" selected>Nieuw</option>
                            <option value="in-behandeling">In behandeling</option>
                            <option value="onderweg">Onderweg</option>
                            <option value="voltooid">Voltooid</option>
                            <option value="geannuleerd">Geannuleerd</option>
                        </select>

                        <button type="submit">Opslaan</button>
                    </form>
                </dd>
            </dl>

        <a href="details.html" class="button">
            Bekijk bestelling
        </a>
    </article>
    <article class="order">
        <header>
            <h2>Bestelling #1024</h2>
        </header>

            <dl>
                <dt>Datum</dt>
                <dd>6 juni 2026</dd>

                <dt>Klant</dt>
                <dd>Jan Jansen</dd>

                <dt>adres</dt>
                <dd>Hoofdstraat 123, Druten</dd>

                <dt>Totaal</dt>
                <dd>€24,90</dd>

                <dt>Status</dt>
                <dd>
                    <form action="update-status.php" method="post">
                        <input type="hidden" name="order_id" value="1024">

                        <select class="status-select" name="status">
                            <option value="nieuw" selected>Nieuw</option>
                            <option value="in-behandeling">In behandeling</option>
                            <option value="onderweg">Onderweg</option>
                            <option value="voltooid">Voltooid</option>
                            <option value="geannuleerd">Geannuleerd</option>
                        </select>

                        <button type="submit">Opslaan</button>
                    </form>
                </dd>
            </dl>

        <a href="details.html" class="button">
            Bekijk bestelling
        </a>
    </article>


  </section>
</main>
<?php require 'includes/footer.php'; ?>