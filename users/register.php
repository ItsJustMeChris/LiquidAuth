<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/core.php';

$timeNow = new DateTime();
$timeNow = $timeNow->format("Y-m-d H:i:s");

$options = [
  'cost' => 11
];

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    if (strlen($_POST['email']) <= 5 || strlen($_POST['username']) <= 5 || strlen($_POST['password']) <= 5) {
        die(json_encode(["error" => "Invalid Username, Email, or Password"]));
    }
    $email = $mysqli->escape_string($_POST['email']);
    $username = $mysqli->escape_string($_POST['username']);
    $passwordHash = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));
    $result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error);
    if ( $result->num_rows > 0 ) {
        die(json_encode(["error" => "User Exists"]));
    } else {
        $mysqli->query("INSERT INTO users (username, email, password, regdate) VALUES ('$username', '$email', '$passwordHash', '$timeNow')") or die($mysqli->error);
        die(json_encode(["success" => "User Created"]));
    }
} else {
    die(json_encode(["error" => "Invalid Fields"]));
}
?>
