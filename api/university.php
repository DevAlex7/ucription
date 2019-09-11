<?php 
    require_once('backend/helpers/validator.php');
    require_once('backend/models/universities.php');
    require_once('backend/instance/instance.php');
    //$_SERVER['REQUEST_METHOD']='PUT';
    $route = explode('/',$_GET['page']);
    $university = new University();

    if(isset($_GET['page'])){
        $result = array( 'status'=>0, 'error'=>'' );

        if($_SERVER['REQUEST_METHOD']  == 'GET'){
            switch($route[1]){
                case '':
                if($result['data'] = $university->all()){
                    $result['status'] =200;
                }
                else{
                    $result['status'] = 404;
                    $result['data'] = [];
                }
            break;
            case $route[1] > 0:
                if($university->id( $route[1] )){
                    if($result['data'] = $university->find()){
                        $result['status'] = 200;
                    }
                    else{
                        $result['status'] = 404;
                        $result['data'] = [];
                    }
                }
                else{
                    $result['status'] = 0;
                }
    
            break;
            default:
                exit('Recurso no disponible');
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
            switch($route[1]){
                case 'create':
                    if($university->SetInstitute($_POST['university'])){
                        if($university->create()){
                            $result['status'] = 200;
                        }
                        else{
                            $result['status'] = 0;
                        }
                    }   
                    else{
                        $result['exception']='Nombre de universidad invalido';
                    } 
                break;
            }
        }
        else if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){
            switch($route[1]){
                case 'edit':    
                if( isset($route[1]) ){
                    parse_str(file_get_contents("php://input"), $data);                                    
                    if($university->id($route[2])){
                        if($university->SetInstitute($data['university'])){
                            if($university->edit()){
                                $result['status'] = 200;
                            }
                            else{
                                $result['status'] = 0;
                            }
                        }   
                        else{
                            $result['exception']='Nombre de universidad invalido';
                        } 
                    }
                    else{
                        $result['exception']='Marcador invalido';
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
                        if($university->id($route[2])){
                            if($university->delete()){
                                $result['status'] = 200;
                            }
                            else{
                                $result['status'] = 0;
                            }
                        }
                        else{
                            $result['Marcador invalido'];
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
        exit('protocolo incorrecto');
    } 
    
?>