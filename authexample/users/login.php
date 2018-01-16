<?php
require_once __DIR__ . '/../users/users_class.php';
$users = new Users;

if ($users->loggedIn()) {
    die(json_encode(["error" => $users->loggedInError]));
}
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5) {
        die(json_encode(["error" => $users->invalidLoginError]));
    }
    $users->login($_POST['username'], $_POST['password']);
} else {
    die(json_encode(["error" => $users->invalidFieldsError]));
}
?>
