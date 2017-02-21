<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Annonce;
use Application\Model\Photo;
use DateTime;

class AnnonceController extends AbstractActionController
{
    public function indexAction()
    {
        session_start();
        $annoncesTable = $this->getServiceLocator()->get("AnnonceTableCRUD"); 
        $annonces = $annoncesTable->getAnnonces(['IdUser' => $_SESSION['user']['Id']]);
        $listeAnnonces = [];
        
        foreach ($annonces as $objAnnonce){ $listeAnnonces[] = $objAnnonce;}
        
        $categoriesTable = $this->getServiceLocator()->get("CategoryTableCRUD");
        $categories = $categoriesTable->getListeCategories();
        $categoryParAnnonce = [];
        
        $photosTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        $photos = [];
        
        foreach ($listeAnnonces as $annonce) {
            $idAnnonce = $annonce->getId();
            $photos[] = $photosTable->getPremierePhotosParIdAnnonce($idAnnonce);
        }
        
        foreach ($listeAnnonces as $annonce) {
            $idCategory = $annonce->getIdCategory();
            $categoryParAnnonce[] = $categoriesTable->getCategoryParId($idCategory);
        }
        
        return new ViewModel(['mesAnnonces'=>$listeAnnonces, 'listeCategories'=>$categories, 'listePhotos'=>$photos, 'categoryParAnnonce'=>$categoryParAnnonce]);
    }
    
    public function creerAction() {
       
        $categoriesTable = $this->getServiceLocator()->get("CategoryTableCRUD");
        $categories = $categoriesTable->getListeCategories();
        
        return new ViewModel(['listeCategories'=>$categories]);
    }
    
    public function ajouterAction() {      
        session_start();
        $annonce = new Annonce(['Nom'=>$this->getRequest()->getPost('nom'), 'Description'=>$this->getRequest()->getPost('description'),
                                'Prix'=>$this->getRequest()->getPost('prix'), 'IdCategory'=>$this->getRequest()->getPost('categories'), 'IdUser'=>$_SESSION['user']['Id']]);
        $annonceTable = $this->getServiceLocator()->get("AnnonceTableCRUD");
        
        if ($annonceTable->insertAnnonce($annonce)) { $msg = "Annonce ajoutée!";
        } else {$msg = "Error! Veuillez re-essayer! Merci!";}
        
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        
        $now = new DateTime();
        $now->format('Y-m-d H:i:s');
        $uploadDir = 'public/images/';
        for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
            $uploadFileBD = basename ($now->getTimestamp() . $_FILES['photo']['name'][$i]);
            $uploadFileDisk = $uploadDir.$uploadFileBD;
            $IdAnnonce = $annonceTable->getLastID();
            
            if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $uploadFileDisk)){
                $photo = new Photo (['Chemin'=>$uploadFileBD, 'IdAnnonce'=>$IdAnnonce]);
                $photoTable->insertPhotos($photo);
            }
        }
        return new ViewModel(['msg'=>$msg]);
    }
    
    public function effacerAction() {
        $id = (int)$this->params()->fromRoute("id",null);
        
        $annonceTable = $this->getServiceLocator()->get("annonceTableCRUD");
        $annonce = $annonceTable->getAnnonceParId(['Id'=>$id]);
        
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        $photosDelete = $photoTable->getPhotosParIdAnnonce($annonce->getId());
        
        foreach ($photosDelete as $photo) {
            $cheminPhoto = 'public/images/' . $photo->getChemin();
            if (is_file ($cheminPhoto)) {
                unlink($cheminPhoto);
            }
            $photoTable->deletePhoto($photo);
        }
        
        $annonceTable->deleteAnnonce($annonce);
        
        return new ViewModel();
    }
    
    public function afficherAction() {
        $idAnnonce = (int)$this->params()->fromRoute("id",null);
        $annoncesTable = $this->getServiceLocator()->get("AnnonceTableCRUD"); 
        $annonce = $annoncesTable->getAnnonceParId(['Id' => $idAnnonce]);
        
        $userTable = $this->getServiceLocator()->get("UserTableCRUD"); 
        $user = $userTable->getUser(['Id' => $annonce->getIdUser()]);
        
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        
        $photos = $photoTable->getPhotosParIdAnnonce($annonce->getId());
        
        return new ViewModel(['annonce'=>$annonce, 'user'=>$user, 'photos'=>$photos]);
    }
    
    public function parCategAction() {
        $idCateg = (int)$this->params()->fromRoute("id",null);
        $annoncesTable = $this->getServiceLocator()->get("AnnonceTableCRUD"); 
        $annonces = $annoncesTable->getAnnonces(['IdCategory' => $idCateg]);
        $listeAnnonces = [];
        foreach($annonces as $annonce) { $listeAnnonces[] = $annonce; }
        
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        $photos = [];
        foreach ($listeAnnonces as $annonce) {
            $photos[] = $photoTable->getPremierePhotosParIdAnnonce($annonce->getId());
        }
                
        return new ViewModel(['listeAnnonces'=>$listeAnnonces, 'listePhotos'=>$photos, 'idCateg'=>$idCateg]);
    }
    
    public function modifierAction() {
        $idAnnonce = (int)$this->params()->fromRoute("id",null);
        
        $annonceTable = $this->getServiceLocator()->get("annonceTableCRUD");
        $annonce = $annonceTable->getAnnonceParId(['Id'=>$idAnnonce]);
        
        $categoriesTable = $this->getServiceLocator()->get("CategoryTableCRUD");
        $categories = $categoriesTable->getListeCategories();
        
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        $photos = $photoTable->getPhotosParIdAnnonce($idAnnonce);
        
        return new ViewModel(["annonce"=>$annonce, 'listeCategories'=>$categories, 'photos'=>$photos]);
    }
    
    public function updateAction() { 
        $check = false;
        session_start();
        $annonce = new Annonce(['Id'=>(int)$this->params()->fromRoute("id",null), 'Nom'=>$this->getRequest()->getPost('nom'), 'Description'=>$this->getRequest()->getPost('description'),
                                'Prix'=>$this->getRequest()->getPost('prix'), 'IdCategory'=>$this->getRequest()->getPost('categories'), 'IdUser'=>$_SESSION['user']['Id']]);
        $annonceTable = $this->getServiceLocator()->get("AnnonceTableCRUD");
        
        if ($annonceTable->updateAnnonce($annonce)) { $check = true;}
        
        //effacer photo(s)
        $photoTable = $this->getServiceLocator()->get("PhotoTableCRUD");
        $listePhotos = $photoTable->getPhotosParIdAnnonce($annonce->getId());
        $photos = [];
        foreach ($listePhotos as $photo) { $photos[] = $photo;}
        
        $images= $this->getRequest()->getPost('images');
        if (isset($images)){
            foreach ($images as $image){
                if (substr($image,0,1) == "r"){
                    $image= substr ($image,1,strlen($image)-1);
                    $cheminPhoto = 'public/images/'.$image; 
                    if (is_file($cheminPhoto)) { unlink($cheminPhoto);}
                    $objPhoto= new Photo(['Chemin'=>$image]);
                    if ($photoTable->deletePhotoChemin($objPhoto)) { $check = true;} 
                }
            }
        }
        
        //ajouter photo(s)
        if (!empty($_FILES['photo']['name'][0])){
            $now = new DateTime();
            $now->format('Y-m-d H:i:s');
            $uploadDir = 'public/images/';
            for ($i = 0; $i < count($_FILES['photo']['name']); $i++) {
                $uploadFileBD = basename ($now->getTimestamp() . $_FILES['photo']['name'][$i]);
                $uploadFileDisk = $uploadDir.$uploadFileBD;
                $IdAnnonce = $annonce->getID();

                if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $uploadFileDisk)){
                    $photo = new Photo (['Chemin'=>$uploadFileBD, 'IdAnnonce'=>$IdAnnonce]);
                    if ($photoTable->insertPhotos($photo)) { $check = true;}
                }
            }
        }
        if ($check) { $msg = "Annonce modifiée";} else { $msg = "Error! Veuillez re-essayer! Merci!";}
        
        return new ViewModel(['msg'=>$msg]);
    }
    
}
