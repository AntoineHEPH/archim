<?php

class DetailsDAO {
    private $_bd;

    public function __construct($cnx) {
        $this->_bd = $cnx;
    }

    public function ajouter_heures($id_details, $heures) {
        $sql = "SELECT ajouter_heures_details(:id, :h)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_details);
        $stmt->bindValue(':h', $heures);
        $stmt->execute();
    }


    public function incrementer_absence($id_details) {
        $sql = "SELECT incrementer_absence_details(:id)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_details);
        $stmt->execute();
    }


    public function incrementer_annulation($id_details) {
        $sql = "SELECT incrementer_annulation_details(:id)";
        $stmt = $this->_bd->prepare($sql);
        $stmt->bindValue(':id', $id_details);
        $stmt->execute();
    }

}
