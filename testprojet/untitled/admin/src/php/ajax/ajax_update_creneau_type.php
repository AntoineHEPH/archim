<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/CreneauType.class.php';
require '../classes/CreneauTypeDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$creneau = new CreneauTypeDAO($cnx);

if (isset($_POST['champ'], $_POST['valeur'], $_POST['id'])) {
    $champ = $_POST['champ'];
    $valeur = $_POST['valeur'];
    $id = $_POST['id'];

    $creneau->update_ajax_creneau($champ, $valeur, $id);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}
