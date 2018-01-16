<?php
$host = 'localhost';
$user = 'Username';
$pass = 'Password';
$db = 'Database';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
$mysqli->query('
CREATE TABLE `userauth`.`users`
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
