<?php

class CreneauTypeDAO {
    private $_bd;
    private $_array = array();

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function add_creneau($jour, $heure_debut, $heure_fin, $id_etablissement) {
        $query = "SELECT ajout_creneau_type(:jour, :heure_debut, :heure_fin, :id_etab) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':jour', $jour);
            $stmt->bindValue(':heure_debut', $heure_debut);
            $stmt->bindValue(':heure_fin', $heure_fin);
            $stmt->bindValue(':id_etab', $id_etablissement);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur ajout créneau : " . $e->getMessage();
            return -1;
        }
    }

    public function delete_creneau($id_creneau_type) {
        $query = "SELECT delete_creneau_type(:id_creneau)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_creneau', $id_creneau_type);
            $stmt->execute();
            $this->_bd->commit();
            return 1;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur suppression créneau : " . $e->getMessage();
            return -1;
        }
    }

    public function update_ajax_creneau($champ, $valeur, $id_creneau) {
        $query = "SELECT update_ajax_creneau_type(:champ, :valeur, :id_creneau)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur', $valeur);
            $stmt->bindValue(':id_creneau', $id_creneau);
            $stmt->execute();
            $this->_bd->commit();
            return 1;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur modification AJAX : " . $e->getMessage();
            return -1;
        }
    }

    public function get_creneaux_by_etablissement($id_etablissement) {
        $query = "SELECT * FROM Creneau_type 
              WHERE id_etablissement = :id 
              ORDER BY 
                  CASE 
                      WHEN jour = 'Lundi' THEN 1
                      WHEN jour = 'Mardi' THEN 2
                      WHEN jour = 'Mercredi' THEN 3
                      WHEN jour = 'Jeudi' THEN 4
                      WHEN jour = 'Vendredi' THEN 5
                      WHEN jour = 'Samedi' THEN 6
                      WHEN jour = 'Dimanche' THEN 7
                      ELSE 8
                  END,
                  heure_debut";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id_etablissement, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Erreur chargement créneaux : " . $e->getMessage();
            return [];
        }
    }

    public function get_creneaux_by_type_etablissement($type_etab) {
        $query = "SELECT * FROM Creneau_type ct 
              JOIN Etablissement e ON ct.id_etablissement = e.id_etablissement
              WHERE e.type = :type_etab
              ORDER BY 
                  CASE 
                      WHEN jour = 'Lundi' THEN 1
                      WHEN jour = 'Mardi' THEN 2
                      WHEN jour = 'Mercredi' THEN 3
                      WHEN jour = 'Jeudi' THEN 4
                      WHEN jour = 'Vendredi' THEN 5
                      ELSE 6
                  END, heure_debut";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':type_etab', $type_etab);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Erreur chargement créneaux (type) : " . $e->getMessage();
            return [];
        }
    }

    public function get_duree_creneau($id_creneau) {
        $sql = "SELECT heure_debut, heure_fin FROM creneau_type WHERE id_creneau_type = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_creneau);
        $stmt->execute();
        return $stmt->fetch();
    }




}
