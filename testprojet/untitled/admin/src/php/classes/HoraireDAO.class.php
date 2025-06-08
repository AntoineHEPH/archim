<?php

class HoraireDAO {
    private $_bd;
    private $_array = array();

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function get_horaire($semaine, $id_creneau_type) {
        $query = "SELECT * FROM Horaire WHERE semaine = :semaine AND id_creneau_type = :id";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->bindValue(':id', $id_creneau_type, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            print "Erreur get_horaire : " . $e->getMessage();
            return null;
        }
    }

    // àfaire 11
    public function insert_horaire($semaine, $id_creneau_type, $nb_tutores = 0, $id_tuteur = null) {
        $query = "SELECT insert_horaire(:semaine, :id_creneau, :nb, :id_tuteur)";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->bindValue(':id_creneau', $id_creneau_type, PDO::PARAM_INT);
            $stmt->bindValue(':nb', $nb_tutores, PDO::PARAM_INT);
            $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            print "Erreur insert_horaire : " . $e->getMessage();
            return -1;
        }
    }


    public function get_all_horaires_by_semaine($semaine) {
        $query = "SELECT * FROM Horaire WHERE semaine = :semaine";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            print "Erreur get_all_horaires_by_semaine : " . $e->getMessage();
            return [];
        }
    }


    public function get_nb_tutores($id_horaire) {
        $query = "SELECT nb_tutores_attendus FROM Horaire WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function update_nb_tutores($id_horaire, $nb) {
        $query = "SELECT update_nb_tutores(:id, :nb)";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->bindValue(':nb', $nb, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function update_tuteur($id_horaire, $id_tuteur) {
        $query = "SELECT update_tuteur(:id, :id_tuteur)";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function get_or_create_horaire($id_creneau_type, $semaine)
    {

        $sql = "SELECT id_horaire FROM horaire WHERE id_creneau_type = :id_creneau AND semaine = :semaine";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id_creneau', $id_creneau_type);
        $stmt->bindValue(':semaine', $semaine);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        if ($id) {
            return $id;
        }

        $sql = "SELECT insert_horaire_sans_tuteur(:id_creneau, :semaine)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id_creneau', $id_creneau_type, PDO::PARAM_INT);
        $stmt->bindValue(':semaine', $semaine);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function get_tutores_by_horaire($id_horaire)
    {
        $sql = "SELECT id_tutore FROM horaire_tutore WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire);
        $stmt->execute();

        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_tutore');
    }

    public function get_tuteur_by_horaire($id_horaire)
    {
        $sql = "SELECT id_tuteur FROM horaire_tuteur WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire);
        $stmt->execute();

        return $stmt->fetchColumn(); // Peut être null si aucun tuteur assigné
    }

    public function set_tuteur_for_horaire($id_horaire, $id_tuteur)
    {
        $this->remove_tuteur_from_horaire($id_horaire);

        $sql = "SELECT set_tuteur_for_horaire(:horaire, :tuteur)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':horaire', $id_horaire, PDO::PARAM_INT);
        $stmt->bindValue(':tuteur', $id_tuteur, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function remove_tuteur_from_horaire($id_horaire)
    {
        $sql = "SELECT remove_tuteur_from_horaire(:id)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function clear_tutores_for_horaire($id_horaire)
    {
        $sql = "SELECT clear_tutores_for_horaire(:id)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->execute();
    }


    public function add_tutore_to_horaire($id_horaire, $id_tutore)
    {
        $sql = "SELECT add_tutore_to_horaire(:horaire, :tutore)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':horaire', $id_horaire, PDO::PARAM_INT);
        $stmt->bindValue(':tutore', $id_tutore, PDO::PARAM_INT);
        $stmt->execute();
    }








}
