<?php 

    $route = explode('/',$_GET['page']);
    //var_dump($route);
    if(isset($_GET['page'])){
        
        switch($route[0]){
            case 'users':  
                include 'api/users.php';        
            break;
            case 'university':
                include 'api/university.php';        
            break;
            default:
                exit('protocolo incorrecto');   
        }
    }
    else{
        exit('Error al conseguir el recurso');
    }
?>