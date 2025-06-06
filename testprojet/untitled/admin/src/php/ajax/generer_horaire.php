<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';

require '../classes/CreneauTypeDAO.class.php';
require '../classes/CreneauType.class.php';
require '../classes/HoraireDAO.class.php';
require '../classes/Horaire.class.php';
require '../classes/Etablissement.class.php';
require '../classes/EtablissementDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$semaine = $_GET['semaine'] ?? date('Y-m-d', strtotime('monday this week'));

$etabDAO = new EtablissementDAO($cnx);
$creneauDAO = new CreneauTypeDAO($cnx);
$horaireDAO = new HoraireDAO($cnx);

$etabs = $etabDAO->get_all_etablissements();

foreach ($etabs as $etab) {
    $creneaux = $creneauDAO->get_creneaux_by_etablissement($etab['id_etablissement']);

    foreach ($creneaux as $creneau) {
        $existe = $horaireDAO->get_horaire($semaine, $creneau['id_creneau_type']);
        if (!$existe) {
            // Crée un horaire sans tuteur et avec 0 tutorés
            $horaireDAO->insert_horaire($semaine, $creneau['id_creneau_type'], 0, null);
        }
    }
}

header("Location: ../../../index_.php?page=horaire.php&semaine=$semaine");
exit;
