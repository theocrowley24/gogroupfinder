<?php
//Written by Theo Crowley
//http://theocrowley.com/


//Database class
//Handles connecting, updating, deleting etc
class EventDatabase {

	private static $conn;

    //Connects to the database
    public static function databaseConnect(){

		//Database params
		//Insert your own here
		$servername = "";
        $username = "";
        $password = "";
        $dbname = "";

        // Create connection
        self::$conn = new mysqli($servername, $username, $password, $dbname);
        
	    // Check connection
	    if (self::$conn->connect_error) {
		    die("Connection failed: " . self::$conn->connect_error);
        }
	}
	
	
	//Inserts the event info into the database
	public static function createEvent($location, $eventTime, $raidBoss, $city, $additionalNotes){

		//Gets the unix timestamp
		$unix = time();

		//Sql query
		$sql = "INSERT INTO raids (idRaids, Location, Time, RaidBoss, NumberAttending, City, unix, AdditionalNotes) VALUES (DEFAULT, '$location', '$eventTime', '$raidBoss', 0, '$city', '$unix', '$additionalNotes')"; 
		
		//Checks if record was created successfully
		//Comment out to disable
		if (self::$conn->query($sql) === TRUE) {
			//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . self::$conn->error;
		}
		
		//Closes database connection
		self::$conn->close();
	}

    //Searches the database and returns data
    public static function databaseSearch($searchCity){
        
		//MySQL query
		//If the user has not searched for town/city all events are displayed
        if ($searchCity == null){
            $sql = "SELECT idRaids, Location, Time, RaidBoss, NumberAttending, City, AdditionalNotes FROM raids";
        } else{
            $sql = "SELECT idRaids, Location, Time, RaidBoss, NumberAttending, City, AdditionalNotes FROM raids WHERE City = '$searchCity'";
        }

        return self::$conn->query($sql);
    }

    //Updates NumberAttending if going is pressed
    public static function going($raidID){

		//Gets the users IP address 
		if(!empty($_SERVER['HTTP_CLIENT_IP'])){
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		  }
		  elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		  else{
			$ip=$_SERVER['REMOTE_ADDR'];
		  }

		$sql = "INSERT INTO users (idUsers, idRaids, users_ip) VALUES (NULL, '$raidID', '$ip')"; 

		if (self::$conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . self::$conn->error;
		}
		
        self::FindNumberAttending($raidID);
    }
	
	//Finds how many people are attending each raid
	public static function FindNumberAttending($idRaids){

		//Loop through each row, if $idRaids is equal to $row["idRaids"] then + 1 to number attending and return
		$NumberAttending = 0;

		$sql = "SELECT idUsers, idRaids, users_ip FROM users WHERE idRaids = '$idRaids'";
		$result = self::$conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$NumberAttending ++;
			}
		}

		self::UpdateNumberAttending($NumberAttending, $idRaids);
		
	}
	
	public static function UpdateNumberAttending($NumberAttending, $idRaids){

		$sql = "UPDATE raids SET NumberAttending = '$NumberAttending' WHERE idRaids = '$idRaids'";

		if (self::$conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            //echo "Error updating record: " . self::$conn->error;
        }
	}

}

?>