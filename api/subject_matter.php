<?php 
    require_once('backend/helpers/validator.php');
    require_once('backend/models/subjects.php');
    require_once('backend/instance/instance.php');
    
    $route = explode('/',$_GET['page']);

    $subject = new Subject();

    if( isset($_GET['page']) ){
        $result = array( 'status'=>0, 'error'=>'' );        
        if($_SERVER['REQUEST_METHOD']  == 'GET'){
            switch($route[1]){
                case '':
                if($result['data'] = $subject->all()){
                    $result['status'] = 200;
                }
                else{
                    $result['exception'] = [];
                }
            break;
            case $route[1] > 0:
                if($subject->id( $route[1] )){
                    if($result['data'] = $subject->find()){
                        $result['status'] = 200;
                    }
                    else{
                        $result['exception'] = [];
                    }
                }
                else{
                    $result['exception'] = 'No se identifico el indice';
                }
            break;
            default:
                exit('Recurso no disponible');
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            switch($route[1]){
                case 'create':
                    if($subject->SetSubject($_POST['subject'])){
                        if($subject->create()){
                            $result['status'] = 200;
                        }
                        else{
                            $result['exception'] = 'No se creo la materia';
                        }
                    }   
                    else{
                        $result['exception']='Nombre de materia invalido';
                    }        
                break;
                default:
                    exit('Recurso no disponible'); 
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){
            switch($route[1]){
                case 'edit':    
                if( isset($route[1]) ){
                    parse_str(file_get_contents("php://input"), $data);                                    
                    if($subject->id( $route[2] )){
                        if($subject->SetSubject($data['subject'])){
                            if($subject->edit()){
                                $result['status'] = 200;
                            }
                            else{
                                $result['exception'] = 'No se actualizó la materia';
                            }
                        }   
                        else{
                            $result['exception']='Nombre de materia invalido';
                        }        
                    }
                    else{
                        $result['exception'] = 'No se identifico el indice';
                    }
                }
                else{
                    $result['error'] ='Not found';
                }
                break;
            default:
                exit('Recurso no disponible'); 
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'DELETE' ){
            switch($route[1]){
                case 'delete':
                    if( isset($route[1]) ){
                        if($subject->id( $route[2] )){
                            if($result['data'] = $subject->delete()){
                                $result['status'] = 200;
                            }
                            else{
                                $result['exception']='No se pudo eliminar la materia';
                            }
                        }
                        else{
                            $result['exception'] = 'No se identifico el indice';
                        }
                    }
                    else{
                        $result['error'] ='Not found';
                    }
                break;
                default:
                    exit('Recurso no disponible'); 
            }
        }
        else{
            exit('Method not allowed');
        }
        print(json_encode($result));
    }
    else{
        exit('Petición rechazada');
    }
?>