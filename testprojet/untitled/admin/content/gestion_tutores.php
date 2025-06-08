<?php
$tutores = new TutoreDAO($cnx);
$liste = $tutores->get_all_tutores();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="txtGras">Tutorés</h2>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" id="searchTutore" placeholder="🔍 Rechercher un tutoré par nom ou prénom...">
    </div>

    <div class="row align-items-stretch" id="gridTutores">
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow text-center h-100 w-100">
                <a href="./index_.php?page=nouveau_tutore.php"
                   class="card-body text-decoration-none d-flex flex-column justify-content-center align-items-center h-100 w-100 text-dark">
                    <div style="font-size: 4rem;">✚</div>
                    <div class="mt-3 text-muted" style="font-size: 0.9rem;">Ajouter un tutoré</div>
                </a>
            </div>
        </div>

        <?php foreach ($liste as $tutore) { ?>
            <div class="col-md-4 mb-4 d-flex" data-nom="<?= strtolower($tutore['nom'] . ' ' . $tutore['prenom']) ?>">
                <div class="card shadow p-3 h-100 w-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">
                            <span contenteditable="true" data-champ="nom" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"><?= $tutore['nom']; ?></span>
                            <span contenteditable="true" data-champ="prenom" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"> <?= $tutore['prenom']; ?></span>
                        </h5>
                        <p class="card-text">
                            <strong>Date de naissance :</strong><br>
                            <span contenteditable="true" data-champ="date_naissance" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"><?= $tutore['date_naissance']; ?></span><br><br>

                            <strong>Situation perso :</strong><br>
                            <span contenteditable="true" data-champ="situation_personnel" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"><?= $tutore['situation_personnel']; ?></span><br><br>

                            <strong>Détails :</strong><br>
                            <span contenteditable="true" data-champ="details" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"><?= $tutore['details']; ?></span><br><br>

                            <strong>Classe :</strong><br>
                            <span contenteditable="true" data-champ="classe" data-table="tutore"
                                  id="<?= $tutore['id_tutore']; ?>"><?= $tutore['classe']; ?></span>
                        </p>
                        <a href="src/php/ajax/ajax_delete_tutore.php?id_tutore=<?= $tutore['id_tutore']; ?>"
                           onclick="return confirm('Supprimer ce tutoré ?');"
                           class="btn btn-danger w-100">
                            🗑️ Supprimer
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>