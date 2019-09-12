<?php 
    class Subject extends Validator {
        private $id;
        private $subject;

        public function id($value){
            if($this->validateId($value)){
                $this->id = $value;
                return true;
            }
            else{
                return false;
            }
        }
        public function SetSubject($value){
            if($this->validateAlphabetic($value,2,70)){
                $this->subject = $value;
                return true;
            }
            else{
                return false;
            }
        }

        public function all(){
            $sql='SELECT * FROM subject_matter';
            $params = array(null);
            return Database::getRows($sql,$params);
        }
        public function find(){
            $sql='SELECT * FROM subject_matter WHERE id=?';
            $params = array($this->id);
            return Database::getRow($sql,$params);
        }
        public function create(){
            $sql='INSERT INTO subject_matter VALUES (NULL, ?)';
            $params = array($this->subject);
            return Database::executeRow($sql,$params); 
        }
        public function edit(){
            $sql = 'UPDATE subject_matter SET subject=? WHERE id=?';
            $params = array($this->subject, $this->id);
            return Database::executeRow($sql,$params);
        }
        public function delete(){
            $sql ='DELETE FROM subject_matter WHERE id=?';
            $params = array($this->id);
            return Database::executeRow($sql,$params);
        }
    }
?>