<?php
// Inclure l'autoloader de Composer
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Chemin vers le fichier Excel
$inputFileName = './content/Dispos.xlsx';

try {
    // Charger le fichier Excel
    $spreadsheet = IOFactory::load($inputFileName);
    // Sélectionner la première feuille
    $sheet = $spreadsheet->getActiveSheet();
    $row_sql = array(
        ':pas_disponible',
        ':ge_monday_16h50_18h30',
        ':ge_monday_17h30_18h45',
        ':ge_tuesday_16h50_18h30',
        ':ge_wednesday_14h_16h',
        ':ge_thursday_16h50_18h30',
        ':ge_friday_16h50_18h30',
        ':ge_friday_17h30_18h45',
        ':co_monday_16h_17h',
        ':co_monday_17h_18h',
        ':co_tuesday_16h_17h',
        ':co_tuesday_17h_18h',
        ':co_thursday_16h_17h',
        ':co_thursday_17h_18h',
        ':co_friday_16h_17h',
        ':ly_monday_16h_17h',
        ':ly_monday_17h_18h',
        ':ly_tuesday_16h_17h',
        ':ly_tuesday_17h_18h',
        ':ly_thursday_16h_17h',
        ':ly_thursday_17h_18h',
        ':ly_friday_16h_17h',
        ':ly_friday_17h_18h'
    );


    $pos_tuteur = -1;
    for($i = 3; $i<300; $i++)
    {
        $info_ligne = array(
            $sheet->getCell('A'.$i)->getValue(),
            $sheet->getCell('B'.$i)->getValue(),
            $sheet->getCell('C'.$i)->getValue(),
            $sheet->getCell('D'.$i)->getValue(),
            $sheet->getCell('E'.$i)->getValue(),
            $sheet->getCell('F'.$i)->getValue(),
            $sheet->getCell('G'.$i)->getValue(),
            $sheet->getCell('H'.$i)->getValue(),
            $sheet->getCell('I'.$i)->getValue(),
            $sheet->getCell('J'.$i)->getValue(),
            $sheet->getCell('K'.$i)->getValue()
        );

        $pos_tuteur = type_etablissement($pos_tuteur, $info_ligne[1]);

        if(strpos($info_ligne[1], 'TUTEURS') === false AND $info_ligne[1] != "") {
            $data_tuteur = fill_data_tuteur($info_ligne, $pos_tuteur);
            $data_tuteur = replace_null_by_0($data_tuteur);
            $data_tuteur[0] = trim($data_tuteur[0]);
            $data_tuteur[1] = trim($data_tuteur[1]);

            afficher_tuteur($data_tuteur);
            $query = "SELECT ajout_dispo(:pas_disponible, :ge_monday_16h50_18h30, :ge_monday_17h30_18h45, :ge_tuesday_16h50_18h30, :ge_wednesday_14h_16h, :ge_thursday_16h50_18h30, :ge_friday_16h50_18h30, :ge_friday_17h30_18h45, :co_monday_16h_17h, :co_monday_17h_18h, :co_tuesday_16h_17h, :co_tuesday_17h_18h, :co_thursday_16h_17h, :co_thursday_17h_18h, :co_friday_16h_17h, :ly_monday_16h_17h, :ly_monday_17h_18h, :ly_tuesday_16h_17h, :ly_tuesday_17h_18h, :ly_thursday_16h_17h, :ly_thursday_17h_18h, :ly_friday_16h_17h, :ly_friday_17h_18h)";
            $stmt = $cnx->prepare($query);
            $index = 2;
            var_dump($data_tuteur);
            foreach($row_sql as $row) {
                if ($row == true) {
                    $value = $data_tuteur[$index];
                    if ($value === NULL || $value === '') {
                        $value = 0;
                    }
                    $value = boolval($value);
                    $stmt->bindValue($row, $value, PDO::PARAM_BOOL);
                }
                $index++;
            }
            $stmt->execute();
            $id_dispo = $stmt->fetchColumn(0);
            echo "<br>ID Dispo : " . $id_dispo.gettype($id_dispo);

            $query = "SELECT get_tuteur(:nom, :prenom)";
            $stmt = $cnx->prepare($query);
            $stmt->bindValue(':nom', $data_tuteur[0]);
            $stmt->bindValue(':prenom', $data_tuteur[1]);
            $stmt->execute();
            $id_tuteur = $stmt->fetchColumn(0);
            echo "<br>ID Tuteur : " . $id_tuteur.gettype($id_tuteur);
            echo "<br>";

            if($id_tuteur != NULL AND $id_dispo != NULL)
            {
                $query = "SELECT ajout_dispotuteur(:id_tuteur::integer, :id_dispo::integer)";
                $stmt = $cnx->prepare($query);
                $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
                $stmt->bindValue(':id_dispo', $id_dispo, PDO::PARAM_INT);
                $stmt->execute();
                $id_tuteurdispo = $stmt->fetchColumn(0);
                echo "<br>ID Tuteur-Dispo : " . $id_tuteurdispo;
                echo "<br>";
            }
        }

    }
} catch (Exception $e) {
    die('Erreur lors du chargement du fichier : ' . $e->getMessage());
}


function type_etablissement($pos_tuteur, $cell) {
    if(strpos($cell, ' GE') !== false) {
        return 1;
    } else if (strpos($cell, 'COLLEGE') !== false) {
        return 2;
    } else if (strpos($cell, 'LYCEE') !== false) {
        return 3;
    } return $pos_tuteur;
}

function afficher_tuteur($liste) {
    foreach ($liste as $cell) {
        echo $cell." "; }
    echo "<br>";
}

function replace_null_by_0($liste) {
    $new_liste = array();
    foreach ($liste as $cell) {
        if ($cell === NULL || $cell === '') {
            array_push($new_liste, 0); // Remplace NULL ou chaîne vide par 0
        } else {
            array_push($new_liste, $cell);
        }
    }
    return $new_liste;
}


function fill_data_tuteur($liste, $position) {
    $tuteur_fill = array($liste[0], $liste[1], $liste[2]);
    switch ($position) {
        case 1:
            $tuteur_fill = array_merge($tuteur_fill, array_slice($liste, 3));
            $tuteur_fill = add_false_nb($tuteur_fill, 15);
            break;
        case 2:
            $tuteur_fill = add_false_nb($tuteur_fill, 7);
            $tuteur_fill = array_merge($tuteur_fill, array_slice($liste, 3));
            $tuteur_fill = add_false_nb($tuteur_fill, 8);
            break;
        case 3:
            $tuteur_fill = add_false_nb($tuteur_fill, 14);
            $tuteur_fill = array_merge($tuteur_fill, array_slice($liste, 3));
            break;
    }
    return $tuteur_fill;
}

function add_false_nb($liste, $nb) {
    for($i = 0; $i<$nb; $i++) {
        array_push($liste, NULL);
    }
    return $liste;
}
?>