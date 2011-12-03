<?php

class DbWrapper {

    //PUBLIC FUNCTIONS
	function __construct() {
    
        $mysql_server = "localhost";
        $mysql_un = "root";
        $mysql_db = "rhokAtl";
        $mysql_pw = "";
    
       if(!isset($MYSQLConn)){
            // attempt to connect to the database server	
            if($MYSQLConn = mysql_connect( rtrim($mysql_server),rtrim($mysql_un),rtrim($mysql_pw) )) {
                //attempt to connect to the database - and check to see if connection failed
                if(!($sel = mysql_select_db(rtrim($mysql_db)))) 
                    //database connection failed		
                    die("ERROR:  COULD NOT CONNECT TO DATABASE"); 
            }else{
                // attempt to connect to the database server failed
                //alert that database server connection failed        
                die("ERROR: COULD NOT CONNECT TO DATABASE"); 
            }
        }   
    }

	function getQuery($q) {
		//Returns false OR $res
		$res = mysql_query($q);

		if (!$res) {
			$this->logErr("Failed executing database query: " . $q . " MySQL Error: " . mysql_error());
			return false;
		}
		$num_rows = mysql_num_rows($res);
		if ($num_rows >= 1) {
            return $res;
		} else {
			return false;
		}
	}

	function setQuery($q) {
		//Returns Integer
		$res = mysql_query($q);

		if (!$res) {
			$this->logErr("Failed executing database query: " . $q . " MySQL Error: " . mysql_error());
			return false;
		}
		return mysql_affected_rows();
	}

	function insQuery($q) {
		//Returns Integer (PK)
		$res = mysql_query($q);

		if (!$res) {
			$this->logErr("Failed executing database query: " . $q . " MySQL Error: " . mysql_error());
			return false;
		}
		return mysql_insert_id();
	}

	function escapeString($q) {
		return mysql_real_escape_string($q);
	}

	//PRIVATE FUNCTIONS
	private function logErr($message) {
		echo "DATABASE ERROR:  ".$message;
	}

}

?>