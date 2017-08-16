# gogroupfinder
A web based raid group manager written in PHP for Pokemon GO

MySQL Querys:

CREATE TABLE `raids` (
  `idRaids` int(11) NOT NULL AUTO_INCREMENT,
  `Location` varchar(45) DEFAULT NULL,
  `Time` varchar(45) DEFAULT NULL,
  `RaidBoss` varchar(45) DEFAULT NULL,
  `NumberAttending` int(11) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `unix` int(11) DEFAULT NULL,
  `AdditionalNotes` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRaids`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `idUsers` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idRaids` int(11) DEFAULT NULL,
  `users_ip` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUsers`),
  UNIQUE KEY `idRaids` (`idRaids`,`users_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

CREATE EVENT DeleteOld
    ON SCHEDULE
      EVERY 1 MINUTE
    COMMENT 'Deletes events which are two hours old.'
    DO
      DELETE FROM raids WHERE `unix` < (UNIX_TIMESTAMP() - 7200);

Usage:

1. Insert your own database parameters in EventDatabase.php and DeleteOld.php (note DeleteOld.php is only required if you are using a cron job to automate deletion of old events).
2. Execute both the MySQL Querys noted above to create the two tables required.
3. Drag and drop the files into your servers respective file directory.

Automating deletion of old records:

1. You can either use a CRON job to do this, if using a CRON job run a command which executes DeleteOld.php every minute.
2. Otherwise you can use the MySQL event scheduler to do this
