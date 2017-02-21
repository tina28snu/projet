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
use Application\Model\User;

class UserController extends AbstractActionController
{
    public function indexAction()
    {
        
    }
    
    public function connexionAction() 
    {
        $email = $this->getRequest()->getPost('email');
        $password = $this->getRequest()->getPost('password');
        
        $userTable = $this->getServiceLocator()->get("UserTableCRUD");
        $user = $userTable->getUser(['Email'=>$email]);
        
        if (password_verify($password,$user->getPassword())) {
            session_start();
            $_SESSION['user']=$user->toArray();
            return new ViewModel();
        }
        else {
            return new ViewModel(["msg"=>"Connexion échouée! Veuillez vérifier votre email et votre mot de passe et re-essayer! Merci"]);
        }
    }
    
    public function inscriptionAction() 
    {      
        $userTable = $this->getServiceLocator()->get("UserTableCRUD");
        $check = $userTable->getUser(['Email' => $this->getRequest()->getPost('email')]);

        if (is_object($check)) {
            return new ViewModel(["msg"=>"Il y a deja un utilisateur avec cette email adresse!"]);
        }
        else {
            $passFormulaire = $this->getRequest()->getPost('password');
            $passwordHash = password_hash($passFormulaire, PASSWORD_DEFAULT, ['cost'=>12]);
            
            $user = new User(['Nom'=>$this->getRequest()->getPost('nom'), 'Prenom'=>$this->getRequest()->getPost('prenom'), 'Email'=>$this->getRequest()->getPost('email'),
                              'Telephone'=>$this->getRequest()->getPost('telephone'), 'Adresse'=>$this->getRequest()->getPost('adresse'), 'Password'=>$passwordHash]);

            if ($userTable->insertUser($user)) {
                $msg = "Merci pour votre inscription. Bienvenue sur le site!";
                session_start();
                $_SESSION['user']=$user->toArray();
            }
            else {
                $msg = "Error! Veuillez re-essayer! Merci!";
            }
            
            
            return new ViewModel(["msg"=>$msg]);
        }
    }
    
    public function profilAction() {
        session_start();
        $userTable = $this->getServiceLocator()->get("UserTableCRUD");
        $user = $userTable->getUser(['Id'=>$_SESSION['user']['Id']]);
        return new ViewModel(['user'=> $user]);
    }
    
    public function deconnectAction() {
        session_start();
        session_destroy();
        return new ViewModel();
    }
    
    public function updateAction() {
        session_start();
        if ($this->getRequest()->getPost('password') != "") {
            $passwordHash = password_hash($this->getRequest()->getPost('password'), PASSWORD_DEFAULT, ['cost'=>12]);
        } else { $passwordHash = $_SESSION['user']['Password'];}
        if ($this->getRequest()->getPost('email') != "") {
           $email = $this->getRequest()->getPost('email');
        } else {$email = $_SESSION['user']['Email'];}
        if ($this->getRequest()->getPost('telephone') != null) {
           $phone = $this->getRequest()->getPost('telephone');
        } else {$phone = $_SESSION['user']['Telephone'];}
        if ($this->getRequest()->getPost('adresse') != "") {
           $adresse = $this->getRequest()->getPost('adresse');
        } else {$adresse = $_SESSION['user']['Adresse'];}
        
        $userTable = $this->getServiceLocator()->get("UserTableCRUD");
        $user = new User(['Id'=>$_SESSION['user']['Id'], 'Nom'=>$_SESSION['user']['Nom'], 'Prenom'=>$_SESSION['user']['Prenom'], 'Email'=>$email,'Telephone'=>$phone, 
                          'Adresse'=>$adresse, 'Password'=>$passwordHash]);
        
        if ($userTable->updateUser($user)) {
            $msg = "Vos données ont été changées!";
        } else { $msg = "Error! Veuillez re-essayer! Merci!";}
            
        return new ViewModel(["msg"=>$msg]);
    }
    
    public function contacterAction () {
        $idUser = (int)$this->params()->fromRoute("id",null);
        return new ViewModel(['idUser'=>$idUser]);
    }
    
    public function sendAction() {
        $idUser = (int)$this->params()->fromRoute("id",null);
        $userTable = $this->getServiceLocator()->get("UserTableCRUD");
        $user = $userTable->getUser(['Id'=>$idUser]);
        
        $to      = $user->getEmail();
        $subject = 'Nouveau message';
        $message = $this->getRequest()->getPost('message') . $this->getRequest()->getPost('nom') . $this->getRequest()->getPost('email') . $this->getRequest()->getPost('telephone');
        $headers = 'From: ' . $this->getRequest()->getPost('nom') . "\r\n" .
            'Reply-To: ' . $this->getRequest()->getPost('email') . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $msg = "Message envoyé!";
        } else { $msg = "Error! Veuillez re-essayer! Merci!";}
        
        return new ViewModel(['msg'=>$msg]);
    }
    
    
}
