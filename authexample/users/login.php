<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/core.php';

$timeNow = new DateTime();
$timeNow = $timeNow->format("Y-m-d H:i:s");

$options = [
  'cost' => 11
];
if ($_SESSION && $_SESSION['userid']) {
    die("Already Logged In!");
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (strlen($_POST['username']) <= 5 || strlen($_POST['password']) <= 5) {
        die(json_encode(["error" => "Invalid Username or Password"]));
    }
    $username = $mysqli->escape_string($_POST['username']);
    $result = $mysqli->query("SELECT * FROM `users` WHERE UPPER(`username`)=UPPER('$username') OR UPPER(`email`)=UPPER('$username')") or die($mysqli->error);
    if ( $result->num_rows > 0 ) {
        while ($row = mysqli_fetch_array($result)) {
            if (password_verify ($_POST['password'],$row['password'])){
                $_SESSION['userid'] = $row['id'];
                die(json_encode(["success" => "Logged In"]));
            } else {
                die(json_encode(["error" => "Invalid Username or Password"]));
            }
        }
    } else {
        die(json_encode(["error" => "Invalid Username or Password"]));
    }
} else {
    die(json_encode(["error" => "Invalid Fields"]));
}
?>
