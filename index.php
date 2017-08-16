<?php
//Written by Theo Crowley
//http://theocrowley.com/

require_once('EventDatabase.php');

echo("<html>\n");

echo("<head>\n");
echo("<link rel='icon' href='http://pokemongodown.net/favicon.png'>");
echo("<title>GoGroupFinder</title>");
echo("<img src='GoGroupFinder.png' alt='GoGroupFinder'</img>");
echo("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>");
echo("<div style='padding-bottom:100px;'>\n");
echo '<nav class="nav nav-pills nav-fill" style="padding-top:10px; padding-bottom:10px;">
<a class="nav-item nav-link active" href="index.php">Create</a>
<a class="nav-item nav-link" href="Current.php">Current</a>
<a class="nav-item nav-link" href="http://theocrowley.com">Contact Me</a>
</nav>';
echo("</div>\n");
echo("</head>\n");

echo("<body style='background-color: #f2f2f2;'>\n");

echo("<div style='background-color: #ffffff; padding-top:10px; padding-bottom:10px; padding-right:200px; padding-left:200px; width: 60%; margin: auto; box-shadow: 3px 3px 1.5px #b3b3b3;'>\n");
echo '<form action="index.php" method="post">
  <div class="form-group" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
    <label for="location">Gym Name*</label>
    <input type="text" name="raidLocation" class="form-control" id="raidLocation" aria-describedby="locationHelp" placeholder="Enter Location">
  </div>
  <div class="form-group" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
    <label for="location">Town/City*</label>
    <input type="text" name="city" class="form-control" id="city" aria-describedby="cityHelp" placeholder="Enter Town/City">
  </div>
  <div class="form-group" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
  <label for="AdditionalNotes">Additional notes</label>
  <input type="text" name="additionalNotes" class="form-control" id="additionalNotes" aria-describedby="AdditionalNotesHelp" placeholder="e.g. Facebook/discord groups">
</div>
  <div class="form-group" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
    <label for="time">Meeting time*</label>
    <input type="time" name="time" class="form-control" id="time">
  </div>
	<div class="form-group" style="padding-top:10px; padding-bottom:10px; padding-right:20px; padding-left:20px;">
	<label for="raidboss">Raid Boss*</label><br>
	<select name="raidBoss" class="custom-select">
  	<option value="Magikarp">Magikarp</option>
  	<option value="Bayleef">Bayleef</option>
		<option value="Quilava">Quilava</option>
		<option value="Croconaw">Croconaw</option>
		<option value="Muk">Muk</option>
		<option value="Exeggutor">Exeggutor</option>
		<option value="Weezing">Weezing</option>
		<option value="Electabuzz">Electabuzz</option>
		<option value="Magmar">Magmar</option>
		<option value="Arcanine">Arcanine</option>
		<option value="Alakazam">Alakazam</option>
		<option value="Machamp">Machamp</option>
		<option value="Gengar">Gengar</option>
		<option value="Vaporeon">Vaporeon</option>
		<option value="Jolteon">Jolteon</option>
		<option value="Flareon">Flareon</option>
		<option value="Venusaur">Venusaur</option>
		<option value="Charizard">Charizard</option>
		<option value="Blastoise">Blastoise</option>
		<option value="Rhydon">Rhydon</option>
		<option value="Lapras">Lapras</option>
		<option value="Snorlax">Snorlax</option>
		<option value="Tyranitar">Tyranitar</option>
		<option value="Articuno">Articuno</option>
		<option value="Zapdos">Zapdos</option>
		<option value="Moltres">Moltres</option>
		<option value="Mewtwo">Mewtwo</option>
		<option value="Mew">Mew</option>
		<option value="Raikou">Raikou</option>
		<option value="Entei">Entei</option>
		<option value="Suicune">Suicune</option>
		<option value="Lugia">Lugia</option>
		<option value="Ho-Oh">Ho-Oh</option>
		<option value="Celebi">Celebi</option>
	</select>
	</div>
	<div style="padding-left:20px;">
	<button name="createEvent" type="submit"class="btn btn-primary">Create Event</button>
	</div>
</form>';

function getData() {
	$location = $_POST["raidLocation"];
	$eventTime = $_POST["time"];
	$raidBoss = $_POST["raidBoss"];
	$city = $_POST["city"];
	$additionalNotes = $_POST["additionalNotes"];
	
	if (empty($location) || empty($eventTime) || empty($raidBoss) || empty($city)){
		echo("<p><font color='red'><b>Fill out all fields</b></font></p>");
	} else {
		echo("<p>Event created successfully!</p>");
		EventDatabase::databaseConnect();
		EventDatabase::createEvent($location, $eventTime, $raidBoss, $city, $additionalNotes);
	}	
}

if (isset($_POST['createEvent'])) {
	getData();
}

echo("</div>\n");
echo("</body>\n");
echo("</html>\n");
 
?>