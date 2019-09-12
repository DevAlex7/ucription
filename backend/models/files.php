<?php 
    class File extends Validator{
        private $id;
        private $id_user;
        private $id_subject_matter;
        private $id_university;
        private $status;

        public function id($value){
            if($this->validateId($value)){
                $this->id = $value;
                return true;
            }else{
                return false;
            }
        }

        public function id_user($value){
            if($this->validateId($value)){
                $this->id_user = $value;
                return true;
            }else{
                return false;
            }
        }
        
        public function id_subject_matter($value){
            if($this->validateId($value)){
                $this->id_subject_matter = $value;
                return true;
            }else{
                return false;
            }
        }

        public function id_university($value){
            if($this->validateId($value)){
                $this->id_university = $value;
                return true;
            }else{
                return false;
            }
        }

        public function status($value){
            if($this->validateId($value)){
                $this->status = $value;
                return true;
            }else{
                return false;
            }
        }

        public function all(){
            $sql = 'SELECT users.name, subject_matter.subject, universities.university, status_file.status, files.date 
                FROM ((files INNER JOIN users ON users.id = files.id_user) 
                INNER JOIN universities ON universities.id = files.id_university 
                INNER JOIN status_file ON status_file.id = files.status 
                INNER JOIN subject_matter ON subject_matter.id = files.id_subject_matter)';
            $params = array(null);
            return Database::getRows($sql,$params);
        }

        public function find(){
            $sql = 'SELECT users.name, subject_matter.subject, universities.university, status_file.status, files.date 
                FROM ((files INNER JOIN users ON users.id = files.id_user) 
                INNER JOIN universities ON universities.id = files.id_university 
                INNER JOIN status_file ON status_file.id = files.status 
                INNER JOIN subject_matter ON subject_matter.id = files.id_subject_matter) WHERE files.id=?';
            $params = array($this->id);
            return Database::getRow($sql,$params);
        }

        public function allFromUser(){
            $sql = 'SELECT users.name, subject_matter.subject, universities.university, status_file.status, files.date 
                FROM ((files INNER JOIN users ON users.id = files.id_user) 
                INNER JOIN universities ON universities.id = files.id_university 
                INNER JOIN status_file ON status_file.id = files.status 
                INNER JOIN subject_matter ON subject_matter.id = files.id_subject_matter) WHERE users.id=?';
            $params = array($this->id_user);
            return Database::getRows($sql,$params);
        }

        public function create(){
            $sql='INSERT INTO files VALUES (NULL, ?,?,?,?,?)';
            $params = array($this->id_user, $this->id_subject_matter, $this->id_university, date('Y-m-d'), $this->status);
            return Database::executeRow($sql,$params);
        }
        
        public function edit(){

        }

        public function delete(){
            $sql='DELETE FROM files WHERE id=?';
            $params = array($this->id);
            return Database::executeRow($sql,$params);
        }

        public function allFromStatus(){
            $sql = 'SELECT users.name, subject_matter.subject, universities.university, status_file.status, files.date 
                FROM ((files INNER JOIN users ON users.id = files.id_user) 
                INNER JOIN universities ON universities.id = files.id_university 
                INNER JOIN status_file ON status_file.id = files.status 
                INNER JOIN subject_matter ON subject_matter.id = files.id_subject_matter) WHERE status_file.id=?';
            $params = array($this->status);
            return Database::getRows($sql,$params);
        }
        

    }
?>