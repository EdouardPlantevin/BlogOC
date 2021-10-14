<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des articles</h4>
        <a href="<?= PATH ?>admin/addArticle" class="btn btn-primary">Créer un article</a>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>Actif</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td><?= $article->title ?></td>
                        <td>
                            <img src="<?= PATH ?>assets/images/<?= $article->image ?>" class="img-admin" alt="<?= $article->title ?>" />
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" data-id="<?= $article->id ?>" type="checkbox" id="<?= $article->id ?>" <?= $article->active ? 'checked' : '' ?>>
                                <label class="form-check-label" for="<?= $article->id ?>"></label>
                            </div>
                        </td>
                        <td>
                            <a href="<?= PATH ?>admin/editArticle/<?= $article->id ?>" class="btn btn-warning">Modifier</a>
                            <a href="<?= PATH ?>admin/deleteArticle/<?= $article->id ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>