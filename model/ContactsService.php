<?php
/**
* Arquivo de configuracao 
* Este arquivo e responsavel por criar e gerenciar todas as configuracoes do sistema
* @author Daniel Rosa
* 
*/
require_once 'model/ContactsGateway.php';
require_once 'model/ValidationException.php';


class ContactsService {
    
    private $contactsGateway    = NULL;
    
    //abre a conexao com o banco de dados 
    private function openDb() {
        if (!mysql_connect("localhost", "root", "")) {
            throw new Exception("Conexao com o banco nao foi efetuada con sucesso!");
        }
        if (!mysql_select_db("mvc-crud")) {
            throw new Exception("A tabela nao existe no banco de dados.");
        }
    }
    
    //fecha a conexao com o banco de dados
    private function closeDb() {
        mysql_close();
    }
  	
  	//objeto construtor
    public function __construct() {
        $this->contactsGateway = new ContactsGateway();
    }
    
    //seleciona todos os contatos do banco 
    public function getAllContacts($order) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    //seleciona um contato 
    public function getContact($id) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id);
    }
    
    //valida nomes 
    private function validateContactParams( $name, $phone, $email, $address ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Campo NOME e obrigatorio!';
        }
        if ( !isset($phone) || empty($phone) ) {
            $errors[] = 'Campo TELEFONE e obrigatorio!';
        }
        if ( !isset($address) || empty($address) ) {
            $errors[] = 'Campo ENDERECO e obrigatorio!';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    //cria novo contato 
    public function createNewContact( $name, $phone, $email, $address, $type_contact, $date ) {
        try {
            $this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->insert($name, $phone, $email, $address, $type_contact, $date);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    //edita contato
    public function editContacts( $id, $name, $phone, $email, $address, $type_contact, $date ) {
        try {
            $this->openDb();
            $this->validateContactParams($name, $phone, $email, $address);
            $res = $this->contactsGateway->update($id, $name, $phone, $email, $address, $type_contact, $date);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    //deleta campo de contato
    public function deleteContact( $id ) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->delete($id);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    //objetos do tipo
    //seleciona todos os tipos do banco 
    public function getAllType() {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectAllType();
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
     //seleciona um tipo de contato
    public function getType($id) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->selectByIdType($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
        return $this->contactsGateway->find($id);
    }
    
    //cria novo tipo 
    public function createNewType( $type, $description ) {
        try {
            $this->openDb();
            $this->validateType($type);
            $res = $this->contactsGateway->insertType($type, $description);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    //valida tipo 
    private function validatetype( $type ) {
        $errors = array();
        if ( !isset($type) || empty($type) ) {
            $errors[] = 'Campo TIPO e obrigatorio!';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    //deleta type
    public function deleteTypeD( $id ) {
        try {
            $this->openDb();
            $res = $this->contactsGateway->deleteTypeT($id);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
}

?>
