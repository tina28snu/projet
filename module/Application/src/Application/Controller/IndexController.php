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


class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
        $annoncesTable = $this->getServiceLocator()->get("AnnonceTableCRUD"); 
        $annonces = $annoncesTable->getListeAnnonces();
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
        
        return new ViewModel(['listeAnnonces'=>$listeAnnonces, 'listeCategories'=>$categories, 'listePhotos'=>$photos, 'categoryParAnnonce'=>$categoryParAnnonce]);
    }
    
    
    
}
