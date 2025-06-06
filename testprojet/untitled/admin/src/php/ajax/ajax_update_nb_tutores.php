<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/HoraireDAO.class.php';
require '../classes/Horaire.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);
$horaireDAO = new HoraireDAO($cnx);

if (isset($_POST['id'], $_POST['delta'])) {
    $id = (int)$_POST['id'];
    $delta = (int)$_POST['delta'];

    $actuel = $horaireDAO->get_nb_tutores($id);
    $nouveau = max(0, $actuel + $delta);

    $horaireDAO->update_nb_tutores($id, $nouveau);

    echo json_encode(["success" => true, "nouveau" => $nouveau]);
} else {
    echo json_encode(["success" => false, "error" => "Paramètres manquants"]);
}
