<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/core.php';

$timeNow = new DateTime();
$timeNow = $timeNow->format("Y-m-d H:i:s");

$options = [
  'cost' => 11
];
if ($_SESSION && $_SESSION['userid']) {
    session_destroy();
    die("Logged Out!");
} else {
    die("You are not logged in!");
}
?>
