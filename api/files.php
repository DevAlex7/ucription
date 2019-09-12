<?php 
    require_once('backend/helpers/validator.php');
    require_once('backend/models/files.php');
    require_once('backend/instance/instance.php');

    $route = explode('/',$_GET['page']);
    $file = new File();
    if( isset($_GET['page']) ){
        $result = array( 'status'=>0, 'error'=>'' );        
        if($_SERVER['REQUEST_METHOD']  == 'GET'){
            switch($route[1]){
                case '':
                if($result['data'] = $file->all()){
                    $result['status'] = 200;
                }
                else{
                    $result['exception'] = [];
                }
            break;
            case $route[1] > 0:
                if($file->id( $route[1] )){
                    if($result['data'] = $file->find()){
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
            case 'findByUser':
                if( isset($route[1] )){
                    if($file->id_user($route[2])){
                        if($result['data'] = $file->allFromUser()){
                            $result['status']=200;
                        }
                        else{
                            $result['exception']='El estudiante no contiene ninguna ficha';
                        }
                    }
                    else{
                        $result['exception']='Indice invalido';
                    }
                }
                else{
                    $result['exception']='Not found';
                }
            break;
            default:
                exit('Recurso no disponible');
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            switch($route[1]){
                case 'create':
                    if($file->id_user($_POST['id_user'])){
                        if($file->id_subject_matter($_POST['id_subject_matter'])){
                            if($file->id_university($_POST['id_university'])){
                                if($file->status($_POST['status'])){
                                    if($file->create()){
                                        $result['status'] = 200;
                                    }
                                    else{
                                        $result['exception']='No se creo la solicitud';
                                    }
                                }
                                else{
                                    $result['exception']='Estado de solicitud no definido';
                                }
                            }
                            else{
                                $result['exception']='Indice de institución no definido';        
                            }
                        }
                        else{
                            $result['exception']='Indice de materia no definido';    
                        }
                    }
                    else{
                        $result['exception']='Indice de usuario no definido';
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