<?php

class DisponibiliteDAO {
    private $_bd;

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function get_disponibilite_by_tuteur_semaine($id_tuteur, $semaine) {
        $query = "SELECT * FROM Disponibilite WHERE id_tuteur = :id AND semaine = :semaine";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id_tuteur, PDO::PARAM_INT);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            print "Erreur chargement disponibilité : " . $e->getMessage();
            return null;
        }
    }

    // àfaire 1
    public function add_disponibilite($id_tuteur, $semaine) {
        $query = "SELECT add_disponibilite_plpgsql(:id_tuteur, :semaine)";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            print "Erreur création disponibilité : " . $e->getMessage();
            return -1;
        }
    }


    public function get_creneaux_selectionnes($id_dispo) {
        $query = "SELECT * FROM get_creneaux_selectionnes(:id_dispo)";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_dispo', $id_dispo, PDO::PARAM_INT);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $res;
        } catch (PDOException $e) {
            print "Erreur chargement créneaux sélectionnés : " . $e->getMessage();
            return [];
        }
    }


    // àfaire 2
    public function delete_creneaux_dispo($id_dispo) {
        $query = "SELECT delete_creneaux_dispo(:id_dispo)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_dispo', $id_dispo, PDO::PARAM_INT);
            $stmt->execute();
            $this->_bd->commit();
            return 1;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur suppression créneaux dispo : " . $e->getMessage();
            return -1;
        }
    }


    // àfaire 3
    public function add_creneau_dispo($id_dispo, $id_creneau_type) {
        $query = "SELECT add_creneau_dispo(:id_dispo, :id_creneau_type)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_dispo', $id_dispo, PDO::PARAM_INT);
            $stmt->bindValue(':id_creneau_type', $id_creneau_type, PDO::PARAM_INT);
            $stmt->execute();
            $this->_bd->commit();
            return 1;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur ajout créneau dispo : " . $e->getMessage();
            return -1;
        }
    }


    public function get_tuteurs_disponibles_creneau($id_creneau_type, $semaine) {
        $query = "
        SELECT t.id_tuteur, t.nom, t.prenom, d.heures_prestees,
            (
                SELECT COUNT(*) 
                FROM Disponibilite d2 
                WHERE d2.id_tuteur = t.id_tuteur AND d2.semaine = :semaine
            ) AS nb_dispo_semaine
        FROM Tuteur t
        JOIN Details d ON d.id_details = t.id_details
        JOIN Disponibilite dispo ON dispo.id_tuteur = t.id_tuteur AND dispo.semaine = :semaine
        JOIN Creneau_disponibilite cd ON cd.id_dispo = dispo.id_dispo
        WHERE cd.id_creneau_type = :id_creneau_type
        GROUP BY t.id_tuteur, t.nom, t.prenom, d.heures_prestees
    ";

        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_creneau_type', $id_creneau_type, PDO::PARAM_INT);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Erreur tuteurs disponibles : " . $e->getMessage();
            return [];
        }
    }




}
