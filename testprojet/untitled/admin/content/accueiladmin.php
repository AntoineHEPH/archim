<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Bienvenue <?= $_SESSION['admin'] ?> 👋</h2>
        <p class="text-center fs-5 mb-4">Vous êtes connecté à votre espace administrateur Archimaide.</p>

        <div class="row g-3 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=visualiser_horaire.php" class="btn btn-outline-info w-100 py-3">
                    📆 Visualiser l'horaire
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=gestion_tuteurs.php" class="btn btn-outline-primary w-100 py-3">
                    👨‍🏫 Gérer les tuteurs
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=gestion_tutores.php" class="btn btn-outline-primary w-100 py-3">
                    👨‍🎓 Gérer les tutorés
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=gestion_etablissements.php" class="btn btn-outline-secondary w-100 py-3">
                    🏫 Gérer les établissements
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=gestion_creneaux.php" class="btn btn-outline-secondary w-100 py-3">
                    ⏰ Gérer les créneaux
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=creation_horaire.php" class="btn btn-outline-success w-100 py-3">
                    ➕ Créer un horaire
                </a>
            </div>
            <div class="col-md-6 col-lg-4">
                <a href="index_.php?page=disconnect.php" class="btn btn-outline-danger w-100 py-3">
                    🚪 Se déconnecter
                </a>
            </div>
        </div>

        <div class="mt-5 text-center text-muted">
            <small>Plateforme d'administration – Archimaide 2025</small>
        </div>
    </div>
</div>
