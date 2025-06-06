<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Etablissement.class.php';
require '../classes/EtablissementDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$etab = new EtablissementDAO($cnx);

if (isset($_POST['champ'], $_POST['valeur'], $_POST['id'])) {
    $champ = $_POST['champ'];
    $valeur = $_POST['valeur'];
    $id = $_POST['id'];

    $etab->update_ajax_etablissement($champ, $valeur, $id);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}
