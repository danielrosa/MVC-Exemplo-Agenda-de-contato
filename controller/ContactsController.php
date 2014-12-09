<?php
/**
 * 
 * @author Daniel Rosa
 * 
 */
require_once 'model/ContactsService.php';

class ContactsController {
    
    private $contactsService = NULL;
    
    //objeeto construtor
    public function __construct() {
        $this->contactsService = new ContactsService();
    }
    
    //objeto de redirecionamento de pagina
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    //Objeto manipulador
    public function handleRequest() {
        $op = isset($_GET['op'])?$_GET['op']:NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listContacts();
            } elseif ( $op == 'new' ) {
                $this->saveContact();
            } elseif ( $op == 'delete' ) {
                $this->deleteContact();
            } elseif ( $op == 'show' ) {
                $this->showContact();
            } elseif ( $op == 'edit' ) {
                $this->editContact();
            } elseif ( $op == 'newtype' ) {
                $this->saveType();
            } elseif ( $op == 'deleteType' ) {
                $this->deleteType();
            } else {
                $this->showError("Pagina nao encontrada! :( ", "A pagina: ".$op." nao foi encontrada!");
            }
        } catch ( Exception $e ) {
            //erros desconhcidos da aplicacao sao esxibidos aqui
            $this->showError("Erro desconhecido: ", $e->getMessage());
        }
    }
    
    //objeto linstar
    public function listContacts() {
        $orderby = isset($_GET['orderby'])?$_GET['orderby']:NULL;
        $contacts = $this->contactsService->getAllContacts($orderby);
        
        include 'view/contacts.php';
    }
    
    //objeto linstar tipo
    public function listType() {
        $contacts = $this->contactsService->getAllType();
        include 'view/type-form.php';
    }
    
    //objeto salvar 
    public function saveContact() {
       
        $title = 'Add Novo Contato';
        
        $name = '';
        $phone = '';
        $email = '';
        $address = '';
        $type_contact = '';
        $date = '';
       	$types = $this->contactsService->getAllType();
       	
        $errors = array();
        
        if ( isset($_POST['form-submitted']) ) {
            
            $name       	 = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $phone      	 = isset($_POST['phone'])?   $_POST['phone'] :NULL;
            $email      	 = isset($_POST['email'])?   $_POST['email'] :NULL;
            $address    	 = isset($_POST['address'])? $_POST['address'] :NULL;
            $type_contact    = isset($_POST['type_contact'])? $_POST['type_contact']:NULL;
            $date   		 = isset($_POST['date'])? $_POST['date']:NULL;
            
            try {
                $this->contactsService->createNewContact($name, $phone, $email, $address, $type_contact, $date);
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/contact-form.php';
    }
    
    //objeto salvar 
    public function saveType() {
       
        $title = 'Add Novo Tipo';
        
        $type = '';
        $errors = array();
        
        if ( isset($_POST['form-submitted']) ) {
            $type        = isset($_POST['type']) ?   $_POST['type']  :NULL;
            $description = isset($_POST['description']) ?   $_POST['description']  :NULL;
            
            try {
                $this->contactsService->createNewType($type, $description);
                $this->redirect('http://localhost/trab_eduardo_mvc/index.php?op=newtype');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        $types = $this->contactsService->getAllType();
        include 'view/type-form.php';
    }
    
    //objeto editar 
    public function editContact() {
       	$title = 'Editar Contato';
       	
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Erro interno.');
        }
        
        $types = $this->contactsService->getAllType();
 		$contact = $this->contactsService->getContact($id);
 		
        $name = $contact->name;
        $phone = $contact->phone;
        $email = $contact->email;
        $address = $contact->address;
        $date = $contact->date;
       
        $errors = array();
        
        if ( isset($_POST['form-submitted']) ) {
            
            $name       = isset($_POST['name']) ?   $_POST['name']  :NULL;
            $phone      = isset($_POST['phone'])?   $_POST['phone'] :NULL;
            $email      = isset($_POST['email'])?   $_POST['email'] :NULL;
            $address    = isset($_POST['address'])? $_POST['address']:NULL;
            $date    	= isset($_POST['date'])? 	$_POST['date']:NULL;
            $type_contact  = isset($_POST['type_contact'])? $_POST['type_contact']:NULL;
            
            try {
                $this->contactsService->editContacts($id, $name, $phone, $email, $address, $type_contact, $date );
                $this->redirect('index.php');
                return;
            } catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        include 'view/contact-form.php';
    }
    
    //objeto deletar
    public function deleteContact() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Erro interno.');
        }
        
        $this->contactsService->deleteContact($id);
        
        $this->redirect('index.php');
    }
    
    //objeto exibir 
    public function showContact() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Erro interno.');
        }
        $contact = $this->contactsService->getContact($id);
        
       	$date = explode("-", $contact->date);
        $today = explode("-", date('Y-m-d'));
      	
      	if(($date[1] == $today[1]) AND ($date[2] == $today[2])){
			$msg = 'Esta pessoa esta fazendo aniversario hoje!';
		}else{
			$msg = '';
		}
        
        
        include 'view/contact.php';
    }
    
    //objeto exibir tipo
    public function showType() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Erro interno.');
        }
        $contact = $this->contactsService->getAllType($id);
    }
    
    //objeto exibi erros
    public function showError($title, $message) {
        include 'view/error.php';
    }
    
    //delete tipo
    public function deleteType() {
        $id = isset($_GET['id'])?$_GET['id']:NULL;
        if ( !$id ) {
            throw new Exception('Erro interno.');
        }
        
        $this->contactsService->deleteTypeD($id);
        
        $this->redirect('http://localhost/trab_eduardo_mvc/index.php?op=newtype');
    }
}
?>
