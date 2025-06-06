<?php

$etabDAO = new EtablissementDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);
$horaireDAO = new HoraireDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$tutoreDAO = new TutoreDAO($cnx);

$etablissements = $etabDAO->get_all_etablissements();
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));
?>

<div class="container mt-5">
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

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>