<?php


$id_tuteur = $_SESSION['id_tuteur'];
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));

$dispoDAO = new DisponibiliteDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);

$confirmation = "";
$erreur = "";

// Création si besoin
$data = $dispoDAO->get_disponibilite_by_tuteur_semaine($id_tuteur, $semaine);
if (is_array($data) && isset($data['id_dispo'])) {
    $id_dispo = $data['id_dispo'];
} else {
    $id_dispo = $dispoDAO->add_disponibilite($id_tuteur, $semaine);
    $data = ['id_dispo' => $id_dispo];
}

$creneaux_selectionnes = $dispoDAO->get_creneaux_selectionnes($id_dispo);

$tuteur = $tuteurDAO->get_tuteur_by_id($id_tuteur);
$type_etab = $tuteur['type_etablissement'];
$creneaux = $creneauDAO->get_creneaux_by_type_etablissement($type_etab);

// Enregistrement
if (isset($_GET['submit_disponibilites'])) {
    $creneaux_post = $_GET['creneaux'] ?? [];

    // Sécurité : vérifier que la date est bien un lundi
    if (date('N', strtotime($semaine)) != 1) {
        die("Erreur : la date sélectionnée n'est pas un lundi.");
    }

    $dispoDAO->delete_creneaux_dispo($id_dispo);
    foreach ($creneaux_post as $id_creneau_type) {
        $dispoDAO->add_creneau_dispo($id_dispo, $id_creneau_type);
    }

    $confirmation = "Disponibilités enregistrées ✅";

    // ❗ Rechargement des données corrigé
    $data = $dispoDAO->get_disponibilite_by_tuteur_semaine($id_tuteur, $semaine);
    $id_dispo = $data['id_dispo'];
    $creneaux_selectionnes = $dispoDAO->get_creneaux_selectionnes($id_dispo);
}
?>


<div class="container py-4">
    <h3 class="mb-3">Mes disponibilités hebdomadaires [<?= $_SESSION['prenom'] ?> <?= $_SESSION['nom'] ?>]</h3>

    <?php if ($confirmation): ?>
        <p class="txtVert txtGras"><?= $confirmation ?></p>
    <?php elseif ($erreur): ?>
        <p class="txtRouge txtGras"><?= $erreur ?></p>
    <?php endif; ?>

    <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="submit_disponibilites" value="1">
        <?php if (isset($data['id_dispo'])): ?>
            <input type="hidden" name="id_dispo" value="<?= $data['id_dispo'] ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="semaine" class="form-label">Semaine (lundi) :</label>
            <input type="date" id="semaine" name="semaine" class="form-control"
                   value="<?= $semaine ?>" required onchange="verifierLundi(this)">
        </div>

        <?php
        $semaine_precedente = date('Y-m-d', strtotime('-7 days', strtotime($semaine)));
        $semaine_suivante = date('Y-m-d', strtotime('+7 days', strtotime($semaine)));
        ?>

        <div class="d-flex justify-content-between my-4">
            <a href="<?= $_SERVER['PHP_SELF'] ?>?semaine=<?= $semaine_precedente ?>"
               class="btn btn-outline-secondary">← Semaine précédente</a>

            <a href="<?= $_SERVER['PHP_SELF'] ?>?semaine=<?= $semaine_suivante ?>"
               class="btn btn-outline-secondary">Semaine suivante →</a>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Jour</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Établissement</th>
                <th>Disponible</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($creneaux as $creneau) { ?>
                <tr>
                    <td><?= $creneau['jour'] ?></td>
                    <td><?= substr($creneau['heure_debut'], 0, 5) ?></td>
                    <td><?= substr($creneau['heure_fin'], 0, 5) ?></td>
                    <td><?= htmlspecialchars($creneau['nom'] ?? "Non défini") ?></td>
                    <td>
                        <input type="checkbox" name="creneaux[]"
                               value="<?= $creneau['id_creneau_type'] ?>"
                            <?= in_array($creneau['id_creneau_type'], $creneaux_selectionnes) ? 'checked' : '' ?>>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Valider</button>
    </form>

    <script>
        function verifierLundi(input) {
            const date = new Date(input.value);
            const jour = date.getUTCDay();
            if (jour !== 1) {
                alert("La date doit être un lundi !");
                input.value = "";
            }
        }
    </script>
</div>
