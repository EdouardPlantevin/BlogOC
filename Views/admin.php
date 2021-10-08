<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titre</title>
    <script src="https://kit.fontawesome.com/27a02ce989.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/BDDPHP/public/assets/styles/back/back.css">

</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= PATH ?>">Accueil du site</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= PATH ?>admin">Accueil de l'admin</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= PATH ?>users/profile">Profil</a>
                        </li>
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
    </nav> -->

    <div class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
          <span class="fs-4">Administration</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li>
            <a href="<?= PATH ?>admin" class="nav-link text-white">
              Dashboard
            </a>
          </li>
          <li>
            <a href="<?= PATH ?>admin/liste-des-articles" class="nav-link text-white">
              Articles
            </a>
          </li>
          <li>
            <a href="<?= PATH ?>admin/liste-des-contacts" class="nav-link text-white">
              Demandes de contacts
            </a>
          </li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Paramètre</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="<?= PATH ?>">Accueil du site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= PATH ?>users/logout">Déconnexion</a></li>
          </ul>
        </div>
      </div>
    
        <div class="container">
            <?php if(!empty($_SESSION['message'])): ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
            <?php endif ?>
            <?php if(!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif ?>
    
            <?= $body ?>
        </div>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="<?= PATH ?>assets/js/scripts.js"></script>
</body>
</html>