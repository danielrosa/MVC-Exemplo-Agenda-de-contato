<?php
/**
* Arquivo de retorno de erros 
* Esse arquivo e responsavel por retornar de forma amigavel os erros ocorridos no sistema
* @author Daniel Rosa
* 
*/

class ValidationException extends Exception {
    
    private $errors = NULL;
    
    //objeto construtor 
    public function __construct($errors) {
        parent::__construct("Validation error!");
        $this->errors = $errors;
    }
    
    //retorna os erros do sistema
    public function getErrors() {
        return $this->errors;
    }
    
}

?>
