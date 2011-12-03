<?php
require_once "includes.php";

class mainLogic{

    public $dbw = null;

    function __construct() {
        $this->dbw = new DbWrapper();
    }
    
	
	//update information 
	public function update($routeId, $stopId){
		//update the entry to the sightings table...
		$q = "INSERT INTO sightings (s_id, r_id) VALUES ('"+$stopId+"', '"+$routeId+"')";
		$res = $this->dbw->getQuery($q);
		$OK = null;
		if($res){
			//return success
			$OK = "Update Successful";
			return $OK;
		}
		else {
			//throw error
		}
				
	}
	
    
    //01. All the Getters
	
	//Throw the most recent info for a given stop and route
    public function getRouteInfoForStopId($routeId, $stopId){
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
	//get all the stops before the stop. Do not consider stops after this stop 
	/*$query = "SELECT s.sid from stops as s where s.sid < sid";	
	$previousStops = $this->dbw->getQuery($q);
	if($previousStops){
		while($row = mysql_fetch_assoc($previousStop)){
			
		}
		
	}*/
	
	//fetch the most recently updated time stamp for that route information and return the stop where it was seen
		$q = "SELECT * FROM sightings as s where timestamp = ( select max(timestamp) from sightings where r_id='"+$routeId"'";
		$res = $this->dbw->getQuery($q);
		
		$resultArray = array();
		if($res){
			$sid = $row["s_id"];
			$timestamp = $row["timestamp"];
			//got the timestamp and the sid for the most recent check in for the route.  
			array_push($resultArray, $sid, $timestamp);	
		}
		else {
			//throw error. 
		}
		return $resultArrray;
	}
	
	public function getRoutesAtStop($stopId){
		//get all the routes at a particular stop. 
		$q = "SELECT distinct(r_id) FROM stoplist where s_id = '"+$stopId+"'";
		$res = $this->dbw->getQuery($q);
		
		$rids = array();
		
		if($res){
			while($row = mysql_fetch_assoc($res)){
                array_push($rids,$row);
			}
				
		}else {
			//throw error
		}
		
		// cycle through each route Id 
		$result = array();
		//cycle through each routeID and call getRouteInfoForStop
		if($rids){
			foreach($rids as $routeId){
				$response = getRouteInfoForStopId($routeId, $stopId);
				array_push($result, $response);
			}
			
		} 
		else {
			//throw error 
		}
		
		return $result;
		
		
	}
	
	public function getRoutesNearMe($lat1, $long1){
	//get routes near me taking the gps location as coordinates
	//First step would be to find out the nearest stop with this lat long. 
		$stopDetail = getStopIdAndNameForLatLong($lat1, $long1);
		$stopName = array_pop($stopDetail);
		$stopId = array_pop($stopDetail);
		
		//now with the stop get routes next near this stop. 
		$rids = getRoutesAtStop($stopId);
		$result = array();
		//cycle through each routeID and call getRouteInfoForStop
		if($rids){
			foreach($rids as $routeId){
				$response = getRouteInfoForStopId($routeId, $stopId);
				array_push($result, $response);
			}
			
		} 
		else {
			//throw error 
		}
		
		return $result;

	}
	
	public function getRouteInfoNearMe($routeId, $lat1, $long1){
		//lat long received from client
		//get stop Id first. 
		$stopDetail = getStopIdAndNameForLatLong($lat1, $long1);
		$stopName = array_pop($stopDetail);
		$stopId = array_pop($stopDetail);
		
		//call specific method - reduced to feature phone
		return getRouteInfoForStopId($routeId, $stopId);
		
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
			$returnArray = array();
			
            if($res1){
                $row = mysql_fetch_assoc($res1)
                $id = $row["id"];
                $name = $row["name"];
				return array_push($returnArray, $id, $name);
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