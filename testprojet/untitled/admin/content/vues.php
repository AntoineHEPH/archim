<?php
// Requête sur la vue existante
$query = $db->query("SELECT * FROM vue_tuteur_dispo");

// Vérification et affichage
if ($query && $query->rowCount() > 0) {
    echo '<table border="1" cellpadding="8" cellspacing="0">';
    echo '<thead><tr>';

    // Entêtes de colonnes
    $columns = array_keys($query->fetch(PDO::FETCH_ASSOC));
    foreach ($columns as $col) {
        echo '<th>' . htmlspecialchars($col) . '</th>';
    }
    echo '</tr></thead><tbody>';

    // Remise à zéro du curseur et affichage des lignes
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>Aucune donnée disponible dans la vue "vue_tuteur_dispo".</p>';
}
?>
