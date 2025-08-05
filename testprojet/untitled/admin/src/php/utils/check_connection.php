<?php
if(!isset($_SESSION['admin'])) {
    echo
    header('location: ../index_.php?page=accueil.php');
}