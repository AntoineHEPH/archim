<?php
require '../db/db_pg_connect.php';
require '../classes/Connection.class.php';
require '../classes/Etablissement.class.php';
require '../classes/EtablissementDAO.class.php';

$cnx = Connection::getInstance($dsn, $user, $password);

$etab = new EtablissementDAO($cnx);
$tab = $etab->delete_etablissement($_GET['id_etablissement']);

header('Location: ../../../index_.php?page=gestion_etablissements.php');
