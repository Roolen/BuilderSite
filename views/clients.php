<main class="main">
    <h1>Clients</h1>
    <?php foreach ($clients as $client): ?>
        <div class="row">
            <div class="row-cell"> <?= $client['id'] ?> </div>
            <div class="row-cell"> <?= $client['first_name'] ?> </div>
            <div class="row-cell"> <?= $client['middle_name'] ?> </div>
            <div class="row-cell"> <?= $client['last_name'] ?> </div>
            <div class="row-cell"> <?= $client['address'] ?> </div>
            <div class="row-cell"> <?= $client['phone'] ?> </div>
        </div>
    <?php endforeach ?>
</main>