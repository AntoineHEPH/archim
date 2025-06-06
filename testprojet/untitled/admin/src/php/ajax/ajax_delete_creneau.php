<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/CreneauType.class.php';
require '../classes/CreneauTypeDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$creneau = new CreneauTypeDAO($cnx);
$tab = $creneau->delete_creneau($_GET['id_creneau_type']);

header('Location: ../../../index_.php?page=gestion_creneaux.php');
