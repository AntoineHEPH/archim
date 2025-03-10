<?php
class TuteurDAO
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getTuteur()
    {
        $query = "select * from tuteur";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            foreach ($data as $d) {
                $_array[] = new Tuteur($d);
            }
            if(!empty($_array)){
                return $_array;
            } else {
                return null;
            }

            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }
}