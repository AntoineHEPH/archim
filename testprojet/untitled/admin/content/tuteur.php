<?php

$tuteur = new TuteurDAO($cnx);
$liste = $tuteur->getTuteur();

if (is_null($liste)) {
    print "<br> Pas de données";
} else {
    print "<table border='1' cellspacing='0' cellpadding='5'>";
    print "<tr><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Date naissance</th><th>Lieu naissance</th><th>Pays</th><th>Heures prestées</th><th>Nb annulation</th><th>Nb absence</th></tr>";

    foreach ($liste as $tuteur) {
        print "<tr>";
        print "<td>" . $tuteur->nom . "</td>";
        print "<td>" . $tuteur->prenom . "</td>";
        print "<td>" . $tuteur->type_etablissement . "</td>";
        print "<td>" . $tuteur->telephone . "</td>";
        print "<td>" . $tuteur->date_naissance . "</td>";
        print "<td>" . $tuteur->lieu_naissance . "</td>";
        print "<td>" . $tuteur->pays . "</td>";
        print "<td>" . $tuteur->nb_heures_prestees . "</td>";
        print "<td>" . $tuteur->nb_annulation . "</td>";
        print "<td>" . $tuteur->nb_absence . "</td>";
        print "</tr>";
    }

    print "</table>";
}
