<?php

class TutoreDAO {
    private $_bd;
    private $_array = array();

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function update_ajax_tutore($champ, $valeur, $id) {
        $query = "SELECT update_ajax_tutore(:champ, :valeur, :id_tutore)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur', $valeur);
            $stmt->bindValue(':id_tutore', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function delete_tutore($id) {
        $query = "SELECT delete_tutore(:id_tutore)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_tutore', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function add_tutore($nom, $prenom, $date_naissance, $situation_perso, $details, $classe) {
        $query = "SELECT ajout_tutore(:nom, :prenom, :date_naissance, :situation, :details, :classe) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':date_naissance', $date_naissance);
            $stmt->bindValue(':situation', $situation_perso);
            $stmt->bindValue(':details', $details);
            $stmt->bindValue(':classe', $classe);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return -1;
        }
    }

    public function update_tutore($id, $nom, $prenom, $date_naissance, $situation_perso, $details, $classe) {
        $query = "SELECT update_tutore(:id, :nom, :prenom, :date_naissance, :situation, :details, :classe) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':date_naissance', $date_naissance);
            $stmt->bindValue(':situation', $situation_perso);
            $stmt->bindValue(':details', $details);
            $stmt->bindValue(':classe', $classe);
            $stmt->execute();
            $retour = $stmt->fetchColumn(0);
            $this->_bd->commit();
            return $retour;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
            return -1;
        }
    }

    public function get_all_tutores() {
        $query = "SELECT * FROM Tutore ORDER BY nom, prenom";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }

    public function get_tutore_by_id($id_tutore) {
        $query = "SELECT * FROM Tutore WHERE id_tutore = :id";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(":id", $id_tutore, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }


}
