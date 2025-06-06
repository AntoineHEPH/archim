<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Tuteur.class.php';
require '../classes/TuteurDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$tuteur = new TuteurDAO($cnx);
$tab = $tuteur->delete_tuteur($_GET['id_tuteur']);

header('Location: ../../../index_.php?page=gestion_tuteurs.php');