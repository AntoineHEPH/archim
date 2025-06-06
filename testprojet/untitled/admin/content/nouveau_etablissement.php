<?php
$title = "Nouvel établissement";

if (isset($_GET['submit_etablissement'])) {
    extract($_GET, EXTR_OVERWRITE);

    $etab = new EtablissementDAO($cnx);
    $retour = $etab->add_etablissement($nom, $type, $numero, $rue, $ville);

    if ($retour != -1) {
        echo "<br><span class='txtGras txtVert'>Établissement ajouté avec succès ✅</span><br>";
    } else {
        echo "<br><span class='txtGras txtRouge'>Erreur lors de l'ajout ❌</span><br>";
    }
}
?>

<form id="form_ajout_etablissement" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="page" value="nouveau_etablissement.php">

    <div class="container form_nouvel_etablissement" id="nouvel_etablissement">
        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
            <div class="col-md-3"><input type="text" name="nom" placeholder="Nom de l'établissement" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Type</span></div>
            <div class="col-md-3"><input type="text" name="type" placeholder="Lycée / Collège / GE" required></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">N°</span></div>
            <div class="col-md-3"><input type="text" name="numero" placeholder="Numéro de rue"></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Rue</span></div>
            <div class="col-md-3"><input type="text" name="rue" placeholder="Rue"></div>
        </div>

        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Ville</span></div>
            <div class="col-md-3"><input type="text" name="ville" placeholder="Ville" required></div>
        </div>

        <div class="row">
            <div class="col-md-5 offset-2">
                <input type="reset" id="reset_etab" value="Annuler">
                <input type="submit" id="submit_etablissement" name="submit_etablissement" value="Ajouter">
            </div>
        </div>
    </div>
</form>
