<?php
session_start();
//traitement toujours au-dessus
if(isset($_POST['login_submit'])){
    extract($_POST, EXTR_OVERWRITE);
    $adm = new AdminDAO($cnx);
    $nom_admin = $adm->getAdmin($login, $password);
    if($nom_admin) {
        $_SESSION['admin'] = $nom_admin;
        header('location: admin/index_.php?page=accueiladmin.php');
    } else {
        $erreur = "Identifiants incorrects.";
    }

}

?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 text-center" style="min-width: 320px; max-width: 500px;">
        <h2 class="mb-4">Connexion Admin 🔐</h2>

        <?php if (isset($erreur)) : ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>

        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" required>
                <div class="form-text">Votre identité est bien gardée.</div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text">Il est sécurisé et confidentiel.</div>
            </div>
            <div class="mb-2">
            <button type="submit" class="btn btn-primary w-100" name="login_submit">Connexion</button>
            </div>
            <a href="index_.php?page=accueil.php" class="btn btn-danger w-100">
                Retour
            </a>
        </form>
    </div>
</div>
