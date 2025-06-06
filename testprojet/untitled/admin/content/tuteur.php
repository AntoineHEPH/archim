<?php
require('src/php/utils/check_connection.php');
$tuteurDAO = new TuteurDAO($cnx);
$liste = $tuteurDAO->get_all_tuteurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Tuteurs</title>
    <script src="./assets/js/filtrer_tuteur.js" defer></script>
</head>
<body>

<h1>Liste des Tuteurs</h1>

<!-- Filtres -->
<button onclick="filtrerTuteurs('Tous')">Tous</button>
<button onclick="filtrerTuteurs('Collège')">Collège</button>
<button onclick="filtrerTuteurs('Lycée')">Lycée</button>
<button onclick="filtrerTuteurs('GE')">GE</button>

<!-- Tableau -->
<table border='1' cellspacing='0' cellpadding='5'>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Type établissement</th>
        <th>Téléphone</th>
        <th>Date naissance</th>
        <th>Lieu naissance</th>
        <th>Pays</th>
        <th>Heures prestées</th>
        <th>Nb annulations</th>
        <th>Nb absences</th>
    </tr>

    <?php if ($liste && is_array($liste)): ?>
        <?php foreach ($liste as $tuteur): ?>
            <tr class="tuteur-row" data-type="<?= htmlspecialchars($tuteur['type_etablissement']) ?>">
                <td><?= htmlspecialchars($tuteur['nom']) ?></td>
                <td><?= htmlspecialchars($tuteur['prenom']) ?></td>
                <td><?= htmlspecialchars($tuteur['type_etablissement']) ?></td>
                <td><?= htmlspecialchars($tuteur['telephone']) ?></td>
                <td><?= htmlspecialchars($tuteur['date_naissance']) ?></td>
                <td><?= htmlspecialchars($tuteur['lieu_naissance']) ?></td>
                <td><?= htmlspecialchars($tuteur['pays']) ?></td>
                <td><?= htmlspecialchars($tuteur['heures_prestees']) ?></td>
                <td><?= htmlspecialchars($tuteur['nb_annulation']) ?></td>
                <td><?= htmlspecialchars($tuteur['nb_absence']) ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="11">Aucun tuteur trouvé ou erreur de chargement.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
