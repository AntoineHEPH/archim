<?php
$title = "Modifier un tutoré";

$tutore = new TutoreDAO($cnx);

// Si modification
if (isset($_GET['submit_modifier'])) {
    extract($_GET, EXTR_OVERWRITE);
    $retour = $tutore->update_tutore($id_tutore, $nom, $prenom, $date_naissance, $situation_perso, $details, $classe);
    if ($retour != -1) {
        echo "<p class='txtGras txtVert'>Tutoré modifié avec succès ✅</p>";
    } else {
        echo "<p class='txtGras txtRouge'>Erreur lors de la modification ❌</p>";
    }
    $data = $tutore->get_tutore_by_id($id_tutore);
}

// Si on arrive pour la première fois avec ?id=...
elseif (isset($_GET['id'])) {
    $data = $tutore->get_tutore_by_id($_GET['id']);
}
?>


<?php if (isset($data)) { ?>
    <form id="form_modifier_tutore" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="hidden" name="page" value="modifier_tutore.php">
        <input type="hidden" name="id_tutore" value="<?= $data['id_tutore']; ?>">

        <div class="container form_modifier_tutore" id="modifier_tutore">
            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Nom</span></div>
                <div class="col-md-3">
                    <input type="text" name="nom" value="<?= $data['nom']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Prénom</span></div>
                <div class="col-md-3">
                    <input type="text" name="prenom" value="<?= $data['prenom']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Date de naissance</span></div>
                <div class="col-md-3">
                    <input type="date" name="date_naissance" value="<?= $data['date_naissance']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Situation personnelle</span></div>
                <div class="col-md-3">
                    <textarea name="situation_perso" rows="2" cols="40" required><?= $data['situation_personnel']; ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Détails importants</span></div>
                <div class="col-md-3">
                    <textarea name="details" rows="3" cols="40" required><?= $data['details']; ?></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 offset-2"><span class="txtGras">Classe</span></div>
                <div class="col-md-3">
                    <input type="text" name="classe" value="<?= $data['classe']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5 offset-2">
                    <input type="reset" id="reset_modif_tutore" value="Annuler">
                    <input type="submit" id="submit_modifier" name="submit_modifier" value="Valider">
                </div>
            </div>
        </div>
    </form>
<?php } else {
    print "<p class='txtRouge txtGras'>Aucun ID fourni.</p>";
}
