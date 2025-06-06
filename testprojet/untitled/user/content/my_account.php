<?php

$tuteurDAO = new TuteurDAO($cnx);
$tuteur = $tuteurDAO->get_tuteur_by_id($_SESSION['id_tuteur']);

if (!$tuteur) {
    echo "<p class='text-danger'>Erreur : impossible de récupérer les informations du tuteur.</p>";
    exit;
}
?>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="mb-4 text-center">Mon compte 👤</h3>

        <ul class="list-group list-group-flush mb-4">
            <li class="list-group-item"><strong>Prénom :</strong> <?= $tuteur['prenom'] ?></li>
            <li class="list-group-item"><strong>Nom :</strong> <?= $tuteur['nom'] ?></li>
            <li class="list-group-item"><strong>login :</strong> <?= $tuteur['login'] ?></li>
            <li class="list-group-item"><strong>Téléphone :</strong> <?= $tuteur['telephone'] ?></li>
            <li class="list-group-item"><strong>Date de naissance :</strong> <?= $tuteur['date_naissance'] ?></li>
            <li class="list-group-item"><strong>Type d'établissement :</strong> <?= $tuteur['type_etablissement'] ?></li>
            <li class="list-group-item"><strong>Heures prestées :</strong> <?= $tuteur['heures_prestees'] ?></li>
            <li class="list-group-item"><strong>Nombre d'annulation :</strong> <?= $tuteur['nb_annulation'] ?></li>
            <li class="list-group-item"><strong>Nombre d'absence :</strong> <?= $tuteur['nb_absence'] ?></li>
        </ul>

        <div class="d-flex justify-content-between">
            <a href="index_.php?page=mes_dispos.php" class="btn btn-primary">🗓 Gérer mes disponibilités</a>
            <small>En cas d'erreur, contactez un responsable.</small>
            <a href="../content/disconnect.php" class="btn btn-outline-danger">Se déconnecter</a>
        </div>
    </div>
</div>
