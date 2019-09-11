<?php 
    require_once('backend/helpers/validator.php');
    require_once('backend/models/universities.php');
    require_once('backend/instance/instance.php');
    
    $route = explode('/',$_GET['page']);
    $university = new University();

    if(isset($_GET['page'])){
        $result = array( 'status'=>0, 'error'=>'' );
        switch($route[1]){
            case '':
                if($result['data'] = $university->all()){
                    $result['status'] =200;
                }
                else{
                    $result['status'] =404;
                    //http_response_code(404);
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
                        //http_response_code(404);
                        $result['data'] = [];
                    }
                }
                else{
                    $result['status'] = 0;
                }
    
            break;
            case 'edit':    
                if( isset($route[1]) ){
    
                    print $route[2];
                }
                else{
                    print 'Petición no definida';
                }
            break;
            case 'delete':
                if( isset($route[1]) ){
                    print $route[2];
                }
                else{
                    print 'Petición no definida';
                }
            break;
            default:
            exit('protocolo incorrecto');
        }        
        print(json_encode($result));
    }   
    else{
        exit('protocolo incorrecto');
    } 
    
?>