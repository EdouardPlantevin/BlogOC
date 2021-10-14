<style>
    .img-cover {
        width: 100%;
        height: 500px;
        object-fit: cover;
    }

    .title-article {  
        margin-top: 20px;
        font-size: 40px;
        font-weight: 200;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
    }

    .other-article-detail {
        font-size: 28px;
        font-weight: 200;
        text-align: center;
    }

    .date-card {
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
        font-size: 13px;
        border: 1px solid;
        padding: 4px;
        border-radius: 5px;
        color: black;
    }

    .last-update {
        font-size: 13px;
        font-style: italic;
    }

    .container-form {
        margin: 50px 0;
    }
</style>


<div class="row mt-5">
    <div class="col-lg-9 col-sm-12">
        <img src="<?= PATH ?>assets/images/<?= $article->image ?>" class="img-cover" alt="<?= $article->title ?>" />

        <h1 class="title-article"><?= $article->title ?><span class="last-update">Mise à jour le: <?= date_format(new DateTime($article->updated_at), 'd/m/Y') ?> Auteur : <?= $author->fullname ?></span></h1>

        <p><?= $article->short_description ?></p>

        <p><?= $article->content ?></p>

        <hr>
        <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
            <div class="container-form">
                <?= $form ?>
            </div>
        <?php endif; ?>
        
        <h3>Commentaires</h3>
        
        <?php foreach($comments as $comment): ?>
            <p><?= $comment->content ?></p>
            <p class="last-update">Ecrit par: <?= $comment->author ?></p>
        <?php endforeach ?>
    </div>
    <div class="col-lg-3 col-sm-6">
        <h2 class="other-article-detail">Nos autres articles</h2>
        <?php foreach($articles as $otherArticle): ?>
            <?php if($otherArticle->id != $article->id): ?>
            <a href="<?= PATH ?>articles/show/<?= $otherArticle->id ?>"" class="link-article btn">
                <div class="card">
                <img src="<?= PATH ?>assets/images/<?= $otherArticle->image ?>" class="card-img-top" alt="<?= $otherArticle->title ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->title ?></h5>
                        <p class="card-text"><?= $article->short_description ?></p>
                        <span class="date-card"><?= date_format(new DateTime($otherArticle->updated_at), 'd/m/Y') ?></span>
                    </div>
                </div>
            </a>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
</div>