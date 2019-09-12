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
            case 'subjects':
                include 'api/subject_matter.php';
            break;
            case 'files':
                include 'api/files.php';
            break;
            default:
                exit('Ruta erronea');   
        }
    }
    else{
        exit('Error al conseguir el recurso');
    }
?>