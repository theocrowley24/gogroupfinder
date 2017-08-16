<?php
//Written by Theo Crowley
//http://theocrowley.com/

require_once('EventDatabase.php');

echo("<html>\n");

echo("<head>\n");
echo("<link rel='icon' href='http://pokemongodown.net/favicon.png'>");
echo("<title>GoGroupFinder</title>");
echo("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>");
echo('<link rel="stylesheet" type="text/css" href="StyleSheet.css">');
echo("</head>\n");

echo("<body style='background-color: #f2f2f2;'>\n");

echo("<img src='GoGroupFinder.png' alt='GoGroupFinder'</img>");

echo '<nav class="nav nav-pills nav-fill" style="padding-top:10px; padding-bottom:10px;">
  <a class="nav-item nav-link" href="index.php">Create</a>
  <a class="nav-item nav-link active" href="Current.php">Current</a>
  <a class="nav-item nav-link" href="ContactMe.php">Contact Me</a>
</nav>';

echo('<form action="Current.php" method="post" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
  <div class="form-group">
    <input type="text" class="form-control" id="searchCity" name="searchCity" aria-describedby="emailHelp" placeholder="Enter town/city">
  </div>
  </form>');
  
function displayEvents(){
	$searchCity = $_POST['searchCity'];

	EventDatabase::databaseConnect();
	$result = EventDatabase::databaseSearch($searchCity);

	echo ('<div class="center-me">');

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			
			$idRaids = $row["idRaids"];
			$Location = $row["Location"];
			$Time = $row["Time"];
			$RaidBoss = $row["RaidBoss"];
			$NumberAttending = $row["NumberAttending"];
			$City = $row["City"];
			$AdditionalNotes = $row["AdditionalNotes"];
			
			echo '<div class="card" style="width: 20rem; float:left;">
  <div class="card-body">
    <h4 class="card-title">'.$RaidBoss.'</h4>
    <h6 class="card-subtitle mb-2 text-muted">'.$Location.', '.$City.'</h6>
		<p class="card-text">'.$NumberAttending.' Person(s) going</p>
		<p class="card-text">'.$AdditionalNotes.'</p>
	<p class="card-text">'.$Time.'</p>
	<form action="Current.php" method="post">
		<input class="btn btn-primary" type="submit" name="going" value="Going" />
		<input type="hidden" name="going-data" value='.$idRaids.' />
	</form>
  </div>
</div>';	
		}
	} else {
		echo "0 results";
	}
}

echo ('</div>');

displayEvents();

if (isset($_POST['going'])) {
  $raidID = $_POST['going-data'];
	EventDatabase::going($raidID);
}
	

echo("</body>\n");
echo("</html>\n");
 
?>