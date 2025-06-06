<?php
$title = "Modifier un créneau";

$creneauDAO = new CreneauTypeDAO($cnx);

// 🟩 Si modification
if (isset($_GET['submit_modifier'])) {
    extract($_GET, EXTR_OVERWRITE);
    $retour = $creneauDAO->update_creneau($id_creneau, $jour, $heure_debut, $heure_fin, $id_etablissement);
    if ($retour != -1) {
        echo "<p class='txtGras txtVert'>Créneau modifié avec succès ✅</p>";
    } else {
        echo "<p class='txtGras txtRouge'>Erreur lors de la modification ❌</p>";
    }

    // 🟦 Recharger les données modifiées
    $data = $creneauDAO->get_creneau_by_id($id_creneau);
}

// 🟧 Si on arrive pour la première fois avec ?id=...
elseif (isset($_GET['id'])) {
    $data = $creneauDAO->get_creneau_by_id($_GET['id']);
}
?>


<?php if (isset($data)) { ?>
    <form id="form_modifier_creneau" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="page" value="modifier_creneau.php">
        <input type="hidden" name="id_creneau" value="<?= $data['id_creneau_type']; ?>">

        <div class="container form_modifier_creneau" id="modifier_creneau">

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Jour</span></div>
                <div class="col-md-3">
                    <input type="text" name="jour" value="<?= $data['jour']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Heure de début</span></div>
                <div class="col-md-3">
                    <input type="time" name="heure_debut" value="<?= $data['heure_debut']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Heure de fin</span></div>
                <div class="col-md-3">
                    <input type="time" name="heure_fin" value="<?= $data['heure_fin']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Établissement</span></div>
                <div class="col-md-3">
                    <input type="number" name="id_etablissement" value="<?= $data['id_etablissement']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 offset-2">
                    <input type="reset" id="reset_modif_creneau" value="Annuler">
                    <input type="submit" id="submit_modifier" name="submit_modifier" value="Valider">
                </div>
            </div>

        </div>
    </form>
<?php } else {
    print "<p class='txtRouge txtGras'>Aucun ID fourni.</p>";
}
