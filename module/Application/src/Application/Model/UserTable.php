<?php

namespace Application\Model;


class UserTable
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }
    
    public function getListeUsers()
    {	
        $result = $this->tableGateway->select();
        return $result;
    }    
    
    public function getUser($filtres = []) 
    {
        $donnees = $this->tableGateway->select($filtres); 
        $ligne= $donnees->current();
        return $ligne;
    }
    
    public function insertUser($user) 
    {
        $userArray = $user->toArray();
        $resultat = $this->tableGateway->insert($userArray);
        return ($resultat);
    }
    
    public function updateUser($user) 
    {
        $userArray = $user->toArray();
        $idUser = $user->getId();
        $resultat = $this->tableGateway->update($userArray,array('Id'=>$idUser));
        return ($resultat);
    }
    
    public function deleteUser($user) 
    {
        $idUser = $user->getId();
        $resultat = $this->tableGateway->delete(array('Id'=>$idUser));
        return ($resultat);
    }
    
 
}
?>