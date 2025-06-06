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
        $query = "INSERT INTO Horaire (semaine, id_creneau_type, nb_tutores_attendus, id_tuteur)
                  VALUES (:semaine, :id_creneau, :nb, :id_tuteur)";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':semaine', $semaine);
            $stmt->bindValue(':id_creneau', $id_creneau_type, PDO::PARAM_INT);
            $stmt->bindValue(':nb', $nb_tutores, PDO::PARAM_INT);
            $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
            $stmt->execute();
            return $this->_bd->lastInsertId();
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

    // àfaire 10
    public function update_nb_tutores($id_horaire, $nb) {
        $query = "UPDATE Horaire SET nb_tutores_attendus = :nb WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':nb', $nb, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->execute();
    }

    // àfaire 9
    public function update_tuteur($id_horaire, $id_tuteur) {
        $query = "UPDATE Horaire SET id_tuteur = :id_tuteur WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($query);
        $stmt->bindValue(':id_tuteur', $id_tuteur, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id_horaire, PDO::PARAM_INT);
        $stmt->execute();
    }

    // àfaire 8
    public function get_or_create_horaire($id_creneau_type, $semaine)
    {
        // 1. Vérifie si un horaire existe déjà
        $sql = "SELECT id_horaire FROM horaire WHERE id_creneau_type = :id_creneau AND semaine = :semaine";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id_creneau', $id_creneau_type);
        $stmt->bindValue(':semaine', $semaine);
        $stmt->execute();
        $id = $stmt->fetchColumn();

        // 2. Si trouvé, retourne l’ID
        if ($id) {
            return $id;
        }

        // 3. Sinon, crée-le
        $sql = "INSERT INTO horaire (id_creneau_type, semaine) VALUES (:id_creneau, :semaine)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id_creneau', $id_creneau_type);
        $stmt->bindValue(':semaine', $semaine);
        $stmt->execute();

        return $this->_bd->lastInsertId();
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

    // àfaire 7
    // Affecte un tuteur à un horaire (supprime l'ancien si existant)
    public function set_tuteur_for_horaire($id_horaire, $id_tuteur)
    {
        $this->remove_tuteur_from_horaire($id_horaire);

        $sql = "INSERT INTO horaire_tuteur (id_horaire, id_tuteur) VALUES (:horaire, :tuteur)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':horaire', $id_horaire);
        $stmt->bindValue(':tuteur', $id_tuteur);
        $stmt->execute();
    }

    // àfaire 6
// Supprime le tuteur d’un horaire
    public function remove_tuteur_from_horaire($id_horaire)
    {
        $sql = "DELETE FROM horaire_tuteur WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire);
        $stmt->execute();
    }

    // àfaire 5
// Supprime tous les tutorés d’un horaire
    public function clear_tutores_for_horaire($id_horaire)
    {
        $sql = "DELETE FROM horaire_tutore WHERE id_horaire = :id";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_horaire);
        $stmt->execute();
    }

    // àfaire 4
// Ajoute un tutoré à un horaire
    public function add_tutore_to_horaire($id_horaire, $id_tutore)
    {
        $sql = "INSERT INTO horaire_tutore (id_horaire, id_tutore) VALUES (:horaire, :tutore)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':horaire', $id_horaire);
        $stmt->bindValue(':tutore', $id_tutore);
        $stmt->execute();
    }







}
