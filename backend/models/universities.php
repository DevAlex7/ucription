<?php 

class University extends Validator{

    private $id;
    private $university;

    public function id($value){
        if($this->validateId($value)){
            $this->id = $value;
            return true;
        }   
        else{
            return false;
        }
    }
    public function SetInstitute($value){
        if($this->validateAlphabetic($value,2,80)){
            $this->university = $value;
            return true;
        }
        else{
            return false;
        }
    }
    
    public function all(){
        $sql='SELECT * FROM universities';
        $params = array(null);
        return Database::getRows($sql,$params);
    }
    public function create(){
        $sql='INSERT INTO universities VALUES (NULL,?)';
        $params=array($this->university);
        return Database::executeRow($sql,$params);
    }
    public function find(){
        $sql='SELECT * FROM universities WHERE id=?';
        $params = array($this->id);
        return Database::getRow($sql,$params);
    }
    public function edit(){
        $sql='UPDATE universities SET university=? WHERE id=?';
        $params = array($this->university, $this->id);
        return Database::executeRow($sql,$params);
    }
    public function delete(){
        $sql='DELETE FROM universities WHERE id=?';
        $params = array($this->id);
        return Database::executeRow($sql,$params);
    }
}