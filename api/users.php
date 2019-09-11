<?php 
    require_once('../backend/models/universities.php');
    require_once('../backend/instance/instance.php');

    $route = explode('/', $_GET['page']);
    
    if(isset($_GET['page'])){

        $result = array( 'status'=>0, 'error'=>'' );
        
        switch($route[1]){
            case '':

            break;
            case $route[1] > 0:
    
                print $route[1];    
    
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
        }        print(json_encode($result));
    }   
    else{
        exit('protocolo incorrecto');
    } 
    
?>