<?php if(!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif ?>

<h1>Connexion</h1>

<?= $form ?>

<a href="/BDDPHP/public/users/register">Pas encore de compte ?</a>
