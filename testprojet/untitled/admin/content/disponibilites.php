<?php
$title = "Disponibilités hebdomadaires";

$dispoDAO = new DisponibiliteDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);

$confirmation = "";
$erreur = "";

if (isset($_GET['submit_disponibilites'])) {
    extract($_GET, EXTR_OVERWRITE);
    $creneaux = $_GET['creneaux'] ?? [];

    // Vérification côté serveur : uniquement un lundi
    if (date('N', strtotime($semaine)) != 1) {
        die("Erreur : la date sélectionnée n'est pas un lundi.");
    }

    // Mise à jour des créneaux
    $dispoDAO->delete_creneaux_dispo($id_dispo);
    foreach ($creneaux as $id_creneau_type) {
        $dispoDAO->add_creneau_dispo($id_dispo, $id_creneau_type);
    }

    $confirmation = "Disponibilités enregistrées ✅";

    // Recharge des données
    $data = $dispoDAO->get_disponibilite_by_tuteur_semaine($id_tuteur, $semaine);
    $id_dispo = $data['id_dispo'];
    $creneaux_selectionnes = $dispoDAO->get_creneaux_selectionnes($id_dispo);

    $tuteur = $tuteurDAO->get_tuteur_by_id($id_tuteur);
    $type_etab = $tuteur['type_etablissement'];
    $creneaux = $creneauDAO->get_creneaux_by_type_etablissement($type_etab);
}

elseif (isset($_GET['id_tuteur'])) {
    $id_tuteur = $_GET['id_tuteur'];
    $semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));

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
} else {
    $erreur = "Aucun tuteur sélectionné.";
}
?>

<?php if ($confirmation): ?>
    <p class="txtVert txtGras"><?= $confirmation ?></p>
<?php elseif ($erreur): ?>
    <p class="txtRouge txtGras"><?= $erreur ?></p>
<?php endif; ?>

<?php if (isset($data) && isset($creneaux) && isset($tuteur)) { ?>

    <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="page" value="disponibilites.php">
        <input type="hidden" name="submit_disponibilites" value="1">
        <input type="hidden" name="id_dispo" value="<?= $data['id_dispo'] ?>">
        <input type="hidden" name="id_tuteur" value="<?= $id_tuteur ?>">

        <div class="container">
            <h4 class="mb-3">
                Disponibilités de <?= $tuteur['prenom']." ".$tuteur['nom'] ?>
            </h4>

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
                <a href="<?= $_SERVER['PHP_SELF'] ?>?page=disponibilites.php&id_tuteur=<?= $id_tuteur ?>&semaine=<?= $semaine_precedente ?>"
                   class="btn btn-outline-secondary">← Semaine précédente</a>

                <a href="<?= $_SERVER['PHP_SELF'] ?>?page=disponibilites.php&id_tuteur=<?= $id_tuteur ?>&semaine=<?= $semaine_suivante ?>"
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
                        <td><?= $creneau['nom'] ?? "Non défini" ?></td>
                        <td>
                            <input type="checkbox" name="creneaux[]"
                                   value="<?= $creneau['id_creneau_type'] ?>"
                                <?= in_array($creneau['id_creneau_type'], $creneaux_selectionnes) ? 'checked' : '' ?>>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <input type="submit" value="Valider" class="btn btn-success">
        </div>
    </form>
<?php } ?>
