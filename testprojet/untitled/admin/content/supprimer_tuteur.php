<?php
require_once 'classes/TuteurDAO.class.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tuteur = (int) $_GET['id'];
    $dao = new TuteurDAO($cnx);
    $dao->delete_tuteur($id_tuteur);

    // Redirection après suppression
    header("Location: tuteur.php");
    exit();
} else {
    echo "ID invalide ou non fourni.";
}
?>
