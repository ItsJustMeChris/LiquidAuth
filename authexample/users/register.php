<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/core.php';

$timeNow = new DateTime();
$timeNow = $timeNow->format("Y-m-d H:i:s");

$options = [
  'cost' => 11
];

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    $email = $mysqli->escape_string($_POST['email']);
    $username = $mysqli->escape_string($_POST['username']);
    $passwordHash = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT, $options));
    $result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error);
    if ( $result->num_rows > 0 ) {
        die("Error: User already exists");
    } else {
        $mysqli->query("INSERT INTO users (username, email, password, regdate) VALUES ('$username', '$email', '$passwordHash', '$timeNow')") or die($mysqli->error);
        die("Created User");
    }
} else {
    die("Error: Fields Invalid");
}
?>
