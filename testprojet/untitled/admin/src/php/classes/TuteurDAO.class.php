<?php

class TuteurDAO {
    private $_bd;
    private $_array = array();

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function update_ajax_tuteur($champ, $valeur, $id) {
        $query = "SELECT update_ajax_tuteur(:champ, :valeur, :id_tuteur)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':champ', $champ);
            $stmt->bindValue(':valeur', $valeur);
            $stmt->bindValue(':id_tuteur', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function delete_tuteur($id) {
        $query = "SELECT delete_tuteur(:id_tuteur)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_tuteur', $id);
            $stmt->execute();
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print $e->getMessage();
        }
    }

    public function add_tuteur($nom, $prenom, $telephone, $date_naissance, $lieu_naissance, $pays, $heures, $annulations, $absences, $type_etablissement, $login, $mdp_hash) {
        $query = "SELECT ajout_tuteur(:nom, :prenom, :telephone, :date_naissance, :lieu, :pays, :heures, :annulation, :absence, :type, :login, :mdp) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':telephone', $telephone);
            $stmt->bindValue(':date_naissance', $date_naissance);
            $stmt->bindValue(':lieu', $lieu_naissance);
            $stmt->bindValue(':pays', $pays);
            $stmt->bindValue(':heures', $heures);
            $stmt->bindValue(':annulation', $annulations);
            $stmt->bindValue(':absence', $absences);
            $stmt->bindValue(':type', $type_etablissement);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':mdp', $mdp_hash);
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

    public function update_tuteur_complet($id, $nom, $prenom, $telephone, $date_naissance, $lieu_naissance, $pays, $heures, $annulations, $absences, $type_etablissement) {
        $query = "SELECT update_tuteur(:id, :nom, :prenom, :telephone, :date_naissance, :lieu, :pays, :heures, :annulation, :absence, :type) AS retour";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':telephone', $telephone);
            $stmt->bindValue(':date_naissance', $date_naissance);
            $stmt->bindValue(':lieu', $lieu_naissance);
            $stmt->bindValue(':pays', $pays);
            $stmt->bindValue(':heures', $heures);
            $stmt->bindValue(':annulation', $annulations);
            $stmt->bindValue(':absence', $absences);
            $stmt->bindValue(':type', $type_etablissement);
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

    public function get_all_tuteurs() {
        $query = "SELECT * FROM get_all_tuteurs()";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print $e->getMessage();
            return [];
        }
    }


    public function get_tuteur_by_id($id_tuteur) {
        $query = "SELECT * FROM get_tuteur_by_id(:id)";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(":id", $id_tuteur, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Erreur Tuteur : " . $e->getMessage();
            return null;
        }
    }


    public function get_tuteur_and_details_by_id($id) {
        $query = "SELECT * FROM get_tuteur_and_details_by_id.sql(:id)";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getTuteurLogs($login, $password) {
        $query = "SELECT * FROM get_tuteur_logs(:login, :password)";
        try {
            $this->_bd->beginTransaction();
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':login', $login);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $tuteur = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->_bd->commit();
            return $tuteur;
        } catch (PDOException $e) {
            $this->_bd->rollBack();
            print "Erreur getTuteurLogs : " . $e->getMessage();
            return false;
        }
    }

}
