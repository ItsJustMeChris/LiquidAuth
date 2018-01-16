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
if ((isset($_POST['email']) || isset($_POST['username'])) && isset($_POST['password'])) {
    $username = $mysqli->escape_string($_POST['username']);
    $result = $mysqli->query("SELECT * FROM users WHERE username='$username'") or die($mysqli->error);
    if ( $result->num_rows > 0 ) {
        while ($row = mysqli_fetch_array($result)) {
            if (password_verify ($_POST['password'],$row['password'])){
                $_SESSION['userid'] = $row['id'];
                die("Logged In");
            } else {
                die("Invalid Password");
            }
        }
    } else {
        die("\nError: Invalid Login");
    }
} else {
    die("Error: Fields Invalid");
}
?>
