<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Tuteur.class.php';
require '../classes/TuteurDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$dao = new TuteurDAO($cnx);

if (!empty($_POST)) {
    $dao->add_tuteur(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['date_naissance'],
        $_POST['lieu_naissance'],
        $_POST['pays'],
        $_POST['heures'],
        $_POST['annulations'],
        $_POST['absences'],
        $_POST['type']
    );
    header('Location: ../../../content/gestion_tuteurs.php');
    exit();
}
