<?php
require_once "includes.php";

class mainLogic{

    public $dbw = null;

    function __construct() {
        $this->dbw = new DbWrapper();
    }
    
    
    //01. All the Getters
    public getRouteInfoForStopId($routeId, $stopId){
    /*  
    {
    "response": "<error code>",
    "data": [
        {
            "routeId": "<routeId>",
			"routeName": "<routeName>",
	     	"direction": "<direction>",
            "stopID": "<stopId>",
            "stopName": "<stopName>",
            "lastSeenStopName": "<lastStopName>",
            "lastSeenTime": "<timestamp of last seen value>"
        }
        
        
        
    ]
    }
    */
    
    
    
    }
    
    
    private function getStopIdAndNameForLatLong($lat1, $long1){
        $dist = PHP_INT_MAX
        $lat_min =0;
        $long_min =0;
        $q = "SELECT lat, long FROM stops";
        $res = $this->dbw->getQuery($q);
        if($res){
            while($row = mysql_fetch_assoc($res)){
                $lat2 = $row["lat"];
                $long2 = $row["long"];
                $d = $this->getDistanceBetnLatLong($lat1, $long1, $lat2, $long2) 
                //fetch the distance, if the distance isa less.. save it.
                if($d < $dist){
                    $dist = $d;
                    $lat_min = $lat2;
                    $long_min = $long2;
                }
            }
            $q = "SELECT id, name FROM stops WHERE lat = '"+$lat_min+"' AND long = '"+$long_min+"'";           
            $res1 = $this->dbw->getQuery($q);
            if($res1){
                $row = mysql_fetch_assoc($res1)
                $id = $row["id"];
                $name = $row["name"];
            }else{
                return false;
            }
        }else{
           return false;
        }
    }
    
    private function getDistanceBetnLatLong($lat1, $lng1, $lat2, $lng2, $miles = true){
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;
     
        $r = 6372.797; // mean radius of Earth in km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;
     
        return ($miles ? ($km * 0.621371192) : $km);
    }


    //02. All the Setters
    
    
}

?>