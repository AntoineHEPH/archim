<?php
$title = "Modifier un établissement";

$etab = new EtablissementDAO($cnx);

// 🟩 Si modification
if (isset($_GET['submit_modifier'])) {
    extract($_GET, EXTR_OVERWRITE);
    $retour = $etab->update_etablissement($id_etablissement, $nom, $type, $numero, $rue, $ville);

    if ($retour != -1) {
        echo "<p class='txtGras txtVert'>Établissement modifié avec succès ✅</p>";
    } else {
        echo "<p class='txtGras txtRouge'>Erreur lors de la modification ❌</p>";
    }

    $data = $etab->get_etablissement_by_id($id_etablissement);
}
// 🟧 Si on arrive pour la première fois avec un ID
elseif (isset($_GET['id'])) {
    $data = $etab->get_etablissement_by_id($_GET['id']);
}
?>

<?php if (isset($data)) { ?>
    <form id="form_modifier_etablissement" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="page" value="modifier_etablissement.php">
        <input type="hidden" name="id_etablissement" value="<?= $data['id_etablissement']; ?>">

        <div class="container form_modifier_etablissement" id="modifier_etablissement">

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
                <div class="col-md-3">
                    <input type="text" name="nom" value="<?= $data['nom']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Type</span></div>
                <div class="col-md-3">
                    <input type="text" name="type" value="<?= $data['type']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Numéro</span></div>
                <div class="col-md-3">
                    <input type="text" name="numero" value="<?= $data['numero']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Rue</span></div>
                <div class="col-md-3">
                    <input type="text" name="rue" value="<?= $data['rue']; ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Ville</span></div>
                <div class="col-md-3">
                    <input type="text" name="ville" value="<?= $data['ville']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 offset-2">
                    <input type="reset" id="reset_modif_etab" value="Annuler">
                    <input type="submit" id="submit_modifier" name="submit_modifier" value="Valider">
                </div>
            </div>
        </div>
    </form>
<?php } else {
    echo "<p class='txtRouge txtGras'>Aucun ID fourni.</p>";
} ?>
