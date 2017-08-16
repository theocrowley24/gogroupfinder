# gogroupfinder
A web based raid group manager written in PHP for Pokemon GO

Usage:

1. Insert your own database parameters in EventDatabase.php and DeleteOld.php (note DeleteOld.php is only required if you are using a cron job to automate deletion of old events).
2. Execute both the MySQL Querys located in 'MySQL Querys.txt' to create the two tables required.
3. Drag and drop the files into your servers respective file directory.

Automating deletion of old records:

1. You can either use a CRON job to do this, if using a CRON job run a command which executes DeleteOld.php every minute.
2. Otherwise you can use the MySQL event scheduler to do this

See it in action at http://theocrowley.com/gogroupfinder/
