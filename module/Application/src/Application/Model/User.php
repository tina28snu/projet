<?php

namespace Application\Model;

class User 
{
    private $Id;
    private $Nom;
    private $Prenom;
    private $Email;
    private $Telephone;
    private $Adresse;
    private $Password;
    
    
    public function exchangeArray($donnees) {
        $this->setId ((!empty ($donnees['Id'])) ? $donnees['Id']:null);
        $this->setNom ((!empty ($donnees['Nom'])) ? $donnees['Nom']:null);
        $this->setPrenom ((!empty ($donnees['Prenom'])) ? $donnees['Prenom']:null);
        $this->setEmail ((!empty ($donnees['Email'])) ? $donnees['Email']:null);
        $this->setTelephone ((!empty ($donnees['Telephone'])) ? $donnees['Telephone']:null);
        $this->setAdresse ((!empty ($donnees['Adresse'])) ? $donnees['Adresse']:null);
        $this->setPassword ((!empty ($donnees['Password'])) ? $donnees['Password']:null);
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

    function getPrenom() {
        return $this->Prenom;
    }

    function getEmail() {
        return $this->Email;
    }

    function getTelephone() {
        return $this->Telephone;
    }

    function getAdresse() {
        return $this->Adresse;
    }

    function getPassword() {
        return $this->Password;
    }

    
    function setId($id) {
        $this->Id = $id;
    }

    function setNom($nom) {
        $this->Nom = $nom;
    }

    function setPrenom($prenom) {
        $this->Prenom = $prenom;
    }

    function setEmail($email) {
        $this->Email = $email;
    }

    function setTelephone($telephone) {
        $this->Telephone = $telephone;
    }

    function setAdresse($adresse) {
        $this->Adresse = $adresse;
    }

    function setPassword($password) {
        $this->Password = $password;
    }


    
    
}