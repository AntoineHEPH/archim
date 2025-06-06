<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Tutore.class.php';
require '../classes/TutoreDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$tutore = new TutoreDAO($cnx);
$tab = $tutore->delete_tutore($_GET['id_tutore']);

header('Location: ../../../index_.php?page=gestion_tutores.php');
