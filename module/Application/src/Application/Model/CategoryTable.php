<?php

namespace Application\Model;


class CategoryTable
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }
    
    public function getListeCategories()
    {	
        $result = $this->tableGateway->select();
        return $result;
    }    
    
    public function getCategoryParId($id){
        $rsCategorie=$this->tableGateway->select(array('Id'=>$id));
        return($rsCategorie->current()->getNom());
     } 
    

}