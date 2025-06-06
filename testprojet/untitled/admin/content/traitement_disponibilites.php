<?php

if (!isset($_POST['id_dispo'], $_POST['id_tuteur'], $_POST['semaine'])) {
    die("Paramètres manquants.");
}

$id_dispo = intval($_POST['id_dispo']);
$id_tuteur = intval($_POST['id_tuteur']);
$semaine = $_POST['semaine'];
$creneaux = $_POST['creneaux'] ?? [];

$dispoDAO = new DisponibiliteDAO($cnx);

$dispoDAO->delete_creneaux_dispo($id_dispo);

foreach ($creneaux as $id_creneau_type) {
    $dispoDAO->add_creneau_dispo($id_dispo, intval($id_creneau_type));
}

header("Location: ../../index_.php?page=gestion_tuteur.php");
