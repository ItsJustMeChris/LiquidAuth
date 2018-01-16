<?php
require_once __DIR__ . '/../database/database_class.php';
require_once __DIR__ . '/../core/core.php';
$db = new Database;
class Users {
    public $loggedInError = 'Already Logged In';
    public $invalidLoginError = 'Invalid Username or Password';
    public $invalidFieldsError = 'Invalid Fields';
    public $notLoggedInError = 'Not Logged In';
    public $userExistsError = 'User Exists';
    public $registerError = 'Invalid Username, Email, or Password';
    public $logoutMessage = 'Logged Out';
    public $loggedInMessage = 'Logged In';
    public $userCreatedMessage = 'User Created';

    function loggedIn() {
        if ($_SESSION && $_SESSION['userid']) {
            return true;
        } else {
            return false;
        }
    }

    function logOut() {
        if ($_SESSION && $_SESSION['userid']) {
            session_destroy();
            die(json_encode(["success" => $this->logoutMessage]));
        } else {
            die(json_encode(["error" => $this->notLoggedInError]));
        }
    }

    function currentUserID() {
        if ($_SESSION && $_SESSION['userid']) {
            return $_SESSION['userid'];
        } else {
            return 0;
        }
    }

    function login($f_username, $f_password) {
        $db = new Database;
        $username = $db->escape($f_username);
        $result = $db->query("SELECT * FROM `users` WHERE UPPER(`username`)=UPPER('$username') OR UPPER(`email`)=UPPER('$username')");
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {
                if (password_verify($f_password,$row['password'])) {
                    $_SESSION['userid'] = $row['id'];
                    die(json_encode(["success" => $this->loggedInMessage]));
                } else {
                    die(json_encode(["error" => $this->invalidLoginError]));
                }
            }
        } else {
            die(json_encode(["error" => $this->invalidLoginError]));
        }
    }

    function register($f_username, $f_email, $f_password) {
        $db = new Database;
        $email = $db->escape($_POST['email']);
        $username = $db->escape($_POST['username']);
        $passwordHash = $db->escape(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 11]));
        $result = $db->query("SELECT * FROM users WHERE username='$username'");
        $timeNow = new DateTime();
        $timeNow = $timeNow->format("Y-m-d H:i:s");
        if ( $result->num_rows > 0 ) {
            die(json_encode(["error" => $this->userExistsError]));
        } else {
            $db->query("INSERT INTO users (username, email, password, regdate) VALUES ('$username', '$email', '$passwordHash', '$timeNow')");
            die(json_encode(["success" => $this->userCreatedMessage]));
        }
    }

}

?>
