<?php
$title = "Nouveau tutoré";

if (isset($_GET['submit_tutore'])) {
    extract($_GET, EXTR_OVERWRITE);

    $tutore = new TutoreDAO($cnx);
    $retour = $tutore->add_tutore($nom, $prenom, $date_naissance, $situation_perso, $details, $classe);

    if ($retour != -1) {
        print "<br><span class='txtGras txtVert'>Tutoré ajouté avec succès ✅</span><br>";
    } else {
        print "<br><span class='txtGras txtRouge'>Erreur lors de l'ajout du tutoré ❌</span><br>";
    }
}
?>

<form id="form_ajout_tutore" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="page" value="nouveau_tutore.php">

    <div class="container form_nouveau_tutore" id="nouveau_tutore">
        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
            <div class="col-md-3"><input type="text" name="nom" placeholder="Nom du tutoré" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Prénom</span></div>
            <div class="col-md-3"><input type="text" name="prenom" placeholder="Prénom du tutoré" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Date de naissance</span></div>
            <div class="col-md-3"><input type="date" name="date_naissance" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Situation personnelle</span></div>
            <div class="col-md-3">
                <textarea name="situation_perso" rows="2" cols="40" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Détails importants</span></div>
            <div class="col-md-3">
                <textarea name="details" rows="3" cols="40" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Classe</span></div>
            <div class="col-md-3"><input type="text" name="classe" placeholder="Classe du tutoré" required></div>
        </div>

        <div class="row">
            <div class="col-md-5 offset-2">
                <input type="reset" id="reset_tutore" value="Annuler">
                <input type="submit" id="submit_tutore" name="submit_tutore" value="Ajouter">
            </div>
        </div>
    </div>
</form>
