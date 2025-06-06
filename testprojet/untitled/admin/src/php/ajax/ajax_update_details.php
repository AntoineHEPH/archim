<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Details.class.php';
require '../classes/DetailsDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$etab = new DetailsDAO($cnx);

if (isset($_POST['champ'], $_POST['valeur'], $_POST['id'])) {
    $champ = $_POST['champ'];
    $valeur = $_POST['valeur'];
    $id = $_POST['id'];

    $etab->update_ajax_details($champ, $valeur, $id);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}
