<?php

namespace Application\Model;

class Category 
{
    private $Id;
    private $Nom;
    
    public $listeAnnonces=array();
    
    
    public function exchangeArray($donnees) {
        $this->setId ((!empty ($donnees['Id'])) ? $donnees['Id']:null);
        $this->setNom ((!empty ($donnees['Nom'])) ? $donnees['Nom']:null);
    }
    
    
    public function __construct ($donnees=[]){
        $this->hydrate ($donnees);
    }
        
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function toArray()
    {
        return get_object_vars($this);
    }
    
    function getId() {
        return $this->Id;
    }

    function getNom() {
        return $this->Nom;
    }

    
    function setId($id) {
        $this->Id = $id;
    }

    function setNom($nom) {
        $this->Nom = $nom;
    }

    function setListeAnnonces($annoncesListe) {
        $this->listeAnnonces = $annoncesListe;
    }
}

