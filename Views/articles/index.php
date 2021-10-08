<link rel="stylesheet" href="../../BDDPHP/public/assets/styles/front/articles.css">

<div class="container">
    <h1>Liste des annonces</h1>
    <div class="articles-container">
        <?php foreach($articles as $article): ?>
            <a href="<?= PATH ?>articles/show/<?= $article->id ?>"" class="link-article">
                <div class="card">
                    <img src="https://kinsta.com/wp-content/uploads/2018/05/what-is-php-3-1.png" class="card-img-top" alt="">
                    <div class="card-body">
                        <p class="card-text"><?= $article->content ?></p>
                        <span class="date-card"><?= date_format(new DateTime($article->created_at), 'd/m/Y') ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</div>
