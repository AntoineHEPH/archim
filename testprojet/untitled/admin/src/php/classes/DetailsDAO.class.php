<?php

class DetailsDAO {
    private $_bd;
    private $_array = array();

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

// àfaire
    public function update_details($id_details, $heures, $annulations, $absences) { // àfaire
        $sql = "UPDATE details SET heures_prestees = :h, nb_annulation = :a, nb_absence = :ab WHERE id_details = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id_details);
        $stmt->bindValue(':h', $heures);
        $stmt->bindValue(':a', $annulations);
        $stmt->bindValue(':ab', $absences);
        return $stmt->execute();
    }




}
