<?php
$title = "Modifier un tuteur";

$tuteurDAO = new TuteurDAO($cnx);
$detailsDAO = new DetailsDAO($cnx);

// Si modification
if (isset($_GET['submit_modifier'])) {
    extract($_GET, EXTR_OVERWRITE);
    $retour = $tuteurDAO->update_tuteur_complet(
        $id_tuteur, $nom, $prenom, $telephone, $date_naissance,
        $lieu_naissance, $pays, $heures_prestees, $nb_annulation, $nb_absence, $type_etablissement
    );

    if ($retour != -1) {
        echo "<p class='txtGras txtVert'>Tuteur modifié avec succès ✅</p>";
    } else {
        echo "<p class='txtGras txtRouge'>Erreur lors de la modification ❌</p>";
    }

    $data = $tuteurDAO->get_tuteur_and_details_by_id($id_tuteur);
}

?>

<?php if (isset($data)) { ?>
    <form method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="page" value="modifier_tuteur.php">
        <input type="hidden" name="id_tuteur" value="<?= $data['id_tuteur']; ?>">
        <input type="hidden" name="id_details" value="<?= $data['id_details']; ?>">

        <div class="container">
            <h2 class="txtGras">Informations du tuteur</h2>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
                <div class="col-md-3"><input type="text" name="nom" value="<?= $data['nom']; ?>" required></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Prénom</span></div>
                <div class="col-md-3"><input type="text" name="prenom" value="<?= $data['prenom']; ?>" required></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Téléphone</span></div>
                <div class="col-md-3"><input type="text" name="telephone" value="<?= $data['telephone']; ?>"></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Date de naissance</span></div>
                <div class="col-md-3"><input type="date" name="date_naissance" value="<?= $data['date_naissance']; ?>"></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Lieu de naissance</span></div>
                <div class="col-md-3"><input type="text" name="lieu_naissance" value="<?= $data['lieu_naissance']; ?>"></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Pays</span></div>
                <div class="col-md-3"><input type="text" name="pays" value="<?= $data['pays']; ?>"></div>
            </div>

            <h2 class="txtGras mt-4">Détails associés</h2>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Heures prestées</span></div>
                <div class="col-md-3"><input type="number" name="heures_prestees" value="<?= $data['heures_prestees']; ?>" required></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Annulations</span></div>
                <div class="col-md-3"><input type="number" name="nb_annulation" value="<?= $data['nb_annulation']; ?>" required></div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Absences</span></div>
                <div class="col-md-3"><input type="number" name="nb_absence" value="<?= $data['nb_absence']; ?>" required></div>
            </div>

            <div class="row mt-3">
                <div class="col-md-5 offset-2">
                    <input type="reset" value="Annuler">
                    <input type="submit" name="submit_modifier" value="Valider">
                </div>
            </div>
        </div>
    </form>
<?php } else {
    echo "<p class='txtRouge txtGras'>Aucun ID de tuteur fourni.</p>";
} ?>
