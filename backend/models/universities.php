<?php 

class University extends Validator{

    private $id;
    private $university;

    public function id($value){
        if($this->ValidateInt($value)){
            $this->id = $value;
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
    public function find(){
        $sql='SELECT * FROM universities WHERE id=?';
        $params = array($this->id);
        return Database::getRow($sql,$params);
    }
}