<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Bienvenue <?= $_SESSION['prenom'] ?> 👋</h2>
        <p class="text-center fs-5 mb-4">Vous êtes connecté à votre espace tuteur Archimaide.</p>

        <div class="row g-3 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=mes_dispos.php" class="btn btn-outline-primary w-100 py-3">
                    📅 Gérer mes disponibilités
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=visualiser_horaire.php" class="btn btn-outline-info w-100 py-3">
                    📆 Horaire
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=my_account.php" class="btn btn-outline-secondary w-100 py-3">
                    👤 Mon compte
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=disconnect.php" class="btn btn-outline-danger w-100 py-3">
                    🚪 Se déconnecter
                </a>
            </div>
        </div>

        <div class="mt-5 text-center text-muted">
            <small>Plateforme de gestion des tuteurs – Archimaide 2025</small>
        </div>
    </div>
</div>
