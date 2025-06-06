<?php

$horaireDAO = new HoraireDAO($cnx);

$etab_id = $_POST['etab'] ?? null;
$semaine = $_POST['semaine'] ?? null;

if (!$etab_id || !$semaine) {
    die("Erreur : établissement ou semaine manquants.");
}

// Traitement des tuteurs assignés
if (isset($_POST['tuteur'])) {
    foreach ($_POST['tuteur'] as $id_horaire => $id_tuteur) {
        if ($id_tuteur) {
            $horaireDAO->set_tuteur_for_horaire($id_horaire, $id_tuteur);
        } else {
            $horaireDAO->remove_tuteur_from_horaire($id_horaire); // facultatif
        }
    }
}

// Traitement des tutorés assignés
if (isset($_POST['tutores'])) {
    foreach ($_POST['tutores'] as $id_horaire => $ids_tutore) {
        // Réinitialiser les affectations
        $horaireDAO->clear_tutores_for_horaire($id_horaire);

        // Réenregistrer les sélectionnés
        foreach ($ids_tutore as $id_tutore) {
            $horaireDAO->add_tutore_to_horaire($id_horaire, $id_tutore);
        }
    }
}

header("Location: index_.php?page=creation_horaire.php&etab=$etab_id&semaine=$semaine&success=1");
exit;
?>
