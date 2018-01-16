<?php
require_once __DIR__ . '/../users/users_class.php';
$users = new Users;
if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
    if (strlen($_POST['email']) < 5 || strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5) {
        die(json_encode(["error" => $users->registerError]));
    }
    $users->register($_POST['username'], $_POST['email'], $_POST['password']);
} else {
    die(json_encode(["error" => $users->invalidFieldsError]));
}
?>
