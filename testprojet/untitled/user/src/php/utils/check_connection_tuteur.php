<?php
if(!isset($_SESSION['id_tuteur'])) {
    header('location: ../index_.php?page=accueil.php');
}?>