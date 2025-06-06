<?php
$title = "Nouveau tuteur";

if (isset($_GET['submit_tuteur'])) {
    extract($_GET, EXTR_OVERWRITE);

    $tuteur = new TuteurDAO($cnx);
    $retour = $tuteur->add_tuteur($nom, $prenom, $telephone, $date_naissance, $lieu_naissance, $pays, $heures_prestees, $nb_annulation, $nb_absence, $type_etablissement, $login, $mot_de_passe);

    if ($retour != -1) {
        print "<br><span class='txtGras txtVert'>Tuteur ajouté avec succès ✅</span><br>";
    } else {
        print "<br><span class='txtGras txtRouge'>Erreur lors de l'ajout du tuteur ❌</span><br>";
    }
}
?>

<form id="form_ajout_tuteur" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="page" value="nouveau_tuteur.php">

    <div class="container form_nouveau_tuteur" id="nouveau_tuteur">
        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
            <div class="col-md-3"><input type="text" name="nom" placeholder="Nom du tuteur" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Prénom</span></div>
            <div class="col-md-3"><input type="text" name="prenom" placeholder="Prénom du tuteur" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Téléphone</span></div>
            <div class="col-md-3"><input type="text" name="telephone" placeholder="Ex: 0498..." required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Date de naissance</span></div>
            <div class="col-md-3"><input type="date" name="date_naissance" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Lieu de naissance</span></div>
            <div class="col-md-3"><input type="text" name="lieu_naissance" placeholder="Lieu" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Pays</span></div>
            <div class="col-md-3"><input type="text" name="pays" placeholder="Pays" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Heures prestées</span></div>
            <div class="col-md-3"><input type="number" step="0.01" name="heures_prestees" value="0" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Annulations</span></div>
            <div class="col-md-3"><input type="number" name="nb_annulation" value="0" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Absences</span></div>
            <div class="col-md-3"><input type="number" name="nb_absence" value="0" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Type d’établissement</span></div>
            <div class="col-md-3"><input type="text" name="type_etablissement" placeholder="GE / Collège / Lycée" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Login</span></div>
            <div class="col-md-3"><input type="text" name="login" placeholder="Identifiant" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Mot de passe</span></div>
            <div class="col-md-3"><input type="password" name="mot_de_passe" required></div>
        </div>

        <div class="row">
            <div class="col-md-5 offset-2">
                <input type="reset" id="reset_tuteur" value="Annuler">
                <input type="submit" id="submit_tuteur" name="submit_tuteur" value="Ajouter">
            </div>
        </div>
    </div>
</form>
