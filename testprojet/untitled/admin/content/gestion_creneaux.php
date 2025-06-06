<?php
$creneaux = new CreneauTypeDAO($cnx);
$etabs = new EtablissementDAO($cnx);
$liste_etabs = $etabs->get_all_etablissements();

usort($liste_etabs, function($a, $b) {
    return strcmp($a['type'], $b['type']);
});

?>

<p class="txtGras txtItalic red" id="ajouter_creneau">
    <a id="ajouter_creneau_no_js" href="./index_.php?page=nouveau_creneau.php">➕ Nouveau créneau</a>
</p>

<div id="nouvelle_ligne"></div>

<?php
$color_map = [
    'Lycée' => 'bg-info',
    'Collège' => 'bg-success',
    'GE' => 'bg-secondary',
    'default' => 'bg-secondary'
];
?>

<?php foreach ($liste_etabs as $etab):
    $type = $etab['type'];
    $color_class = $color_map[$type] ?? $color_map['default'];
    ?>
    <div class="card mb-4">
        <div class="card-header text-white <?= $color_class ?>">
            <?= $etab['nom'] ?> (<?= $etab['ville'] ?>)
        </div>
        <ul class="list-group list-group-flush">
            <?php
            $creneaux_etab = $creneaux->get_creneaux_by_etablissement($etab['id_etablissement']);
            if (empty($creneaux_etab)) {
                echo "<li class='list-group-item text-muted'>Aucun créneau défini pour cet établissement.</li>";
            } else {
                foreach ($creneaux_etab as $creneau): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3 align-items-center flex-wrap">
                            <span contenteditable="true"
                                  data-champ="jour"
                                  data-table="creneau_type"
                                  id="<?= $creneau['id_creneau_type']; ?>">
                                <?= $creneau['jour']; ?>
                            </span>
                            —
                            <span contenteditable="true"
                                  data-champ="heure_debut"
                                  data-table="creneau_type"
                                  id="<?= $creneau['id_creneau_type']; ?>">
                                <?= $creneau['heure_debut']; ?>
                            </span>
                            à
                            <span contenteditable="true"
                                  data-champ="heure_fin"
                                  data-table="creneau_type"
                                  id="<?= $creneau['id_creneau_type']; ?>">
                                <?= $creneau['heure_fin']; ?>
                            </span>
                        </div>
                        <span>
                            <a href="src/php/ajax/ajax_delete_creneau.php?id_creneau_type=<?= $creneau['id_creneau_type']; ?>"
                               onclick="return confirm('Supprimer ce créneau ?');">❌</a>
                        </span>
                    </li>
                <?php endforeach;
            }
            ?>
        </ul>
    </div>
<?php endforeach; ?>

<script src="assets/js/modifier_table.js" defer></script>
