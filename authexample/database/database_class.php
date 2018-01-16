<?php
class Database {
    public $loggedInError = 'Already Logged In';
    public $invalidLoginError = 'Invalid Username or Password';
    public $invalidFieldsError = 'Invalid Fields';
    private $host = 'localhost';
    private $user = 'username';
    private $pass = 'password';
    private $db = 'database';

    function query($f_query) {
        $mysqli = new mysqli($this->host,$this->user,$this->pass,$this->db) or die($mysqli->error);
        return $mysqli->query($f_query);
    }

    function escape($f_string) {
        $mysqli = new mysqli($this->host,$this->user,$this->pass,$this->db) or die($mysqli->error);
        return $mysqli->escape_string($f_string);
    }
}
?>
