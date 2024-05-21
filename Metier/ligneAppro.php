<?php
require_once("C:/xampp/htdocs/Mini1/Metier/ligne.php");

class LigneAppro extends Ligne
{

    public function save()
    {
        $this->dao->ajouterLigneAppro($this);
    }

    public static function afficher($id)
    {
        $dao = new DAO();
        return $dao->afficherLigneAppro($id);
    }

    public static function total($id)
    {
        $dao = new DAO();
        return $dao->totalAppro($id);
    }
}
