<div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
        <h4>Liste des demandes de contacts</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <th>Nom/Prénom</th>
                <th>Email</th>
                <th>Message</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact->name ?></td>
                        <td><?= $contact->email ?></td>
                        <td><?= $contact->message ?></td>
                        <td>
                            <a href="<?= PATH ?>admin/deleteContact/<?= $contact->id ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>