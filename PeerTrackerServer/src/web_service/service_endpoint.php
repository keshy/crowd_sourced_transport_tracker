<?php

require_once 'service_backend.php';

$main = new mainLogic();

if(isset($_POST['api_method'])) {
    switch($_POST['api_method']) {

        //http://<serverName>:<port>/service_endpoint?api_method=update&route_id=x&stop_id=y&gpsLocation=z

        case 'getRouteInfoAtStop':
        
            $res = $main->getRouteInfoAtStop($_POST['route_id'], $_POST['stop_id']);
        
            echo json_encode($res);
            break;
        case 'getAllRoutesAtStop':
        
            $res = $main->getAllRoutesAtStop($_POST['stop_id']);
        
            echo json_encode($res);
            break;
            
        case 'getAllRoutesNearMe':
        
            $res = $main->getAllRoutesNearMe($_POST['lat'], $_POST['lng']);
        
            echo json_encode($res);
            break;        

        case 'getRouteInfoNearMe':
        
            $res = $main->getRouteInfoNearMe($_POST['route_id'],$_POST['lat'], $_POST['lng']);
        
            echo json_encode($res);
            break;

        case 'update':
        
            $res = $main->update($_POST['route_id'], $_POST['stop_id']);
        
            echo json_encode($res);
            break;            

    }
}    
    
?>