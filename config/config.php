<?php
$host = 'localhost';
$user = 'username';
$pass = 'password';
$db = 'database';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

$mysqli->query('
CREATE TABLE IF NOT EXISTS `userauth`.`'$db'`
(
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(100) NOT NULL,
    `regdate` datetime NOT NULL,
    `active` BOOL NOT NULL DEFAULT 0,
PRIMARY KEY (`id`)
);') or die($mysqli->error);

?>
