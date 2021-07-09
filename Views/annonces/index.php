<h1>Liste des annonces</h1>

<?php foreach($annonces as $annonce): ?>
    <article>
        <h2><a href="/BDDPHP/public/annonces/lire/<?= $annonce->id ?>"><?= $annonce->title ?></a></h2>
        <p><?= $annonce->description ?></p>
    </article>
<?php endforeach ?>