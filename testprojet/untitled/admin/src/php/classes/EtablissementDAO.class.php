<?php

class EtablissementDAO {
    private $_bd;

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function add_etablissement($nom, $type, $numero, $rue, $ville) {
        $query = "SELECT ajout_etablissement(:nom, :type, :numero, :rue, :ville) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':rue', $rue);
            $stmt->bindValue(':ville', $ville);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur ajout : " . $e->getMessage();
            return -1;
        }
    }

    public function update_etablissement($id, $nom, $type, $numero, $rue, $ville) {
        $query = "SELECT update_etablissement(:id, :nom, :type, :numero, :rue, :ville) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':type', $type);
            $stmt->bindValue(':numero', $numero);
            $stmt->bindValue(':rue', $rue);
            $stmt->bindValue(':ville', $ville);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur update : " . $e->getMessage();
            return -1;
        }
    }

    public function delete_etablissement($id) {
        $query = "SELECT delete_etablissement(:id_etablissement)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_etablissement', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function update_ajax_etablissement($champ, $valeur, $id) {
        $query = "SELECT update_ajax_etablissement(:champ, :valeur, :id_etablissement)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur', $valeur);
            $stmt->bindValue(':id_etablissement', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function get_all_etablissements() {
        $query = "SELECT * FROM Etablissement ORDER BY nom";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function get_etablissement_by_id($id) {
        $query = "SELECT * FROM Etablissement WHERE id_etablissement = :id";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur Etablissement : " . $e->getMessage();
            return null;
        }
    }
}
