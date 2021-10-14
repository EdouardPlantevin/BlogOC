<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titre</title>

    <script src="https://kit.fontawesome.com/27a02ce989.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/styles/app.css" type="text/css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= PATH ?>">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PATH ?>liste-des-articles">Liste des articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= PATH ?>contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <a href="https://github.com/EdouardPlantevin/" target="_blank" class="d-flex align-items-center btn btn-dark">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/edouard-plantevin/" target="_blank" class="d-flex align-items-center mr-2 btn btn-dark">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
                        <?php if(isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])): ?>
                            <li class="nav-item">
                                <a href="<?= PATH ?>admin" class="nav-link">Admin</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= PATH ?>users/logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= PATH ?>users/login">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
        <?php endif ?>
        <?php if(!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif ?>

        <?= $body ?>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>