<?php
//Written by Theo Crowley
//http://theocrowley.com/

require_once('EventDatabase.php');

echo("<html>\n");

echo("<head>\n");
echo("<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' integrity='sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M' crossorigin='anonymous'>");
echo("</head>\n");

echo("<body>\n");

echo("<h1 style='padding-left:20px;'>GoGroupFinder</h1>");

echo '<nav class="nav nav-pills nav-fill" style="padding-top:10px; padding-bottom:10px;">
  <a class="nav-item nav-link" href="index.php">Create</a>
  <a class="nav-item nav-link" href="Current.php">Current</a>
  <a class="nav-item nav-link active" href="ContactMe.php">Contact Me</a>
</nav>';

echo("<h2>If you wish to contact me and suggest any ideas or features, feel free to email: 'email here'</h2>");

echo("</body>\n");
echo("</html>\n");
?>