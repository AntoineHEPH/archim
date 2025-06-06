<?php
// Traitement si POST pour action tuteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $id_tuteur = $_POST['id_tuteur'] ?? null;
    $id_creneau = $_POST['id_creneau'] ?? null;
    $semaine = $_POST['semaine'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($id_tuteur && $id_creneau && $action && $semaine) {
        $stmt = $cnx->prepare("SELECT heure_debut, heure_fin FROM creneau_type WHERE id_creneau_type = :id");
        $stmt->bindValue(':id', $id_creneau);
        $stmt->execute();
        $creneau = $stmt->fetch();

        $debut = new DateTime($creneau['heure_debut']);
        $fin = new DateTime($creneau['heure_fin']);
        $duree = $debut->diff($fin);
        $heures = $duree->h + $duree->i / 60;

        $stmt = $cnx->prepare("SELECT id_details FROM tuteur WHERE id_tuteur = :id");
        $stmt->bindValue(':id', $id_tuteur);
        $stmt->execute();
        $id_details = $stmt->fetchColumn();

        if ($id_details) {
            switch ($action) {
                case 'valider':
                    $stmt = $cnx->prepare("UPDATE details SET heures_prestees = COALESCE(heures_prestees, 0) + :h WHERE id_details = :id");
                    $stmt->bindValue(':h', $heures);
                    break;
                case 'absent':
                    $stmt = $cnx->prepare("UPDATE details SET nb_absence = COALESCE(nb_absence, 0) + 1 WHERE id_details = :id");
                    break;
                case 'annulation':
                    $stmt = $cnx->prepare("UPDATE details SET nb_annulation = COALESCE(nb_annulation, 0) + 1 WHERE id_details = :id");
                    break;
            }
            $stmt->bindValue(':id', $id_details);
            $stmt->execute();

            header("Location: index_.php?page=creation_horaire.php&semaine=$semaine&success=1");
            exit;
        }
    }
}

$etabDAO = new EtablissementDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);
$horaireDAO = new HoraireDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$tutoreDAO = new TutoreDAO($cnx);

$etablissements = $etabDAO->get_all_etablissements();
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));
?>

<div class="container mt-5 position-relative">
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="position-absolute top-0 end-0 mt-3 me-3">
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                ✅ Mise à jour effectuée avec succès.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
    <h2 class="mb-4">📋 Visualisation globale des horaires de la semaine</h2>

    <form method="get" class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="semaine" class="form-label">Semaine (lundi) :</label>
            <input type="date" name="semaine" id="semaine" class="form-control" value="<?= $semaine ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Afficher la semaine</button>
        </div>
    </form>

    <?php foreach ($etablissements as $etab): ?>
        <h4 class="mt-5">🏫 <?= htmlspecialchars($etab['nom']) ?> (<?= htmlspecialchars($etab['ville']) ?>)</h4>

        <table class="table table-bordered">
            <thead class="table-light">
            <tr>
                <th>Jour</th>
                <th>Heure</th>
                <th>Tuteur assigné</th>
                <th>Tutorés</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $creneaux = $creneauDAO->get_creneaux_by_etablissement($etab['id_etablissement']);
            foreach ($creneaux as $creneau):
                $id_creneau = $creneau['id_creneau_type'];
                $horaire_id = $horaireDAO->get_or_create_horaire($id_creneau, $semaine);

                $tuteur = $horaireDAO->get_tuteur_by_horaire($horaire_id);
                $tutor_es = $horaireDAO->get_tutores_by_horaire($horaire_id);

                $nom_tuteur = $tuteur ? $tuteurDAO->get_tuteur_by_id($tuteur) : null;
                $noms_tutores = [];
                foreach ($tutor_es as $id_tutore) {
                    $eleve = $tutoreDAO->get_tutore_by_id($id_tutore);
                    if ($eleve) {
                        $noms_tutores[] = $eleve['prenom'] . ' ' . $eleve['nom'];
                    }
                }
                ?>
                <tr>
                    <td><?= htmlspecialchars($creneau['jour']) ?></td>
                    <td><?= substr($creneau['heure_debut'], 0, 5) ?> - <?= substr($creneau['heure_fin'], 0, 5) ?></td>
                    <td><?= $nom_tuteur ? htmlspecialchars($nom_tuteur['prenom'] . ' ' . $nom_tuteur['nom']) : '<em>Aucun</em>' ?></td>
                    <td><?= empty($noms_tutores) ? '<em>Aucun</em>' : htmlspecialchars(implode(', ', $noms_tutores)) ?></td>
                    <td class="text-center">
                        <?php if ($nom_tuteur): ?>
                            <form method="post" action="index_.php?page=creation_horaire.php" class="d-flex gap-1">
                                <input type="hidden" name="id_tuteur" value="<?= $tuteur ?>">
                                <input type="hidden" name="id_creneau" value="<?= $id_creneau ?>">
                                <input type="hidden" name="semaine" value="<?= $semaine ?>">
                                <button type="submit" name="action" value="valider" class="btn btn-success btn-sm">Valider</button>
                                <button type="submit" name="action" value="absent" class="btn btn-warning btn-sm">Absent</button>
                                <button type="submit" name="action" value="annulation" class="btn btn-danger btn-sm">Annulation</button>
                            </form>
                        <?php else: ?>
                            <em>—</em>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>
