<?php
$etabDAO = new EtablissementDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);
$tutoreDAO = new TutoreDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$dispoDAO = new DisponibiliteDAO($cnx);
$horaireDAO = new HoraireDAO($cnx);

$etablissements = $etabDAO->get_all_etablissements();
$etablissement_id = $_GET['etab'] ?? null;
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));
?>

<div class="container mt-5">
    <h2 class="mb-4">🗓 Création des horaires par établissement</h2>

    <form method="get" action="">
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="etab" class="form-label">Etablissement :</label>
                <select name="etab" id="etab" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <?php foreach ($etablissements as $etab): ?>
                        <option value="<?= $etab['id_etablissement'] ?>" <?= $etab['id_etablissement'] == $etablissement_id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($etab['nom']) ?> (<?= htmlspecialchars($etab['ville']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="semaine" class="form-label">Semaine (lundi) :</label>
                <input type="date" name="semaine" id="semaine" class="form-control" value="<?= $semaine ?>" required onchange="verifierLundi(this)">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Afficher les créneaux</button>
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

    <?php if ($etablissement_id): ?>
        <form method="post" action="index_.php?page=valider_horaire.php">
        <input type="hidden" name="etab" value="<?= $etablissement_id ?>">
            <input type="hidden" name="semaine" value="<?= $semaine ?>">

            <div class="mt-5">
                <h4>Liste des créneaux</h4>
                <?php
                $creneaux = $creneauDAO->get_creneaux_by_etablissement($etablissement_id);
                $etab = $etabDAO->get_etablissement_by_id($etablissement_id);
                $tutores = $tutoreDAO->get_tutores_by_type_etablissement($etab['type']);



                foreach ($creneaux as $creneau):
                    $id_creneau = $creneau['id_creneau_type'];
                    $horaire_id = $horaireDAO->get_or_create_horaire($id_creneau, $semaine);

                    // tutorés assignés
                    $tutores_affectes = $horaireDAO->get_tutores_by_horaire($horaire_id);
                    // tuteurs dispo cette semaine pour ce créneau
                    $tuteurs_dispo = $dispoDAO->get_tuteurs_disponibles_creneau($id_creneau, $semaine);

                    $tuteur_affecte = $horaireDAO->get_tuteur_by_horaire($horaire_id);
                    ?>
                    <div class="card my-3">
                        <div class="card-header">
                            <?= htmlspecialchars($creneau['jour']) ?> - <?= substr($creneau['heure_debut'], 0, 5) ?> → <?= substr($creneau['heure_fin'], 0, 5) ?>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Tutorés affectés (fixes)</label>
                                <div class="form-check">
                                    <?php foreach ($tutores as $tutore): ?>
                                        <div>
                                            <input type="checkbox" class="form-check-input"
                                                   name="tutores[<?= $horaire_id ?>][]" value="<?= $tutore['id_tutore'] ?>"
                                                <?= in_array($tutore['id_tutore'], $tutores_affectes) ? 'checked' : '' ?>>
                                            <label class="form-check-label"><?= $tutore['prenom'] ?> <?= $tutore['nom'] ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tuteur assigné (variable)</label>
                                <select name="tuteur[<?= $horaire_id ?>]" class="form-select">
                                    <option value="">-- Aucun --</option>
                                    <?php foreach ($tuteurs_dispo as $t): ?>
                                        <option value="<?= $t['id_tuteur'] ?>" <?= $tuteur_affecte == $t['id_tuteur'] ? 'selected' : '' ?>>
                                            <?= $t['prenom'] ?> <?= $t['nom'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-success mt-3">Enregistrer les horaires</button>
        </form>
    <?php endif; ?>
</div>