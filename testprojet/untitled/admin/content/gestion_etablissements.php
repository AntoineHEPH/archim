<?php
$etabs = new EtablissementDAO($cnx);
$liste = $etabs->get_all_etablissements();
?>

<div class="row align-items-stretch">

    <!-- Carte "Ajouter un établissement" -->
    <div class="col-md-4 mb-4 d-flex">
        <div class="card shadow text-center h-100 w-100">
            <a href="./index_.php?page=nouveau_etablissement.php"
               class="card-body text-decoration-none d-flex flex-column justify-content-center align-items-center h-100 w-100 text-dark">
                <div style="font-size: 4rem;">✚</div>
                <div class="mt-3 text-muted" style="font-size: 0.9rem;">Ajouter un établissement</div>
            </a>
        </div>
    </div>

    <?php foreach ($liste as $etab) { ?>
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow p-3 h-100 w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">
                        <span contenteditable="true" data-champ="nom" data-table="etablissement"
                              id="nom-<?= $etab['id_etablissement']; ?>">
                            <?= $etab['nom']; ?>
                        </span>
                    </h5>

                    <p class="card-text">
                        <strong>Type :</strong><br>
                        <span contenteditable="true" data-champ="type" data-table="etablissement"
                              id="type-<?= $etab['id_etablissement']; ?>"><?= $etab['type']; ?></span><br><br>

                        <strong>Numéro :</strong><br>
                        <span contenteditable="true" data-champ="numero" data-table="etablissement"
                              id="numero-<?= $etab['id_etablissement']; ?>"><?= $etab['numero']; ?></span><br><br>

                        <strong>Rue :</strong><br>
                        <span contenteditable="true" data-champ="rue" data-table="etablissement"
                              id="rue-<?= $etab['id_etablissement']; ?>"><?= $etab['rue']; ?></span><br><br>

                        <strong>Ville :</strong><br>
                        <span contenteditable="true" data-champ="ville" data-table="etablissement"
                              id="ville-<?= $etab['id_etablissement']; ?>"><?= $etab['ville']; ?></span>
                    </p>

                    <a href="src/php/ajax/ajax_delete_etablissement.php?id_etablissement=<?= $etab['id_etablissement']; ?>"
                       onclick="return confirm('Supprimer cet établissement ?');"
                       class="btn btn-danger w-100 mt-2">
                        🗑️ Supprimer
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>

</div>
