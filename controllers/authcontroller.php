<?php
class AuthController
{
    function login()
    {
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
    }

    function logout()
    {
        $users = new Users;
        $users->logOut();
    }

    function register()
    {
        $users = new Users;
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
            if (strlen($_POST['email']) < 5 || strlen($_POST['username']) < 5 || strlen($_POST['password']) < 5) {
                die(json_encode(["error" => $users->registerError]));
            }
            $users->register($_POST['username'], $_POST['email'], $_POST['password']);
        } else {
            die(json_encode(["error" => $users->invalidFieldsError]));
        }
    }
}
?>
