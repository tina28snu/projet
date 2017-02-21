<?php

namespace Application\Model;


class PhotoTable
{
    private $tableGateway;

    public function __construct($tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }
    
    public function getListePhotos()
    {	
        $result = $this->tableGateway->select();
        return $result;
    }    
    
    public function insertPhotos($photo) 
    {
        $photoArray = $photo->toArray();
        $resultat = $this->tableGateway->insert($photoArray);
        return ($resultat);
    }
    
    public function getPremierePhotosParIdAnnonce($idAnnonce) {
        $rsPhoto = $this->tableGateway->select(array('IdAnnonce'=>$idAnnonce));
        return($rsPhoto->current()->getChemin());
    }
    
    public function getPhotosParIdAnnonce($idAnnonce) {
        $rsPhotos = $this->tableGateway->select(array('IdAnnonce'=>$idAnnonce));
        $photos = [];
        foreach ($rsPhotos as $photo) {
            $photos[] = $photo;
        }
        return($photos);
    }
    
    public function deletePhotoChemin($photo) {
        $cheminPhoto = $photo->getChemin();
        $resultat = $this->tableGateway->delete(array('Chemin'=>$cheminPhoto));
        return ($resultat);
    }
    
    
}
?>