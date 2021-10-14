<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des commentaires</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Auteur</th>
                <th>Contenu</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($comments as $comment): ?>
                    <tr>
                        <td><?= $comment->id ?></td>
                        <td><?= $comment->author ?></td>
                        <td><?= $comment->content ?></td>
                        <td>
                            <a href="<?= PATH ?>admin/activeComment/<?= $comment->id ?>" class="btn btn-primary w-100 mb-1">Approuvé</a>
                            <a href="<?= PATH ?>admin/deleteComment/<?= $comment->id ?>" class="btn btn-danger w-100">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>