<?php

namespace Application\Model;

class Photo 
{
    private $Id;
    private $Chemin;
    private $IdAnnonce;
    
    
    public function exchangeArray($donnees) {
        $this->setId ((!empty ($donnees['Id'])) ? $donnees['Id']:null);
        $this->setChemin ((!empty ($donnees['Chemin'])) ? $donnees['Chemin']:null);
        $this->setIdAnnonce ((!empty ($donnees['IdAnnonce'])) ? $donnees['IdAnnonce']:null);
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

    function getChemin() {
        return $this->Chemin;
    }

    
    function setId($id) {
        $this->Id = $id;
    }

    function setChemin($chemin) {
        $this->Chemin = $chemin;
    }


    
    function getIdAnnonce() {
        return $this->IdAnnonce;
    }

    function setIdAnnonce($idAnnonce) {
        $this->IdAnnonce = $idAnnonce;
    }


}
