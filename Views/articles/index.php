
<h1>Liste des articles</h1>
<div class="articles-container">
<?php foreach($articles as $article): ?>
    <a href="<?= PATH ?>articles/show/<?= $article->id ?>"" class="link-article">
        <div class="card h-100">
        <img src="<?= PATH ?>assets/images/<?= $article->image ?>" class="card-img-top" alt="<?= $article->title ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $article->title ?></h5>
                <p class="card-text"><?= $article->short_description ?></p>
                <span class="date-card"><?= date_format(new DateTime($article->updated_at), 'd/m/Y') ?></span>
            </div>
        </div>
    </a>
<?php endforeach ?>
</div>
