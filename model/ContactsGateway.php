<?php

/**
 * Arquivo gateway
 * Este arquivo e responsavel por criar todas as strings de comunicao com o banco de dados
 * @author Daniel Rosa
 * 
 */
class ContactsGateway {
    
    //objetos contato
    //objeto de listagem de todos os dados do banco
    public function selectAll($order) {
        if ( !isset($order) ) {
            $order = "name";
        }
        $dbOrder =  mysql_real_escape_string($order);
        $dbres = mysql_query("SELECT * FROM contacts c INNER JOIN type t WHERE c.id_type = t.id_type ORDER BY $dbOrder ASC");
        
        $contacts = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $contacts[] = $obj;
        }
        return $contacts;
    }
    
    //objeto de busca por ID
    public function selectById($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM contacts c INNER JOIN type t WHERE c.id_type = t.id_type AND id=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }
    
    //objeto inserir
    public function insert( $name, $phone, $email, $address, $type_contact, $date ) {
        
        $dbName = ($name != NULL)?"'".mysql_real_escape_string($name)."'":'NULL';
        $dbPhone = ($phone != NULL)?"'".mysql_real_escape_string($phone)."'":'NULL';
        $dbEmail = ($email != NULL)?"'".mysql_real_escape_string($email)."'":'NULL';
        $dbAddress = ($address != NULL)?"'".mysql_real_escape_string($address)."'":'NULL';
        $type_contact = ($type_contact != NULL)?"'".mysql_real_escape_string($type_contact)."'":'NULL';
        $date = ($date != NULL)?"'".mysql_real_escape_string($date)."'":'NULL';
        
        mysql_query("INSERT INTO contacts (name, phone, email, address, id_type, date) VALUES ($dbName, $dbPhone, $dbEmail, $dbAddress, $type_contact, $date)");
        return mysql_insert_id();
    }
    
    public function update( $id, $name, $phone, $email, $address, $type_contact, $date) {
        
        $dbName = $name; 
        $dbPhone = $phone;
        $dbEmail = $email;
        $dbAddress = $address;
        $dbtype_contact = $type_contact;
        $dbdate = $date;
        
        $dbId = mysql_real_escape_string($id);
        mysql_query("UPDATE contacts SET  
			         name = '$dbName', 
			         phone = '$dbPhone', 
			         email = '$dbEmail', 
			         address = '$dbAddress', 
			         id_type = '$dbtype_contact', 
			         date = '$dbdate' 
			        WHERE id = $dbId");
        return mysql_insert_id();
    }
    
    //objeto deletar
    public function delete($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM contacts WHERE id=$dbId");
    } 
    
    
    
    // +|+|+|+|+|+|++|+|+|+|+|+|+|+|+|+|+|+|+|+|+|+|+//
    
    //objeto tipo
    //objeto de listagem de todos os tipos dados do banco
    public function selectAllType() {
        $dbres = mysql_query("SELECT * FROM type");
        
        $types = array();
        while ( ($obj = mysql_fetch_object($dbres)) != NULL ) {
            $types[] = $obj;
        }
        return $types;
    }
    
     //objeto inserir tipo
    public function insertType($type, $description) {
        
        $dbType = ($type != NULL)?"'".mysql_real_escape_string($type)."'":'NULL';
        $dbDescription = ($description != NULL)?"'".mysql_real_escape_string($description)."'":'NULL';
        
        mysql_query("INSERT INTO type (type_contact, description) VALUES ($dbType, $dbDescription)");
        return mysql_insert_id();
    }
    
    //objeto de busca por ID
    public function selectByIdType($id) {
        $dbId = mysql_real_escape_string($id);
        
        $dbres = mysql_query("SELECT * FROM type WHERE id_type=$dbId");
        
        return mysql_fetch_object($dbres);
		
    }
    
    //deletetype
    public function deleteTypeT($id) {
        $dbId = mysql_real_escape_string($id);
        mysql_query("DELETE FROM type WHERE id_type=$dbId");
    }
}

?>
