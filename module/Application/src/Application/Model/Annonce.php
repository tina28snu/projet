<?php

namespace Application\Model;

class Annonce 
{
    private $Id;
    private $Nom;
    private $Description;
    private $Prix;
    private $IdUser;
    private $IdCategory;
    
    // dep
    private $objCategory;
    private $objUser;
    
    // dep
    public $listeObjPhotos; // array objets Photo
    
    public function exchangeArray($donnees) {
        $this->setId ((!empty ($donnees['Id'])) ? $donnees['Id']:null);
        $this->setNom ((!empty ($donnees['Nom'])) ? $donnees['Nom']:null);
        $this->setDescription ((!empty ($donnees['Description'])) ? $donnees['Description']:null);
        $this->setPrix ((!empty ($donnees['Prix'])) ? $donnees['Prix']:null);
        $this->setIdUser ((!empty ($donnees['IdUser'])) ? $donnees['IdUser']:null);
        $this->setIdCategory((!empty ($donnees['IdCategory'])) ? $donnees['IdCategory']:null);
    }
    
    
    public function toArray()
    {
        $arr= [
          'Id'=> $this->getId(),  
          'Nom'=> $this->getNom(),
          'Description'=> $this->getDescription(),
          'Prix'=> $this->getPrix(),
          'IdUser'=> $this->getIdUser(),
          'IdCategory'=> $this->getIdCategory(),
        ];
        //return get_object_vars($this);
        return ($arr);
        
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
    
    function getId() {
        return $this->Id;
    }

    function getNom() {
        return $this->Nom;
    }

    function getDescription() {
        return $this->Description;
    }

    function getPrix() {
        return $this->Prix;
    }

    
    function setId($id) {
        $this->Id = $id;
    }

    function setNom($nom) {
        $this->Nom = $nom;
    }

    function setDescription($description) {
        $this->Description = $description;
    }

    function setPrix($prix) {
        $this->Prix = $prix;
    }


    
    function getIdUser() {
        return $this->IdUser;
    }

    function getIdCategory() {
        return $this->IdCategory;
    }

    function getObjCategorie() {
        return $this->objCategorie;
    }

    function getObjUser() {
        return $this->objUser;
    }

    function getListeObjPhotos() {
        return $this->listeObjPhotos;
    }

    
    function setIdUser($idUser) {
        $this->IdUser = $idUser;
    }

    function setIdCategory($idCategory) {
        $this->IdCategory = $idCategory;
    }

    function setObjCategorie($objCategorie) {
        $this->objCategorie = $objCategorie;
    }

    function setObjUser($objUser) {
        $this->objUser = $objUser;
    }

    function setListeObjPhotos($listeObjPhotos) {
        $this->listeObjPhotos = $listeObjPhotos;
    }



    
    
}