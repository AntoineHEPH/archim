<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Tutore.class.php';
require '../classes/TutoreDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$tutore = new TutoreDAO($cnx);

if (isset($_POST['champ'], $_POST['valeur'], $_POST['id'])) {
    $champ = $_POST['champ'];
    $valeur = $_POST['valeur'];
    $id = $_POST['id'];

    $tutore->update_ajax_tutore($champ, $valeur, $id);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}
