<?php
if (isset($_POST['login_submit'])) {
    extract($_POST, EXTR_OVERWRITE);
    $tut = new TuteurDAO($cnx);
    $tuteur = $tut->getTuteurLogs($login, $password);

    if ($tuteur) {
        $_SESSION['id_tuteur'] = $tuteur['id_tuteur'];
        $_SESSION['nom'] = $tuteur['nom'];
        $_SESSION['prenom'] = $tuteur['prenom'];
        header('location: user/index_.php?page=accueiluser.php');
    } else {
        $erreur = "Identifiants incorrects.";
    }
}
?>




<!-- Formulaire -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4 text-center" style="min-width: 320px; max-width: 500px;">
        <h2 class="mb-4">Connexion Tuteur 👨‍🏫</h2>

        <?php if (isset($erreur)) : ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>

        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="mb-3">
                <label for="login" class="form-label">Identifiant</label>
                <input type="text" class="form-control" id="login" name="login" required>
                <div class="form-text">Votre login de tuteur est personnel.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="form-text">Il est sécurisé et confidentiel.</div>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="login_submit">Connexion</button>
        </form>
    </div>
</div>
