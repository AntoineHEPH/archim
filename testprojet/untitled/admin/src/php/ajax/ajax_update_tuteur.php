<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Tuteur.class.php';
require '../classes/TuteurDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$tuteur = new TuteurDAO($cnx);

if (isset($_POST['champ'], $_POST['valeur'], $_POST['id'])) {
    $champ = $_POST['champ'];
    $valeur = $_POST['valeur'];
    $id = $_POST['id'];

    $tuteur->update_ajax_tuteur($champ, $valeur, $id);
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Données manquantes"]);
}
