<?php

require_once 'class_mainlogic.php';

class SmsManager{
    
    $ml = null;
    
    function __construct() {
        $this->ml = new MainLogic();
    }
        
    //High level SMS processing function
    public function processSmsRequest($body){
    
        //01. Parse SMS
        $cmd = explode("#",$body);
        if($cmd[0] == "UP"){
            $sid = $cmd[1];
            $rid = $cmd[2];
            $obj = $this->ml->update($rid, $sid);
            return $obj;
        }else if($cmd[0] == "INFO"){
            $sid = $cmd[1];
            $rid = $cmd[2];
            $obj = $this->ml->getRouteInfoAtStop($rid, $sid);
            return $this->renderINFO($obj);
        }else if($cmd[0] == "ALL"){
            $sid = $cmd[1];
            $obj = $this->ml->getAllRoutesAtStop($sid);
            return $this->renderALL($obj);
        }
    }
    
    function renderINFO($obj){
        if(!$obj){
            //False
            return "Can not process your request at this time. [01]";
        }
        //Process the Array
        $timeStamp = array_pop($obj);
		$sname = array_pop($obj);
        $routeId = array_pop($obj);
        $str = "Route#: "+$routeId+" left :"+$sname +" at "+$timeStamp+"\n";
        return $str;
    }
    
    function renderALL($obj){
        if(!$obj){
            //False
            return "Can not process your request at this time. [02]";
        }
        $str = ""; 
        foreach($obj as $element){
            $timestamp = array_pop($element);
            $sname = array_pop($element);
            $routeId = array_pop($element);
            $str += "Route#: "+$routeId+" left :"+$sname +" at "+$timeStamp+"\n";
        }
        return $str;
    }
    
}

?>