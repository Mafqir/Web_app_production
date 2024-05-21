<?php
include_once("C:/xampp/htdocs/Mini1/DAO/DAO.php");

require_once("C:/xampp/htdocs/Mini1/Metier/personne.php");

class Client extends Personne
{

    function save()
    {
        $this->dao->ajouterClient($this);
    }

    static function afficher()
    {
        $dao = new DAO();
        return $dao->afficherClient();
    }

    static function total()
    {
        $dao = new DAO();
        return $dao->getClientTotal();
    }

    function setId($idd)
    {
        $this->id = $idd;
    }

    function update($cli)
    {
        $this->dao->updateClient($cli);
    }

    function getClient($cli)
    {
        $this->dao->getClient($cli);
    }

    static function delete($cli)
    {
        $dao = new DAO();
        $dao->deleteClient($cli);
    }
}
