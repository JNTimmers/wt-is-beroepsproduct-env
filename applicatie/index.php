<?php include 'includes/header.php'; ?>

    <aside>
      <h2>Menu opties</h2>

      <ul>
        <li><a href="#pizza">Pizza's</a></li>
        <li><a href="#pasta">Pasta's</a></li>
        <li><a href="#dranken">Dranken</a></li>
        <li><a href="#desserts">Desserts</a></li>
      </ul>
    </aside>
    
    <main>
      <h1>Welkom bij Pizzeria Sole Machina</h1>

      <section id="pizza">
        <h2>Pizza's</h2>

        <article class="menu-item">
          <h3>Pizza Hawaii</h3>
          <p>€12,95</p>

          <form action="#" method="post" class="amount-control">
            <input type="hidden" name="product" value="pizza-hawaii">

            <label for="pizza-hawaii-amount">Aantal</label>

            <button type="button">−</button>
            <input type="number" id="pizza-hawaii-amount" name="amount" min="0" value="0">
            <button type="button">+</button>

            <button type="submit">Toevoegen</button>
          </form>
        </article>

        <article class="menu-item">
          <h3>Pizza Margherita</h3>
          <p>€12,95</p>

          <form action="#" method="post" class="amount-control">
            <input type="hidden" name="product" value="pizza-margherita">

            <label for="pizza-margherita-amount">Aantal</label>

            <button type="button">−</button>
            <input type="number" id="pizza-margherita-amount" name="amount" min="0" value="0">
            <button type="button">+</button>

            <button type="submit">Toevoegen</button>
          </form>
        </article>
      </section>

      <section id="pasta">
        <h2>Pasta's</h2>

        <article class="menu-item">
          <h3>Pasta Carbonara</h3>
          <p>€12,95</p>

          <form action="#" method="post" class="amount-control">
            <input type="hidden" name="product" value="pasta-carbonara">

            <label for="pasta-carbonara-amount">Aantal</label>

            <button type="button">−</button>
            <input type="number" id="pasta-carbonara-amount" name="amount" min="0" value="0">
            <button type="button">+</button>

            <button type="submit">Toevoegen</button>
          </form>
        </article>
      </section>

      <section id="dranken">
        <h2>Dranken</h2>

        <article class="menu-item">
          <h3>Coca-Cola</h3>
          <p>€2,50</p>

          <form action="#" method="post" class="amount-control">
            <input type="hidden" name="product" value="coca-cola">

            <label for="coca-cola-amount">Aantal</label>

            <button type="button">−</button>
            <input type="number" id="coca-cola-amount" name="amount" min="0" value="0">
            <button type="button">+</button>

            <button type="submit">Toevoegen</button>
          </form>
        </article>
      </section>

      <section id="desserts">
        <h2>Desserts</h2>
      </section>
    </main>
    
<?php include 'includes/footer.php'; ?>