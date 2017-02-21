<?php

namespace Application\Model;


class AnnonceTable
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }
    
    public function getListeAnnonces()
    {	
        $result = $this->tableGateway->select();
        return $result;
    }
    
    public function getAnnonces($filtres = []) 
    {
        $donnees = $this->tableGateway->select($filtres); 
        return $donnees;
    }
    
    public function getAnnonceParId($filtres = []) 
    {
        $donnees = $this->tableGateway->select($filtres);
        $ligne= $donnees->current();
        return $ligne;
    }
        
    public function insertAnnonce($annonce) 
    {
        $annonceArray = $annonce->toArray();
        $resultat = $this->tableGateway->insert($annonceArray);
        return ($resultat);
    }
    
    public function updateAnnonce($annonce) 
    {
        $annonceArray = $annonce->toArray();
        $idAnnonce = $annonce->getId();
        $resultat = $this->tableGateway->update($annonceArray,['Id'=>$idAnnonce]);
        return ($resultat);
    }
    
    public function deleteAnnonce($annonce) 
    {
        $idAnnonce = $annonce->getId();
        $resultat = $this->tableGateway->delete(array('Id'=>$idAnnonce));
        return ($resultat);
    }
    
    public function getLastID() {
        return $this->tableGateway->getLastInsertValue();
    }
    

}
