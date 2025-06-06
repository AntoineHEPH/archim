<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';

require '../classes/HoraireDAO.class.php';
require '../classes/Horaire.class.php';
require '../classes/Tuteur.class.php';
require '../classes/TuteurDAO.class.php';
require '../classes/Disponibilite.class.php';
require '../classes/DisponibiliteDAO.class.php';
$cnx = Connection::getInstance($dsn, $user, $password);
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));

$horaireDAO = new HoraireDAO($cnx);
$tuteurDAO = new TuteurDAO($cnx);
$dispoDAO = new DisponibiliteDAO($cnx);

$horaires = $horaireDAO->get_all_horaires_by_semaine($semaine);

echo "<h2>Attribution des tuteurs - Semaine $semaine</h2>";

foreach ($horaires as $h) {
    echo "<hr><strong>Créneau #{$h['id_creneau_type']} (Horaire #{$h['id_horaire']})</strong><br>";
    echo "Tutorés attendus : {$h['nb_tutores_attendus']}<br>";

    if ($h['nb_tutores_attendus'] <= 0) {
        echo "⏩ Ignoré (pas de besoin)<br>";
        continue;
    }

    if ($h['id_tuteur']) {
        echo "⏩ Ignoré (déjà attribué)<br>";
        continue;
    }

    $tuteurs_dispos = $dispoDAO->get_tuteurs_disponibles_creneau($h['id_creneau_type'], $semaine);

    if (empty($tuteurs_dispos)) {
        echo "❌ Aucun tuteur dispo pour ce créneau<br>";
        continue;
    }

    echo "✅ Tuteurs disponibles :<ul>";
    foreach ($tuteurs_dispos as $t) {
        echo "<li>{$t['prenom']} {$t['nom']} ({$t['heures_prestees']}h - {$t['nb_dispo_semaine']} dispos)</li>";
    }
    echo "</ul>";

    usort($tuteurs_dispos, function($a, $b) {
        $aScore = $a['nb_dispo_semaine'] * 2 + $a['heures_prestees'];
        $bScore = $b['nb_dispo_semaine'] * 2 + $b['heures_prestees'];
        return $aScore <=> $bScore;
    });

    $meilleur = $tuteurs_dispos[0]['id_tuteur'];
    echo "👉 Attribué à tuteur #$meilleur<br>";

    $horaireDAO->update_tuteur($h['id_horaire'], $meilleur);
}
echo "<br><a href='../../../index_.php?page=horaire.php&semaine=$semaine'>🔁 Retour à l'horaire</a>";
