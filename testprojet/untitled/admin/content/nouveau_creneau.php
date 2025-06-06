<?php
$title = "Nouveau créneau";

$etabs = new EtablissementDAO($cnx);
$liste_etabs = $etabs->get_all_etablissements();

if (isset($_GET['submit_creneau'])) {
    extract($_GET, EXTR_OVERWRITE);

    $creneau = new CreneauTypeDAO($cnx);
    $retour = $creneau->add_creneau($jour, $heure_debut, $heure_fin, $id_etablissement);

    if ($retour != -1) {
        echo "<br><span class='txtGras txtVert'>Créneau ajouté avec succès ✅</span><br>";
    } else {
        echo "<br><span class='txtGras txtRouge'>Erreur lors de l'ajout du créneau ❌</span><br>";
    }
}
?>

<form id="form_ajout_creneau" method="get" action="<?= $_SERVER['PHP_SELF'] ?>">
    <input type="hidden" name="page" value="nouveau_creneau.php">

    <div class="container form_nouveau_creneau" id="nouveau_creneau">
        <div class="row">
            <div class="col-md-3 offset-2"><span class="txtGras">Jour</span></div>
            <div class="col-md-3">
                <select name="jour" class="form-select" required>
                    <option value="">Choisir le jour</option>
                    <?php foreach (['Lundi','Mardi','Mercredi','Jeudi','Vendredi'] as $jour): ?>
                        <option value="<?= $jour ?>"><?= $jour ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 offset-2"><span class="txtGras">Heure de début</span></div>
            <div class="col-md-3"><input type="time" name="heure_debut" class="form-control" required></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 offset-2"><span class="txtGras">Heure de fin</span></div>
            <div class="col-md-3"><input type="time" name="heure_fin" class="form-control" required></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 offset-2"><span class="txtGras">Établissement</span></div>
            <div class="col-md-3">
                <select name="id_etablissement" class="form-select" required>
                    <option value="">Choisir l'établissement</option>
                    <?php foreach ($liste_etabs as $etab): ?>
                        <option value="<?= $etab['id_etablissement'] ?>">
                            <?= $etab['nom'] ?> (<?= $etab['ville'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-5 offset-2">
                <input type="reset" id="reset_creneau" value="Annuler" class="btn btn-secondary">
                <input type="submit" id="submit_creneau" name="submit_creneau" value="Ajouter" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
