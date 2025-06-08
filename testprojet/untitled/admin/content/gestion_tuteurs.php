<?php
$tuteurs = new TuteurDAO($cnx);
$liste = $tuteurs->get_all_tuteurs();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="txtGras">Tuteurs</h2>
        <a href="index_.php?page=nouveau_tuteur.php" class="btn btn-success">➕ Ajouter un tuteur</a>
    </div>

    <div class="mb-3">
        <input type="text" class="form-control" id="searchTuteur" placeholder="🔍 Rechercher un tuteur par nom ou prénom...">
    </div>

    <div class="accordion" id="accordionTuteurs">
        <?php foreach ($liste as $index => $tuteur): ?>
            <div class="accordion-item" data-nom="<?= strtolower($tuteur['nom'] . ' ' . $tuteur['prenom']) ?>">
                <h2 class="accordion-header" id="heading<?= $index ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                        <?= $tuteur['nom'].' '.$tuteur['prenom']; ?>
                    </button>
                </h2>

                <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionTuteurs">
                    <div class="accordion-body">
                        <p><strong>Nom :</strong>
                            <span contenteditable="true" data-champ="nom" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= htmlspecialchars($tuteur['nom']); ?></span></p>

                        <p><strong>Prénom :</strong>
                            <span contenteditable="true" data-champ="prenom" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['prenom']; ?></span></p>

                        <p><strong>Téléphone :</strong>
                            <span contenteditable="true" data-champ="telephone" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['telephone']; ?></span></p>

                        <p><strong>Date de naissance :</strong>
                            <span contenteditable="true" data-champ="date_naissance" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['date_naissance']; ?></span></p>

                        <p><strong>Lieu de naissance :</strong>
                            <span contenteditable="true" data-champ="lieu_naissance" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['lieu_naissance']; ?></span></p>

                        <p><strong>Pays :</strong>
                            <span contenteditable="true" data-champ="pays" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['pays']; ?></span></p>

                        <p><strong>Établissement :</strong>
                            <span contenteditable="true" data-champ="type_etablissement" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['type_etablissement']; ?></span></p>

                        <p><strong>Heures prestées :</strong>
                            <span contenteditable="true" data-champ="heures_prestees" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['heures_prestees']; ?></span></p>

                        <p><strong>Annulation(s) : </strong>
                            <span contenteditable="true" data-champ="nb_annulation" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['nb_annulation']; ?></span></p>

                        <p><strong>Absence(s) : </strong>
                            <span contenteditable="true" data-champ="nb_absence" data-table="tuteur"
                                  id="<?= $tuteur['id_tuteur']; ?>"><?= $tuteur['nb_absence']; ?></span></p>

                        <div class="d-flex gap-2 mt-3">
                            <a href="index_.php?page=disponibilites.php&id_tuteur=<?= $tuteur['id_tuteur']; ?>" class="btn btn-outline-primary btn-sm">📅 Disponibilités</a>
                            <a href="src/php/ajax/ajax_delete_tuteur.php?id_tuteur=<?= $tuteur['id_tuteur']; ?>" onclick="return confirm('Supprimer ce tuteur ?');" class="btn btn-danger btn-sm">🗑️ Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>